<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMat | Data Stok Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 950px;
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

        .dtstockin {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        .dtstockin th,
        .dtstockin td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-size: 17px;
        }

        .dtstockin th {
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
            max-width: 780px;
            padding: 0;
            margin: 0;
            font-size: 25px;
        }

        .logo p {
            max-width: 800px;
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
                <img src="{{ public_path('img/backgrounds/kop.png') }}" alt="Logo Perusahaan">
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
            <h4>LAPORAN DATA STOK MASUK</h4>
        </div>
        <div class="content">
            <div class="details">
                <table class="dtstockin" style="width: 100%; border:1px solid #000">
                    <thead style="font-weight:100">
                        <tr>
                            <th>Nota</th>
                            <th>Tanggal Masuk</th>
                            <th>Nama Barang</th>
                            <th>Request by Enginer</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stockin as $item)
                            @foreach ($item->details as $detail)
                                <tr>
                                    <td>{{ $item->no_trans }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tgl_masuk)->format('d-m-Y') }}</td>
                                    <td>{{ $detail->material->nm_brg }}</td>
                                    <td>{{ $item->enginer->name }}</td>
                                    <td>{{ $detail->satuan }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
