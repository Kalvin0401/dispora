<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
body { font-family: DejaVu Sans; font-size: 12px; }
.header { text-align: center; margin-bottom: 20px; }
.logo { width: 80px; }
.title { font-size: 18px; font-weight: bold; margin-top: 10px; }
.box { border:1px solid #ccc; padding:15px; margin-top:15px; }
table { width:100%; border-collapse: collapse; margin-top:10px; }
td { padding:6px 0; }
.total { font-size:16px; font-weight:bold; color:#059669; }
.watermark {
    position: fixed;
    top: 40%;
    left: 25%;
    font-size: 60px;
    color: rgba(0,200,0,0.1);
    transform: rotate(-30deg);
}
.footer { margin-top:40px; font-size:10px; text-align:right; }
</style>
</head>
<body>

@if($peminjaman->pembayaran->status == 'valid')
<div class="watermark">LUNAS</div>
@endif

<div class="header">
    <img src="https://tse1.mm.bing.net/th/id/OIP.l1Xy2vN2mS6p4FnfeZQyygHaFP?rs=1&pid=ImgDetMain&o=7&rm=3" class="logo">
    <div class="title">INVOICE PEMBAYARAN</div>
    <div>SISTEM INFORMASI PEMINJAMAN FASILITAS DISPORA</div>
</div>

<div class="box">
    <table>
        <tr>
            <td>Nama Peminjam</td>
            <td>: {{ $peminjaman->nama_peminjam }}</td>
        </tr>
        <tr>
            <td>Fasilitas</td>
            <td>: {{ $peminjaman->fasilitas->nama }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
        </tr>
        <tr>
            <td>Durasi</td>
            <td>: {{ $peminjaman->durasi }} {{ $peminjaman->bagian->satuan ?? 'hari' }}</td>
        </tr>
        <tr>
            <td>Status Pembayaran</td>
            <td>: {{ ucfirst($peminjaman->pembayaran->status) }}</td>
        </tr>
    </table>

    <hr>

    <table>
        <tr>
            <td>Total Pembayaran</td>
            <td class="total">
                Rp {{ number_format($peminjaman->total_biaya,0,',','.') }}
            </td>
        </tr>
    </table>
</div>

<div class="footer">
    Dicetak pada: {{ now()->format('d M Y H:i') }}
</div>

</body>
</html>