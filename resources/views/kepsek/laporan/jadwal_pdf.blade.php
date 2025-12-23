<!DOCTYPE html>
<html>
<head>
    <title>Laporan Jadwal Pelajaran</title>
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
        .font-bold { font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h1>LAPORAN JADWAL PELAJARAN</h1>
        <p>SDN KENDANGSARI III</p>
        <p>Jl. Raya Tenggilis Mejoyo No. 3, Kali Rungkut, Kec. Rungkut, Kota Surabaya, Jawa Timur 60293</p>
    </div>

    <div class="info">
        <strong>Filter Data:</strong> <br>
        Tahun Ajaran: {{ $filter_tahun }} <br>
        Kelas: {{ $filter_kelas }} <br>
        Hari: {{ $filter_hari }} <br>
        Tanggal Cetak: {{ date('d-m-Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%">Hari</th>
                <th style="width: 15%" class="text-center">Jam</th>
                <th style="width: 15%" class="text-center">Kelas</th>
                <th style="width: 30%">Mata Pelajaran</th>
                <th style="width: 30%">Guru Pengampu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwals as $jadwal)
            <tr>
                <td class="font-bold">{{ $jadwal->hari }}</td>
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - 
                    {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                </td>
                <td class="text-center">{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $jadwal->mapel->nama_mapel ?? '-' }}</td>
                <td>{{ $jadwal->guru->nama ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>