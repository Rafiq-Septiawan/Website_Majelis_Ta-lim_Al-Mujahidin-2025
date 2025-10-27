<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Pembayaran;
use App\Models\Santri;
use App\Models\Tagihan;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $santri = Santri::where('user_id', $user->id)->first();

        if (!$santri) {
            return back()->with('error', 'Data santri tidak ditemukan.');
        }

        // 🔹 Ambil tagihan yang belum lunas
        $tagihanBelumLunas = Tagihan::where('santri_id', $santri->id)
            ->where('status', 'Belum Lunas')
            ->orderBy('jatuh_tempo', 'asc')
            ->get();

        // 🔹 Ambil riwayat pembayaran yang sudah lunas
        $riwayatPembayaran = Pembayaran::where('santri_id', $santri->id)
            ->where('status', 'Lunas')
            ->orderByDesc('tanggal_bayar')
            ->get();

        return view('santri.pembayaran.input', compact('santri', 'tagihanBelumLunas', 'riwayatPembayaran'));
    }

    public function index()
    {
        return $this->create();
    }

public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'santri_id'      => 'required|exists:santris,id',
            'nominal'        => 'required|numeric|min:50000',
            'bulan'          => 'required',
            'metode_bayar'   => 'required|in:Tunai,Transfer Bank,E-Wallet,QRIS',
            'tanggal'        => 'required|date',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nominal.min' => 'Nominal pembayaran minimal Rp 50.000',
            'metode_bayar.in' => 'Metode pembayaran tidak valid',
            'bukti_transfer.image' => 'Bukti transfer harus berupa gambar',
        ]);

        if ($request->hasFile('bukti_transfer')) {
            Log::info('File terdeteksi: ' . $request->file('bukti_transfer')->getClientOriginalName());
        }

        $santri = Santri::find($request->santri_id);
        if (!$santri) {
            return back()->with('error', 'Data santri tidak ditemukan!');
        }

        $userId = $santri->user_id ?? null;

        // 🔹 Upload bukti transfer jika ada
        $buktiTransferPath = null;
        if ($request->hasFile('bukti_transfer') && $request->file('bukti_transfer')->isValid()) {
            $file = $request->file('bukti_transfer');
            
            // Pastikan folder ada
            $uploadPath = storage_path('app/public/bukti_transfer');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Sanitize filename untuk hindari karakter aneh
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\_\.]/', '_', $file->getClientOriginalName());
            $file->move($uploadPath, $filename);
            $buktiTransferPath = 'uploads/bukti_transfer/' . $filename;
        }

        DB::beginTransaction();

        $nominal = (int) $request->nominal;
        $bulanAwal = $request->bulan;
        $jumlahBulan = floor($nominal / 50000);

        // 🔹 Mapping bulan Indonesia
        $bulanAngka = [
            'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4,
            'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8,
            'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12
        ];

        $bulanTeks = array_flip($bulanAngka);

        // 🔹 Format bulan: contoh “2025-Oktober” atau “2025-10”
        if (strpos($bulanAwal, '-') === false) {
            throw new \Exception('Format bulan tidak valid. Gunakan format YYYY-Bulan (misal: 2025-Oktober).');
        }

        list($tahun, $bulanText) = explode('-', $bulanAwal);

        $indexBulan = is_numeric($bulanText) ? (int) $bulanText : ($bulanAngka[$bulanText] ?? 0);
        if ($indexBulan === 0) {
            throw new \Exception("Format bulan tidak dikenali: {$bulanText}");
        }

        $tanggalBayarSekarang = Carbon::parse($request->tanggal)->toDateString();
        $bulanBerhasilDisimpan = [];

        // 🔁 Loop untuk setiap bulan yang dibayar
        for ($i = 0; $i < $jumlahBulan; $i++) {
            $currentMonth = $indexBulan + $i;
            $currentYear = (int) $tahun;

            while ($currentMonth > 12) {
                $currentMonth -= 12;
                $currentYear++;
            }

            $bulanBayar = $bulanTeks[$currentMonth];

            // 🔹 Buat atau ambil tagihan
            $tagihan = Tagihan::firstOrCreate(
                [
                    'santri_id' => $request->santri_id,
                    'bulan'     => $bulanBayar,
                    'tahun'     => $currentYear,
                ],
                [
                    'user_id'         => $userId,
                    'nominal'         => 50000,
                    'tanggal_tagihan' => now(),
                    'jatuh_tempo'     => now()->addDays(7),
                    'status'          => 'Belum Lunas',
                ]
            );

            // Jika sudah lunas, lewati
            if ($tagihan->status === 'Lunas') {
                continue;
            }

            // 🔹 Simpan pembayaran — langsung LUNAS
            Pembayaran::create([
                'santri_id'      => $request->santri_id,
                'user_id'        => $userId,
                'tagihan_id'     => $tagihan->id,
                'nama_santri'    => $santri->nama,
                'bulan'          => $bulanBayar,
                'jumlah_bayar'   => 50000,
                'tanggal_bayar'  => $tanggalBayarSekarang,
                'status'         => 'Lunas',
                'metode_bayar'   => $request->metode_bayar,
                'bukti_transfer' => $buktiTransferPath,
            ]);

            // 🔹 Update status tagihan jadi LUNAS
            $tagihan->update([
                'status'        => 'Lunas',
                'tanggal_bayar' => $tanggalBayarSekarang,
                'metode_bayar'  => $request->metode_bayar,
            ]);

            $bulanBerhasilDisimpan[] = "$bulanBayar $currentYear";
        }

        DB::commit();

        $pesanBulan = implode(', ', $bulanBerhasilDisimpan);
        return redirect()->route('santri.pembayaran.input')
            ->with('success', "Pembayaran Rp " . number_format($nominal, 0, ',', '.') . " berhasil disimpan untuk " . count($bulanBerhasilDisimpan) . " bulan ($pesanBulan). Status tagihan otomatis lunas!");

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("Santri Pembayaran Error: " . $e->getMessage());
        return back()->withInput()->with('error', 'Gagal menyimpan pembayaran: ' . $e->getMessage());
    }
}

    public function laporan()
    {
        $santriBelumBayar = Tagihan::with('santri')
            ->where('status', 'Belum Lunas')
            ->distinct('santri_id')
            ->get();

        return view('santri.pembayaran.laporan', compact('santriBelumBayar'));
    }

    public function show($id)
    {
        $tagihan = Tagihan::with('santri', 'pembayarans')->findOrFail($id);
        return view('santri.pembayaran.input', compact('tagihan'));
    }
}
