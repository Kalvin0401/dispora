<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form Peminjaman</title>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 3px 0;
            font-size: 11px;
        }

        .section-title {
            margin-top: 20px;
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td {
            padding: 6px;
            vertical-align: top;
        }

        .label {
            width: 30%;
            font-weight: bold;
        }

        .box {
            border: 1px solid #ccc;
            padding: 8px;
            margin-top: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }

        .ttd {
            margin-top: 60px;
            text-align: right;
        }

        .highlight {
            font-size: 14px;
            font-weight: bold;
        }

    </style>
</head>
<body>

<div class="header">
    <h2>FORM PEMAKAIAN FASILITAS</h2>
    <p>SIP DISPORA</p>
    <p>Dinas Pemuda dan Olahraga</p>
</div>

<div class="section-title">Data Peminjaman</div>

<table>
    <tr>
        <td class="label">Nama Peminjam</td>
        <td>: {{ $peminjaman->nama_peminjam }}</td>
    </tr>
    <tr>
        <td class="label">No HP</td>
        <td>: {{ $peminjaman->no_hp }}</td>
    </tr>
    <tr>
        <td class="label">Organisasi</td>
        <td>: {{ $peminjaman->organisasi ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">Acara / Kegiatan</td>
        <td>: {{ $peminjaman->acara }}</td>
    </tr>
    <tr>
        <td class="label">Jumlah Peserta</td>
        <td>: {{ $peminjaman->jumlah_peserta }}</td>
    </tr>
</table>

<div class="section-title">Detail Fasilitas</div>

<table>
    <tr>
        <td class="label">Nama Fasilitas</td>
        <td>: {{ $peminjaman->fasilitas->nama }}</td>
    </tr>
    <tr>
        <td class="label">Bagian</td>
        <td>: {{ $peminjaman->bagian->nama_bagian ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">Tanggal Pinjam</td>
        <td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
    </tr>
    <tr>
        <td class="label">Durasi</td>
        <td>:
            {{ $peminjaman->durasi }}
            {{ $peminjaman->bagian->satuan ?? 'hari' }}
        </td>
    </tr>
</table>

<div class="section-title">Biaya</div>

<div class="box">
    Total Biaya:
    <span class="highlight">
        Rp {{ number_format($peminjaman->total_biaya,0,',','.') }}
    </span>
</div>

<div class="section-title">Status</div>

<table>
    <tr>
        <td class="label">Status Permohonan</td>
        <td>: {{ ucfirst($peminjaman->status) }}</td>
    </tr>
</table>

<div class="footer">
    Dicetak pada:
    {{ now()->format('d M Y H:i') }}
</div>

</body>
</html>