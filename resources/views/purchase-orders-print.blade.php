
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="{{ asset('/js/jquery.printPage.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/moment-with-locales.js') }}"></script>

        <title>TBP - VENDOR PORTAL</title>

        <style>
            @page {
                width: 148mm;
                height: 210mm;
                margin: 2mm;
            }

            @media print {
                thead { display: table-header-group; }
                /* .table-print {
                    page-break-before: always;
                } */
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

            .page-header, .page-header-space {
                height: 155px;
            }

            .page-footer, .page-footer-space {
                height: 160px;
            }

            .page-header {
                position: fixed;
                top: 0;
                width: 100%;
            }

            .page-content {
                margin-top: 120px;
                width: 100%;
            }

            .page-content-space {
                margin-top: 120px;
                width: 100%;
            }

            .page-footer {
                margin-bottom: 90mm;
                position: fixed;
                bottom: 0;
                width: 100%;
            }

            .pagebreak {
                page-break-after: always;
            }

            p, li, table {
                font-size: 8px;
            }
            h6 {
                font-size: 12px;
            }

            .font-10 {
                font-size: 10px;
            }

            .font-11 {
                font-size: 11px;
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

            @-moz-document url-prefix() {
                .border-bottom {
                    border-bottom: 2px solid #000000 !important;
                }
                hr {
                    display: block;
                    height: 1px;
                    border: 0;
                    border-top: 2px solid #000000;
                    margin: 1em 0;
                    padding: 0;
                    opacity: 1 !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="page-header">
            <div class="row" style="margin-right: 0;">
                <div class="col-2 p-0 m-0">
                    <div class="d-flex justify-content-center align-middle align-items-center mt-3">
                        <img src="{{ asset('assets/images/LogoTBP.jpg') }}" alt="TBP" height="50" width="50" >
                    </div>
                </div>

                <div class="col p-0 m-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <h6 class="fw-bold p-0 m-0">PT. TRIMITRA BATERAI PRAKASA</h6>
                        </div>
                        <h6 class="border px-3 p-0 m-0">
                            Doc. No : SD/FM/LOG/04
                        </h6>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="m-0">Jl.Semper Timur No.3</p>
                            <p class="m-0">Cilincing - Jakarta 14130</p>
                            <p class="m-0">INDONESIA</p>
                            <ul class="p-0 m-0">
                                <li class="m-0"><b>Tel</b>: 021-4403066 (Hunting)</li>
                                <li class="m-0"><b>Fax</b>: 021-4401763</li>
                                <li class="m-0"><b>N.P.W.P</b>: 01.769.964. 6-046.000</li>
                            </ul>
                        </div>
                        <div class="w-50">
                            <div class="row">
                                <span class="font-11 text-end fw-bold">
                                    PURCHASE ORDER LOCAL
                                </span>
                                <div class="col-6">
                                    <p class="font-10 fw-bold p-0 m-0">
                                        SKK No : 
                                    </p>
                                    <p class="font-10 fw-bold p-0 m-0">
                                        Fax No : {{$printPoData->FAX}}
                                    </p>
                                </div>
                                <div class="col text-end">
                                    <p class="font-10 fw-bold p-0 m-0">
                                        No. : {{$printPoData->IDPO}}
                                    </p>
                                    <p class="font-10 fw-bold p-0 m-0">
                                        Date : <span id="tglPo"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
        
                </div>
                
                <hr class="p-0 m-0">
                <div class="d-flex justify-content-between">
                    <p class="font-11 w-50 fw-bold p-0 m-0">
                        {{$printPoData->NAMA_VENDOR}},<br> {{$printPoData->ALAMAT}}
                    </p>
                    <div class="row w-75 ms-5">
                        <div class="col-4 col-sm-5 p-0 m-0">
                            <p class="font-10 fw-bold p-0 m-0">Term of Payment</p>
                            <p class="font-10 fw-bold p-0 m-0">{{$printPoData->DAYS}} Days</p>
                        </div>
                        <div class="col-1 ps-1 m-0">
                            <p class="font-10 fw-bold p-0 m-0">CURR</p>
                            <p class="font-10 fw-bold p-0 m-0">{{$printPoData->IDCURRENCY}}</p>
                        </div>
                        <div class="col-3 ps-3 ms-3 m-0">
                            <p class="font-10 fw-bold p-0 m-0">TAX</p>
                            <p class="font-10 fw-bold p-0 m-0">{{$printPoData->PKP == 1 ? 'PKP' : 'NON PKP'}}</p>
                        </div>
                        <div class="col p-0 m-0">
                            <p class="font-10 fw-bold p-0 m-0">Delivery Time</p>
                            <p class="font-10 fw-bold p-0 m-0"><span id="deliveryTime"></span></p>
                        </div>
                    </div>
                </div>
                <hr class="p-0 m-0">
            </div>
        </div>

        <div class="page-content">
            <table class="table table-borderless table-print">
                <thead class="border-bottom border-secondary">
                    <tr>
                        <th class="p-0">No.</th>
                        <th class="p-0">Description</th>
                        <th class="p-0 text-end pe-3">Quantity</th>
                        <th class="p-0">Kode Brg</th>
                        <th class="p-0 text-end">Unit Price</th>
                        <th class="p-0 text-end">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($printPoItem as $key => $item)
                        <tr>
                            <td class="p-0">{{$key + 1}}</td>
                            <td class="p-0">{{$item->BARANGTIPE}}</td>
                            <td class="p-0 text-end pe-3">{{number_format((float)$item->QUANTITY , 0 , '.' , ',' )}}</td>
                            <td class="p-0">{{$item->IDBARANG}}</td>
                            <td class="p-0 text-end">{{number_format((float)$item->HARGA , 0 , '.' , ',' )}}</td>
                            <td class="p-0 text-end">{{number_format((float)$item->HARGA * $item->QUANTITY, 0 , '.' , ',' )}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            <div class="float-end subtotal">
                <ul>
                    <li><b>Subtotal</b>: {{$printPoData->TOTAL_PO ? number_format((float)$printPoData->TOTAL_PO, 0 , '.' , ',' ) : 0}}</li>
                    @if ($printPoData->DISCPERCENT != 0)
                        <li><b>Discount {{$printPoData->DISCPERCENT}}</b>: {{$printPoData->DISCPERCENT * $subtotal}}</li>
                    @elseif($printPoData->DISCAMOUNT != 0)
                        <li><b>Discount</b>: {{$printPoData->DISCAMOUNT}}</li>
                    @else
                        <div></div>
                    @endif
                    <li><b>Netto</b>: {{$netto ? number_format((float)$netto, 0 , '.' , ',' ) : 0}}</li>
                    <li>
                        <b>
                            PPN {{$printPoData->PCT_PPN ? $printPoData->PCT_PPN * 100 : 10}}%
                        </b>: 
                        {{$printPoData->NILAIPPN ? number_format((float)$printPoData->NILAIPPN * 100 , 0 , '.' , ',' ) : 0}}
                    </li>
                    @if ($printPoData->FPPNPBBKB != 'N')
                        <li>
                            <b>PBBKB</b>: {{$printPoData->PPNPBBKB}}
                        </li>
                    @else
                        <div></div>
                    @endif
                    <li><b>Total</b>: {{$netto && $printPoData->NILAIPPN ? number_format((float)$netto + $printPoData->NILAIPPN, 0 , '.' , ',' ) : 0}}</li>
                </ul>
            </div>
        </div>

        <div class="page-footer">
            <hr class="p-0 m-0 mb-1">
            <div class="d-flex p-0 m-0">
                <div class="col-2 pe-0 m-0">
                    <p class="p-0 m-0">Supplier Confirmation</p>
                    <p>Acc Supl : {{$printPoData->ACCSUPL}}</p>
                </div>
                <div class="col-5 p-0 m-0">
                    <ul>
                        <li><b>Code</b>: 1294000000 (K00058)</li>
                        <li><b>PR No.</b>: {{$printPoData->IDPR}}</li>
                        <li><b>Date Rec</b>: 0669/GAF/2023 (  )</li>
                        <li><b>User</b>: 08/01/2023 (  )</li>
                        <li><b>Receiver</b>: {{$printPoData->WHSCODE}}</li>
                    </ul>
                </div>
                <div class="col-5">
                    <p class="text-center p-0 m-0">PT. TRIMITRA BATERAI PRAKASA</p>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="p-0 m-0">Disetujui</p>
                            @if ($ttdApprove)
                                <img src="data:image/png;base64, {{ $ttdApprove }}" alt="Disetujui" height="70" width="70">
                            @endif
                        </div>
                        <div>
                            <div class="d-flex justify-content-between">
                                <p class="p-0 m-0">Diperiksa</p>
                                @if ($parafCheck)
                                    <img src="data:image/png;base64, {{ $parafCheck }}" alt="Disetujui" height="25" width="25" class="position-absolute ms-5">
                                @endif
                            </div>
                            @if ($ttdCheck)
                                <img src="data:image/png;base64, {{ $ttdCheck }}" alt="Diperiksa" height="70" width="70">
                            @endif
                        </div>
                        <div>
                            <div class="d-flex justify-content-between">
                                <p class="p-0 m-0">Dibuat</p>
                                @if ($parafInput)
                                    <img src="data:image/png;base64, {{ $parafInput }}" alt="Disetujui" height="25" width="25" class="position-absolute ms-5">
                                @endif
                            </div>
                            @if ($ttdPre)
                                <img src="data:image/png;base64, {{ $ttdPre }}" alt="Dibuat" height="70" width="70">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="page-number p-0 m-0"></div>
    
                <p class="p-0 m-0">Remarks :</p>
                <p>PO ini berlaku bila disetujui oleh pejabat yang berwenang</p>
            </div>
        </div>
    </body>
    
    <script type="text/javascript">
        // $("<div class='page-header-space'></div>").insertBefore(".table-print thead tr");

        var rowsPerPage = 8;
        var totalRows = $('.table-print tbody tr').length;

        for (var i = rowsPerPage; i < totalRows; i += rowsPerPage) {
            $("<div class='page-content-space'></div>").insertAfter(".table-print tbody tr:nth-child(" + (i) + ")");
            $("<div class='pagebreak'></div>").insertAfter(".table-print tbody tr:nth-child(" + (i) + ")");
        }

        $('#tglPo').html(moment('{{$printPoData->TANGGALPO}}').format('DD MMM YYYY'));
        $('#deliveryTime').html(moment('{{$printPoData->TGLDELIVERY}}').format('DD MMM YYYY'));
    </script>
</html>
