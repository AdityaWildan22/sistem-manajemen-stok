<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMat | Data Material</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            /* max-width: 950px; */
            margin: 0 auto;
            padding: 20px;
        }

        .header h4 {
            text-align: center;
            padding: 10px 0;
            margin: 0;
        }

        .content {
            /* margin-bottom: 20px; */
            font-size: 20px;
        }

        .footer {
            text-align: center;
            font-size: 20px;
            margin: 0;
            padding: 0;
        }

        .dtmaterial {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        .dtmaterial th,
        .dtmaterial td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-size: 17px;
        }

        .dtmaterial th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .kop-surat img {
            /* margin-top: 3px; */
            max-width: 200px;
            /* margin-bottom: 5px; */
            float: left;
            padding: 0;
        }

        .logo {
            display: block;
            line-height: 1;
            text-align: center;
            /* margin-bottom: 5px; */
        }

        .logo h3 {
            max-width: 1050px;
            padding: 0;
            margin: 0;
            font-size: 25px;
        }

        .logo p {
            max-width: 1050px;
            padding: 0;
            margin: 0;
            font-size: 18px;
        }

        .garis-bawah {
            border-bottom: 2px solid #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="kop-surat">
            <div class="logo">
                <img src="{{ asset('img/backgrounds/kop.png') }}" alt="Logo Perusahaan">
                <h3>PT. Timas Tarakan</h3>
                <p>Kec. Tarakan Tengah, Kota Tarakan, Kalimantan Utara
                    <br>
                    Telp: 0821 3012 8665
                </p>
            </div>
            <div style="clear: both;"></div>
            <div class="garis-bawah"></div>
        </div>
        <div class="header">
            <h4>LAPORAN DATA MATERIAL</h4>
        </div>
        <div class="content">
            <div class="details">
                <table class="dtmaterial" style="width: 100%; border:1px solid #000">
                    <thead style="font-weight:100">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Size 1</th>
                            <th>Size 2</th>
                            <th>Thickness 1</th>
                            <th>Thickness 2</th>
                            <th>SCH</th>
                            <th>Tipe 1</th>
                            <th>Tipe 2</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials as $item)
                            <tr>
                                <td>{{ $item->nm_brg }}</td>
                                <td>{{ $item->category->nm_cat }}</td>
                                <td>{{ $item->size1 }}</td>
                                <td>{{ $item->size2 }}</td>
                                <td>{{ $item->thickness1 }}</td>
                                <td>{{ $item->thickness2 }}</td>
                                <td>{{ $item->SCH }}</td>
                                <td>{{ $item->type1 }}</td>
                                <td>{{ $item->type2 }}</td>
                                <td>{{ $item->satuan }}</td>
                                <td>{{ $item->stok }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($materials->isEmpty())
                    <h6 style="margin-top: 20px; text-align:center">DATA STOK KELUAR KOSONG</h6>
                @endif
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
