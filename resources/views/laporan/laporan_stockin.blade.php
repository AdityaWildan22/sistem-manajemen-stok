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
                    <th>No. Transaksi</th>
                    <th>Tanggal Masuk</th>
                    <th>Supervisor</th>
                    <th>Material</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockins as $stockin)
                    @foreach ($stockin->details as $detail)
                        <tr>
                            <td>{{ $stockin->no_trans }}</td>
                            <td>{{ $stockin->tgl_masuk }}</td>
                            <td>{{ $stockin->user->name }}</td>
                            <td>{{ $detail->material->nm_brg }}</td>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        @if ($stockins->isEmpty())
            <h4 style="margin-top: 20px; text-align:center">DATA STOK MASUK KOSONG</h4>
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
