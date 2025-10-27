<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Keuangan - Majelis Ta'lim Al-Mujahidin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
        @page { 
            size: A4 portrait;
            margin: 1cm;
        }
        body {
            font-size: 10pt;
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
            padding-top: 50px;
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
        }

        @media print {
            .no-print {
                display: none;
            }
        }
        
        .header-print {
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .header-print h1 {
            color: white !important;
            font-size: 24pt;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        
        .header-print p {
            color: #d1fae5 !important;
            font-size: 9pt;
        }
        
        .section-title {
            background: linear-gradient(90deg, #059669 0%, #10b981 100%);
            color: white !important;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            background: white;
            border-left: 4px solid #059669;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        th, td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            text-align: left;
        }
        
        .table-header {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%) !important;
            color: white !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 9pt;
            letter-spacing: 0.5px;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f0fdf4;
        }
        
        tbody tr:hover {
            background-color: #d1fae5;
        }
        
        .badge-lunas {
            background: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 8pt;
            font-weight: 600;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-left: 5px solid #10b981;
            border-radius: 8px;
        }
        
        .signature-box {
            border: 2px solid #059669;
            border-radius: 8px;
            padding: 15px;
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
        }
    </style>
</head>
<body onload="window.print();">

    <div class="fixed top-4 right-4 z-50 no-print">
        <button onclick="window.close()" 
                class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-xl transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
            Tutup
        </button>
    </div>

    <div class="p-6">
        <div class="header-print">
            <h1 class="text-2xl font-bold text-gray-800">LAPORAN KEUANGAN</h1>
            <p class="text-sm text-gray-600">Periode : Bulan {{ $namaBulanTarget ?? 'Sekarang' }} | Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
        </div>
        
        <h2 class="text-xl font-bold mb-4 border-b pb-2 text-teal-700">Ringkasan Keuangan Santri</h2>
        <div class="grid grid-cols-4 gap-4 mb-8">
            <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-xs text-gray-500">Total Santri</p>
                <p class="text-lg font-bold text-gray-700">{{ $totalSantri ?? 0 }}</p>
            </div>
            <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-xs text-gray-500">Total Pendapatan (Keseluruhan)</p>
                <p class="text-lg font-bold text-emerald-700">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-xs text-gray-500">Santri Lunas Bulan Ini</p>
                <p class="text-lg font-bold text-blue-700">{{ $jumlahLunas ?? 0 }} ({{ $persentasePembayaran ?? 0 }}%)</p>
            </div>
            <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-xs text-gray-500">Santri Belum Bayar Bulan Ini</p>
                <p class="text-lg font-bold text-red-700">{{ $jumlahBelumBayar ?? 0 }}</p>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-4 border-b pb-2 text-amber-700">Daftar Santri Belum Bayar (Bulan {{ $namaBulanTarget ?? 'Sekarang' }})</h2>
        @if ($santriBelumBayar->isNotEmpty())
            <table class="mb-8">
                <thead>
                    <tr class="table-header">
                        <th class="w-1/12">No</th>
                        <th class="w-5/12">Nama Santri</th>
                        <th class="w-3/12">Wali Santri</th>
                        <th class="w-3/12">Telepon Wali</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($santriBelumBayar as $index => $santri)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="font-semibold">{{ $santri->nama ?? '-' }}</td>
                            <td>{{ $santri->wali ?? 'Tidak Dicatat' }}</td>
                            <td>{{ $santri->telepon ?? '-' }}</td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mb-8 p-3 bg-green-50 text-green-700 border-l-4 border-green-500 italic font-medium">🎉 SEMUA SANTRI SUDAH LUNAS untuk Bulan {{ $namaBulanTarget ?? 'Sekarang' }}! Tidak ada data tunggakan.</p>
        @endif

        <h2 class="text-xl font-bold mb-4 border-b pb-2 text-emerald-700">Riwayat Pembayaran Terbaru</h2>
        <table class="mb-8">
            <thead>
                <tr class="table-header">
                    <th class="w-1/12">No</th>
                    <th class="w-2/12">Tanggal Bayar</th>
                    <th class="w-3/12">Nama Santri</th>
                    <th class="w-2/12">Bulan Bayar</th>
                    <th class="w-3/12">Nominal</th>
                    <th class="w-1/12 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayatPembayaran as $index => $bayar)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d/m/Y') }}</td>
                        <td class="font-semibold">{{ $bayar->santri->nama ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $bayar->bulan ?? '-' }}</td>
                        <td class="font-semibold text-emerald-600">
                            Rp {{ number_format($bayar->jumlah_bayar ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                             <span class="font-medium text-sm text-green-700">{{ $bayar->status ?? 'LUNAS' }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 italic text-gray-500">Tidak ada riwayat pembayaran terbaru yang tercatat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-12 text-right">
            <p class="mb-10">Hormat Kami,</p>
            <p class="font-bold border-b border-gray-400 inline-block px-8 py-1">( Admin )</p>
        </div>
    </div>

</body>
</html>
