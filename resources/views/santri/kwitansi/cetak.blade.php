<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran - {{ $nomorKwitansi }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Arial', sans-serif;
            background: #f4f7f9;
            padding: 20px;
        }

        .container {
            max-width: 780px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .kwitansi-header {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
            padding: 30px 40px;
            text-align: left;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .institution-logo-text {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .institution-info {
            font-size: 12px;
            text-align: right;
            opacity: 0.9;
        }

        .kwitansi-badge {
            display: inline-block;
            background: white;
            color: #059669;
            padding: 6px 15px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            margin-top: 10px;
        }

        .kwitansi-body {
            padding: 40px;
        }

        .kwitansi-metadata {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 20px;
        }

        .kwitansi-number {
            text-align: left;
        }
        
        .kwitansi-number label {
            font-size: 13px;
            color: #6c757d;
            display: block;
            margin-bottom: 5px;
        }

        .kwitansi-number .value {
            font-size: 20px;
            font-weight: 700;
            color: #343a40;
        }

        .status-paid {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #d4edda;
            color: #155724;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .data-sections {
            display: flex;
            gap: 40px;
            margin-bottom: 25px;
        }
        
        .section {
            flex: 1;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #059669;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 3px solid #059669;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table tr td {
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px dashed #e9ecef;
        }

        .info-table tr:last-child td {
            border-bottom: none;
        }
        
        .info-table td:first-child {
            color: #6c757d;
            width: 40%;
        }

        .info-table td:nth-child(2) {
            width: 5%;
            color: #6c757d;
        }

        .info-table td:last-child {
            font-weight: 500;
            color: #343a40;
        }

        .amount-box {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            padding: 25px;
            border-radius: 10px;
            margin: 30px 0;
            text-align: center;
            color: white;
        }
        .amount-label {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 10px;
        }
        .amount-value {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .amount-text {
            font-size: 13px;
            margin-top: 10px;
            opacity: 0.9;
            font-style: italic;
        }
        .note-box {
            background: #f0fdf4;
            border-left: 5px solid #059669;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }

        .note-box p {
            font-size: 13px;
            color: #065f46;
            line-height: 1.6;
        }
/
        .kwitansi-footer {
            margin-top: 35px;
        }

        .signature-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .signature-box {
            text-align: center;
            width: 40%;
        }

        .signature-label {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 50px;
            display: block;
        }

        .signature-name {
            font-weight: 600;
            color: #343a40;
            border-top: 1px solid #343a40;
            padding-top: 8px;
            display: inline-block;
            min-width: 180px;
        }

        .footer-info {
            text-align: center;
            font-size: 11px;
            color: #6c757d;
            padding: 15px 40px;
            background: #f8f9fa;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
            margin: 0 -40px -40px -40px;
        }

        .print-controls {
            text-align: center;
            margin: 20px 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-controls {
            width: 180px;
        }

        .btn {
            display: inline-block;
            padding: 10px 25px;
            margin: 0;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-print {
            background: #059669;
            color: white;
        }

        .btn-print:hover {
            background: #047857;
        }

        .btn-back {
            background: white;
            color: #059669;
            border: 1px solid #059669;
        }

        .btn-back:hover {
            background: #e6f2ee;
        }

        @media print {
            body { background: white; padding: 0; }
            .container { box-shadow: none; max-width: 100%; border-radius: 0; }
            .print-controls { display: none; }
            .kwitansi-body { padding: 30px; }
            .footer-info { margin: 0 -30px -30px -30px; }
            .kwitansi-header { border-radius: 0; }
        }
    </style>
</head>
<body>
    <div class="print-controls">
        <button onclick="window.print()" class="btn btn-print btn-controls">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px; height:16px; margin-right:5px; vertical-align: middle;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
            </svg>
            Cetak Kwitansi
        </button>
        <button onclick="goBackAndClose()" class="btn btn-back btn-controls">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px; height:16px; margin-right:5px; vertical-align: middle;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </button>
    </div>

    <div class="container">
        <div class="kwitansi-header">
            <div class="header-left">
                <div class="institution-logo-text">AL-MUJAHIDIN</div>
                <div class="kwitansi-badge">KWITANSI PEMBAYARAN</div>
            </div>
            <div class="institution-info">
                MAJELIS TA'LIM AL-MUJAHIDIN<br>
                Jl. Cipondoh Makmur | Telp. 0852-8188-1608
            </div>
        </div>

        <div class="kwitansi-body">
            <div class="kwitansi-metadata">
                <div class="kwitansi-number">
                    <label>Nomor Kwitansi</label>
                    <div class="value">#{{ $nomorKwitansi }}</div>
                </div>
                <div class="status-paid">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:18px; height:18px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    LUNAS
                </div>
            </div>
            
            <div class="data-sections">
                <div class="section">
                    <div class="section-title">Data Santri</div>
                    <table class="info-table">
                        <tr>
                            <td>Nama Santri</td>
                            <td>:</td>
                            <td>{{ $santri->nama }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($santri->tanggal_lahir)->isoFormat('DD/MM/YYYY') }}</td>
                        </tr>
                        <tr>
                            <td>Wali Santri</td>
                            <td>:</td>
                            <td>{{ $santri->wali }}</td>
                        </tr>
                    </table>
                </div>

                <div class="section">
                    <div class="section-title">Detail Pembayaran</div>
                    <table class="info-table">
                        <tr>
                            <td>Tanggal Bayar</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->isoFormat('D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td>Untuk Bulan</td>
                            <td>:</td>
                            <td>{{ $pembayaran->bulan }}</td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td>:</td>
                            <td>{{ ucfirst($pembayaran->metode_bayar ?? 'Tunai') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="section-title" style="margin-bottom: 10px;">Deskripsi Pembayaran</div>
            <p style="margin-bottom: 20px; font-size: 14px; color: #343a40;">
                {{ $pembayaran->jenis_pembayaran ?? 'Pembayaran SPP Bulanan' }}
            </p>

            <div class="amount-box">
                <div class="amount-label">Total Pembayaran</div>
                <div class="amount-value">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</div>
                <div class="amount-text">
                    ({{ ucwords(terbilang($pembayaran->jumlah_bayar)) }} Rupiah)
                </div>
            </div>

            <div class="note-box">
                <p><strong>Penting:</strong><br>
                Terima kasih atas kontribusi Anda. Bukti pembayaran ini sah dan tercatat dalam sistem Majelis Ta'lim Al-Mujahidin. Mohon simpan dengan baik.</p>
            </div>

            <div class="kwitansi-footer">
                <div class="signature-section">
                    <div class="signature-box">
                        <div class="signature-label">Tangerang, {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->isoFormat('D MMMM Y') }}</div>
                        <div class="signature-label">Penerima,</div>
                        <div class="signature-name">( Admin Majelis )</div>
                    </div>
                </div>
            </div>

            <div class="footer-info">
                <p>Kwitansi ini adalah dokumen digital yang sah.</p>
                <p>Dicetak pada: {{ now()->isoFormat('D/M/Y - HH:mm') }} WIB</p>
            </div>
        </div>
    </div>
    
    <script>
        function goBackAndClose() {
            if (window.history.length > 1) {
                window.history.back();
            }
            window.close(); 
        }
    </script>
</body>
</html>

@php
function terbilang($angka) {
    $angka = abs($angka);
    $baca = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
    $terbilang = "";

    if ($angka < 12) {
        $terbilang = " " . $baca[$angka];
    } else if ($angka < 20) {
        $terbilang = terbilang($angka - 10) . " belas";
    } else if ($angka < 100) {
        $terbilang = terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
    } else if ($angka < 200) {
        $terbilang = " seratus" . terbilang($angka - 100);
    } else if ($angka < 1000) {
        $terbilang = terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
    } else if ($angka < 2000) {
        $terbilang = " seribu" . terbilang($angka - 1000);
    } else if ($angka < 1000000) {
        $terbilang = terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
    } else if ($angka < 1000000000) {
        $terbilang = terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
    }

    return $terbilang;
}
@endphp