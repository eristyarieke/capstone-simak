<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Guru</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 20px; }
        .header p { margin: 5px 0; font-size: 12px; color: #555; }
        
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        
        .info { margin-bottom: 15px; font-size: 12px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h1>LAPORAN DATA GURU</h1>
        <p>SDN KENDANGSARI III</p>
        <p>Jl. Raya Tenggilis Mejoyo No. 3, Kali Rungkut, Kec. Rungkut, Kota Surabaya, Jawa Timur 60293</p>
    </div>

    <div class="info">
        <strong>Filter Data:</strong> <br>
        Jabatan: {{ $filter_jabatan }} <br>
        Tahun Ajaran: {{ $filter_tahun }} <br>
        Tanggal Cetak: {{ date('d-m-Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%" class="text-center">No</th>
                <th style="width: 30%">Nama Guru</th>
                <th style="width: 20%">Jabatan</th>
                <th style="width: 10%" class="text-center">L/P</th>
                <th style="width: 15%">Agama</th>
                <th style="width: 20%">Tahun Ajaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gurus as $guru)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $guru->nama }}</td>
                <td>{{ $guru->jabatan }}</td>
                <td class="text-center">{{ $guru->jenis_kelamin }}</td>
                <td>{{ $guru->agama }}</td>
                <td>{{ $guru->tahunAjaran->nama_tahun ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>