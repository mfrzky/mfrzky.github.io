<!DOCTYPE html>
<html>
<head>
    <title>Trimitra Baterai Prakasa</title>

    <style>
        body {
            color: black !important;
        }

        table {
            color: black !important;
        }

        ul {
            list-style: none;
            display: table;
        }

        li {
            display: table-row;
        }

        b {
            font-weight: normal;
            display: table-cell;
            padding-right: 1em;
        }
    </style>
</head>
    <body>  
        <p><span style="color: black;">Dari : </span>{{session('user')->EMAIL ? session('user')->EMAIL : 'User'}}</p>
        <div>
            <div>
                <ul class="p-0 m-0 list-unstyled" style="list-style: none; padding: 0;">
                    <li class="p-0 m-0" style="color: black;"><b>Sudah dikirim untuk PO No</b>: {{$idPo}}</li>
                    <li class="p-0 m-0" style="color: black;"><b>No Surat Jalan</b>: {{$noSj}}</li>
                    <li class="p-0 m-0" style="color: black;"><b>Tertanggal</b>: {{now()->format('d-m-Y ')}}</li>
                </ul>
            </div>
                <div>
                    <p style="color: black;">Dengan barang-barang sebagai berikut : </p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sjItems as $key => $val)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$val->DESKRIPSI}}</td>
                                    <td style="text-align: right !important;">
                                        {{ number_format($val->QTY_SJ, 2)}}
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
        
        <p style="color: black;">Terima Kasih</p>
    </body>
</html>