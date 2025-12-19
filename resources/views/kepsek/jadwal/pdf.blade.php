<style>
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 9px;
}
th, td {
    border: 1px solid #000;
    padding: 4px;
    text-align: center;
    vertical-align: middle;
}
th {
    background: #f2f2f2;
}
small {
    font-size: 8px;
}
</style>

<h3 align="center">JADWAL PELAJARAN</h3>
<h4 align="center">
    TAHUN PELAJARAN {{ $tahun->tahun_ajaran }}
</h4>

<table>
    <tr>
    <th>Hari</th>
    <th>Waktu</th>
    @foreach($kelasList as $kelas)
        <th>{{ $kelas->nama_kelas }}</th>
    @endforeach
</tr>

    @foreach($hariList as $hari)
    @foreach($jamList as $jam)
    <tr>
        <td>{{ $hari }}</td>
        <td>{{ $jam }}</td>

        @foreach($kelasList as $kelas)
            @php
                $cell = $grid[$hari][$jam][$kelas->id_kelas] ?? null;
            @endphp
            <td>
                @if($cell)
                    <strong>{{ $cell->mapel->nama_mapel }}</strong><br>
                    <small>{{ $cell->guru->nama }}</small>
                @endif
            </td>
        @endforeach
    </tr>
    @endforeach
@endforeach

</table>
