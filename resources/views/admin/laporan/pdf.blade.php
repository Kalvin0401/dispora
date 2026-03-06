<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Laporan Peminjaman</title>
<style>
body { font-family: DejaVu Sans; font-size: 12px; }
table { width:100%; border-collapse: collapse; margin-top:20px; }
th, td { border:1px solid #000; padding:6px; }
th { background:#eee; }
h2 { text-align:center; }
</style>
</head>
<body>

<h2>LAPORAN PEMINJAMAN SARANA OLAHRAGA</h2>
<p>Periode: {{ \Carbon\Carbon::now()->subMonth()->format('d M Y') }}
    - {{ \Carbon\Carbon::now()->format('d M Y') }}</p>

<table>
<thead>
<tr>
<th>Tanggal</th>
<th>Nama</th>
<th>Fasilitas</th>
<th>Durasi</th>
<th>Status</th>
</tr>
</thead>

<tbody>
@foreach($data as $item)
<tr>
<td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
<td>{{ $item->nama_peminjam }}</td>
<td>{{ $item->fasilitas->nama }}</td>
<td>{{ $item->durasi }} {{ $item->bagian->satuan ?? 'hari' }}</td>
<td>{{ ucfirst(str_replace('_',' ',$item->status)) }}</td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>