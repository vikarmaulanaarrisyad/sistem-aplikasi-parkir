<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Parkir</title>

    <link rel="stylesheet" href="{{ public_path('/AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body>

    <h4 class="text-center">Laporan Parkir PHB</h4>
    <p class="text-center">
        Tanggal {{ tanggal_indonesia($start) }}
        s/d
        Tanggal {{ tanggal_indonesia($end) }}
    </p>

    <table class="table table-striped table-sm" style="width: 100%">
        <thead>
            <tr>
                <th style="text-align: center">No</th>
                <th style="text-align: center">Hari / Tanggal</th>
                <th style="text-align: center">Petugas</th>
                <th style="text-align: center">Status</th>
                <th style="text-align: center">Jam Masuk</th>
                <th style="text-align: center">Jam Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                @foreach ($row as $key => $col)
                    <td {!! $row > 1 ? 'class="text-left"' : '' !!}>{!! $col !!}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
