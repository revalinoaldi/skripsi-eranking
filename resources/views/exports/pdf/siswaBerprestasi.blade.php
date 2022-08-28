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
                <th>Kelas</th>
                <th>Ranking</th>
                <th>Rata Rata</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['siswa'] as $siswa)

            <tr>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nama_siswa }} </td>
                <td>{{ $siswa->nama_kelas }}</td>

                <td>{{ $loop->iteration }}</td>
                <td>{{ @$siswa->total_rata_rata ? $siswa->total_rata_rata : 0 }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>
