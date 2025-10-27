<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.pembayaran.input');
    }

    public function store(Request $request)
    {
        Log::info('Masuk ke fungsi store', $request->all());

        try {
            $validated = $request->validate([
                'santri_id'    => 'required|exists:santris,id',
                'nominal'      => 'required|numeric|min:50000',
                'bulan'        => 'required',
                'metode_bayar' => 'required',
                'status'       => 'required|string|in:Lunas,Belum Lunas',
                'tanggal'      => 'required|date',
            ], [
                'nominal.min' => 'Nominal pembayaran minimal Rp 50.000'
            ]);

            $santri = Santri::find($request->santri_id);
            if (!$santri) {
                return back()->with('error', 'Data santri tidak ditemukan!');
            }

            $userId = $santri->user_id ?? null;

            DB::beginTransaction();

            $nominal = (int) $request->nominal;
            $bulanAwal = $request->bulan;
            $jumlahBulan = floor($nominal / 50000);

            $bulanIndo = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                4 => 'April', 5 => 'Mei', 6 => 'Juni',
                7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];

            list($tahun, $bulan) = explode('-', $bulanAwal);
            $indexBulan = (int) $bulan;
            $tanggalBayarSekarang = Carbon::parse($request->tanggal)->toDateString();
            $bulanBerhasilDisimpan = [];
            $statusInput = $request->status; // ✅ simpan sebagai string, bukan integer

            for ($i = 0; $i < $jumlahBulan; $i++) {
                $currentMonth = $indexBulan + $i;
                $currentYear = (int) $tahun;

                while ($currentMonth > 12) {
                    $currentMonth -= 12;
                    $currentYear++;
                }

                $bulanBayar = $bulanIndo[$currentMonth];

                // Buat atau ambil tagihan
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

                if (!$tagihan || empty($tagihan->id)) {
                    throw new \Exception('Gagal membuat Tagihan untuk bulan ' . $bulanBayar);
                }

                // Skip jika tagihan sudah lunas
                if ($tagihan->status === 'Lunas') {
                    $bulanBerhasilDisimpan[] = "$bulanBayar $currentYear (sudah lunas)";
                    continue;
                }

                // Cek pembayaran lunas sebelumnya
                $existingPembayaranLunas = Pembayaran::where('tagihan_id', $tagihan->id)
                    ->where('status', 'Lunas')
                    ->first();

                if ($existingPembayaranLunas) {
                    $bulanBerhasilDisimpan[] = "$bulanBayar $currentYear (sudah dibayar)";
                    continue;
                }

                // Simpan pembayaran baru
                $dataPembayaran = [
                    'santri_id'      => $request->santri_id,
                    'user_id'        => $userId,
                    'tagihan_id'     => $tagihan->id,
                    'nama_santri'    => $santri->nama,
                    'bulan'          => $bulanBayar,
                    'jumlah_bayar'   => 50000,
                    'tanggal_bayar'  => $tanggalBayarSekarang,
                    'status'         => $statusInput,
                    'metode_bayar'   => $request->metode_bayar,
                    'bukti_transfer' => null,
                ];

                Pembayaran::create($dataPembayaran);

                // Update tagihan
                $tagihan->update([
                    'status'        => $statusInput,
                    'tanggal_bayar' => $statusInput === 'Lunas' ? $tanggalBayarSekarang : null,
                    'metode_bayar'  => $statusInput === 'Lunas' ? $request->metode_bayar : null,
                ]);

                $bulanBerhasilDisimpan[] = "$bulanBayar $currentYear";
            }

            DB::commit();

            $bulanBaruDisimpan = array_filter($bulanBerhasilDisimpan, fn($item) => !str_contains($item, '(sudah'));
            $pesanBulan = implode(', ', $bulanBaruDisimpan);
            $statusPesan = $statusInput === 'Lunas' ? 'otomatis lunas' : 'berhasil dicatat';

            return redirect()->route('admin.pembayaran.input')
                ->with('success', "Pembayaran Rp " . number_format($nominal, 0, ',', '.') . " berhasil disimpan untuk " . count($bulanBaruDisimpan) . " bulan ($pesanBulan). Status tagihan $statusPesan!");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("admin Pembayaran Error: " . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan pembayaran. ' . $e->getMessage())->withInput();
        }
    }

    public function index()
    {
        return $this->create();
    }

    public function laporan()
    {
        $santriBelumBayar = Tagihan::with('santri')
            ->where('status', 'Belum Lunas')
            ->distinct('santri_id')
            ->get();

        return view('admin.pembayaran.laporan', compact('santriBelumBayar'));
    }

    public function show($id)
    {
        $tagihan = Tagihan::with('santri', 'pembayarans')->findOrFail($id);
        return view('admin.pembayaran.show', compact('tagihan'));
    }
}
