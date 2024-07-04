<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data Material</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 20px auto;
            width: 95%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
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
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #f4f4f4;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .flex-container {
            display: flex;
            flex-direction: column;
        }

        .flex-item {
            flex: 1;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Material</h1>
        <table id="materialTable" class="display responsive nowrap">
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
                @foreach ($materials as $item)
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
        @if ($materials->isEmpty())
            <h4 style="margin-top: 20px; text-align:center">DATA MATERIAL KOSONG</h4>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#materialTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                lengthChange: true,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>

</html>
