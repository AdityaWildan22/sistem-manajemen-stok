<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data Stock Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-container {
            margin: 0 auto;
            width: 95%;
        }
    </style>
</head>

<body>
    <h1>Data Stock Keluar</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No Transaksi</th>
                    <th>Tanggal Keluar</th>
                    <th>Nama User</th>
                    <th>Nama Barang</th>
                    <th>Area</th>
                    <th>Line</th>
                    <th>Drawing</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockout as $item)
                    @foreach ($item->details as $detail)
                        <tr>
                            <td>{{ $item->no_trans }}</td>
                            <td>{{ Carbon\Carbon::parse($item->tgl_keluar)->format('d-m-Y') }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $detail->material->nm_brg }}</td>
                            <td>{{ $detail->area->nm_area }}</td>
                            <td>{{ $detail->line->no_line }}</td>
                            <td>{{ $detail->drawing->no_drw }}</td>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
