<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data Material</title>
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
    <h1>Data Material</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Size 1</th>
                    <th>Size 2</th>
                    <th>Thickness 1</th>
                    <th>Thickness 2</th>
                    <th>SCH</th>
                    <th>Tipe 1</th>
                    <th>Tipe 2</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Spesifikasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($material as $item)
                    <tr>
                        <td>{{ $item->kd_brg }}</td>
                        <td>{{ $item->nm_brg }}</td>
                        <td>{{ $item->category->nm_cat }}</td>
                        <td>{{ $item->subcategories->nm_subcat }}</td>
                        <td>{{ $item->size1 }}</td>
                        <td>{{ $item->size2 }}</td>
                        <td>{{ $item->thickness1 }}</td>
                        <td>{{ $item->thickness2 }}</td>
                        <td>{{ $item->SCH }}</td>
                        <td>{{ $item->type1 }}</td>
                        <td>{{ $item->type2 }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>{{ $item->specification }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
