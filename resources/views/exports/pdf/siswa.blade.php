<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table style="width: 100%" border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>No Telp</th>
                <th>Tahun Masuk</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['siswa'] as $siswa)

            <tr>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nama_siswa }} </td>
                <td>{{ $siswa->no_telp }}</td>
                <td>{{ $siswa->tahun_masuk }}</td>
                <td>{{ $siswa->alamat }}</td>
                <td>{{ $siswa->jenis_kelamin }}</td>
                <td>{{ $siswa->kelas->nama_kelas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
