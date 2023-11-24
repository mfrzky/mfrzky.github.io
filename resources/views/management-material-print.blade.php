<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <title>Management Material</title>

    <style>
        @page {
            size: landscape;
            height: 105mm;
            width: 148mm;
            margin: 2mm;
        }

        .font-8 {
            font-size: 8px !important;
        }

        .font-12 {
            font-size: 12px !important;
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

        hr {
            display: block;
            height: 1px;
            border: 0;
            border-top: 1px solid #000000;
            margin: 1em 0;
            padding: 0;
            opacity: 1 !important;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <p class=" p-0 m-0">{{$printManagementMaterialData->NAMA}}</p>
        <p class="">LAPORAN PRODUKSI</p>
        <p class=" text-end">NAMA : {{$printManagementMaterialData->NAMA}}</p>
    </div>

    <hr>
    
    <div class="page-content">
        <div class="row">
            <div class="col-5">
                <ul class="p-0 m-0">
                    <li class="m-0"><b>Nomor Urut</b>: {{$printManagementMaterialData->IDDOCKET}}</li>
                    <li class="m-0"><b>Tanggal</b>: {{$printManagementMaterialData->TGLDOCKET}}</li>
                    <li class="m-0"><b>Nomor PI</b>: IDPINO</li>
                    <li class="m-0"><b>Kode Barang</b>: <span class="fw-bold">{{$printManagementMaterialData->IDSTOCK}}</span></li>
                    <li class="m-0"><b>Jumlah</b>: {{number_format((float)$printManagementMaterialData->QUANTITY , 0 , '.' , ',' )}}</li>
                </ul>
            </div>
            <div class="col-3">
                <ul class="p-0 m-0">
                    <li class="m-0"><b>Shift</b>: {{$printManagementMaterialData->IDSHIFT}}</li>
                </ul>
            </div>
            <div class="col-3">
                <ul class="p-0 m-0">
                    <li class="m-0"><b>Kode Scrap</b>: {{$printManagementMaterialData->IDSCRAP}}</li>
                </ul>
            </div>
        </div>
    </div>

    <hr>

</body>
</html>