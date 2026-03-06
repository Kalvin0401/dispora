<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pernyataan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .center {
            text-align: center;
        }
        .mt-20 {
            margin-top: 20px;
        }
        .mt-40 {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="center">
    <h3>SURAT PERNYATAAN</h3>
</div>

<p>Yang bertanda tangan dibawah ini :</p>

<table>
    <tr><td>Nama</td><td>: {{ $peminjaman->nama_peminjam }}</td></tr>
    <tr><td>Organisasi/Club</td><td>: -</td></tr>
    <tr><td>Nomor HP</td><td>: {{ $peminjaman->no_hp }}</td></tr>
    <tr><td>Acara</td><td>: Penggunaan {{ $peminjaman->fasilitas->nama }}</td></tr>
    <tr><td>Tanggal Pelaksanaan</td>
        <td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
    </tr>
</table>

<div class="mt-20">
<p>Dengan ini menyatakan sebagai berikut:</p>

<ol>
<li>Bertanggung jawab menjaga keamanan, ketertiban dan kebersihan di lingkungan gedung.</li>
<li>Bertanggung jawab apabila ada kerusakan fasilitas selama kegiatan berlangsung.</li>
<li>Bersedia memperbaiki kerusakan yang ditimbulkan selama kegiatan.</li>
<li>Apabila administrasi belum diselesaikan maka kegiatan dapat dibatalkan.</li>
<li>Tidak memberikan izin kepada pedagang untuk berjualan di area fasilitas.</li>
<li>Menerima kondisi dan keadaan fasilitas saat ini.</li>
</ol>
</div>

<div class="mt-40">
    <table width="100%">
        <tr>
            <td>
                Kasi Standarisasi dan Infrastruktur Olahraga,
                <br><br><br><br>
                <strong>ARIE DWI DEBRATA, S.Pd., M.Pd</strong>
            </td>

            <td align="right">
                Jambi, {{ date('Y') }}<br>
                Pemakai,
                <br><br><br><br>
                _______________________
            </td>
        </tr>
    </table>
</div>

</body>
</html>