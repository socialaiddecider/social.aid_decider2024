<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            border-collapse: collapse;
            width: 100%;
        }

        #c td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #0D4C7E;
            color: white;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <center>
        <h3>Data Hasil Akhir</h3>
    </center>

    <table id="customers">
        <tr>
            <th>No</th>
            <th>Alternatif</th>
            @foreach ($kriteria as $k)
                <th scope="col">{{ $k->kode_kriteria }}</th>
            @endforeach
            <th>Nilai Akhir</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($penerima as $a)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{ $a->alternatif->nama }}</td>
                    @foreach ($kriteria as $k)
                        <td align="center">
                            {{ $penilaian->where('alternatif_id', $a->alternatif_id)->where('kriteria_id', $k->id)->first()->nilai ?? '-' }}
                        </td>
                    @endforeach
                    <td align="center">{{ $a->nilai }}</td>
                    <td align="center">{{ $a->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
