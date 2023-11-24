<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.printPage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/moment-with-locales.js') }}"></script>
    <title>Document</title>

    <style>
        body {
            font-family: "Courier New", monospace;
            font-size: 10px;
        }

        .page-header {
        display: block;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000; /* Menambahkan z-index untuk memastikan page-header muncul di atas elemen lainnya */
    }

    .page-content {
        margin-top: 75px; /* Sesuaikan dengan tinggi page-header */
        width: 100%;
        page-break-inside: avoid; /* Tambahkan properti ini */
    }

    /* Gaya cetak */
    @media print {
        .page-header {
            position: fixed;
            top: 0;
            z-index: 1000; /* Menambahkan z-index untuk memastikan page-header muncul di atas elemen lainnya */
        }

        .page-content {
            margin-top: 75px; /* Sesuaikan dengan tinggi page-header */
            width: 100%;
            page-break-inside: avoid; /* Tambahkan properti ini */
        }

        /* Add a page break before each .page-header when printing */
        .page-header {
            page-break-before: always;
        }

        /* Properti untuk elemen setelah page-header yang melanjutkan tabel */
        .table-continuation {
            page-break-before: always;
        }
    }
        #table-laporan thead th {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
        }

        #table-laporan tbody {
            border-bottom: 1px dashed #000;
        }

        p {
            padding: 0 !important;
            margin: 0 !important;
        }

        .tbody-padding>td {
            padding: 0 !important;
        }
    </style>
</head>
<body>
    <div class="page-header row">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p>PT. TRIMITRA BATERAI PRAKASA</p>
                    <p>Stock Movement Report In <b>PCM</b></p>
                    <p>From {{\Carbon\Carbon::parse($data['startDate'])->format('d/m/Y')}} To {{\Carbon\Carbon::parse($data['endDate'])->format('d/m/Y')}}</p>
                    <p>Report In Quantity</p>
                </div>
    
                <div>
                    <p>Form No. : SD/FM/ACC/020</p>
                    <p>Rev. No/Date : 00/01 Des 2017</p>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <table class="table table-borderless" id="table-laporan">
            <thead>
                <tr>
                    <th class="px-0 py-2 m-0 fw-normal">Group</th>
                    <th class="px-0 py-2 m-0 fw-normal col-2">Stockcode</th>
                    <th class="px-0 py-2 m-0 fw-normal">Description</th>
                    <th class="px-0 py-2 m-0 fw-normal text-end">Open-Bal</th>
                    <th class="px-0 py-2 m-0 fw-normal text-end">Transfer In</th>
                    <th class="px-0 py-2 m-0 fw-normal text-end">Production</th>
                    <th class="px-0 py-2 m-0 fw-normal text-end">Usage(BOM)</th>
                    <th class="px-0 py-2 m-0 fw-normal text-end">Transfer Out</th>
                    <th class="px-0 py-2 m-0 fw-normal text-end">Adjust</th>
                    <th class="px-0 py-2 m-0 fw-normal text-end">Scrap</th>
                    <th class="px-0 py-2 m-0 fw-normal text-end">Ending</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $resultCollection = collect($result); // Convert $result to a collection
                    $groupedData = $resultCollection->groupBy('GROUPCODE');
                @endphp
        
                @foreach ($groupedData as $group => $groupItems)
                    @foreach ($groupItems as $val)
                        <tr class="tbody-padding">
                            <td>{{ $group }}</td>
                            <td>{{ $val->IDSTOCK }}</td>
                            <td>{{ $val->KET }}</td>
                            <td class="text-end">{{ number_format($val->QTYOPEN, 2) }}</td>
                            <td class="text-end">{{ number_format($val->QTYBTI + $val->QTYBTC, 2) }}</td>
                            <td class="text-end">{{ number_format($val->QTYPRD, 2) }}</td>
                            <td class="text-end">{{ number_format($val->QTYMFU, 2) }}</td>
                            <td class="text-end">{{ number_format($val->QTYBTO + $val->QTYBRB, 2) }}</td>
                            <td class="text-end">{{ number_format($val->QTYADJ, 2) }}</td>
                            <td class="text-end">{{ number_format($val->QTYSCP + $val->QTYRCY, 2) }}</td>
                            <td class="text-end">{{ number_format($val->ENDING, 2) }}</td>
                        </tr>
                    @endforeach
        
                    {{-- Display total for the current group --}}
                    <tr class="py-3">
                        <td class="px-0"></td>
                        <td class="px-0">Total For Group {{ $group }}</td>
                        <td class="px-0"></td>
                        <td class="px-0 text-end">{{ number_format($groupItems->sum('OpenBal'), 2) }}</td>
                        <td class="px-0 text-end">{{ number_format($groupItems->sum('TransferIn'), 2) }}</td>
                        <td class="px-0 text-end">{{ number_format($groupItems->sum('Production'), 2) }}</td>
                        <td class="px-0 text-end">{{ number_format($groupItems->sum('UsageBOM'), 2) }}</td>
                        <td class="px-0 text-end">{{ number_format($groupItems->sum('TransferOut'), 2) }}</td>
                        <td class="px-0 text-end">{{ number_format($groupItems->sum('Adjust'), 2) }}</td>
                        <td class="px-0 text-end">{{ number_format($groupItems->sum('Scrap'), 2) }}</td>
                        <td class="px-0 text-end">{{ number_format($groupItems->sum('Ending'), 2) }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td class="px-0"></td>
                    <td class="text-center px-0">Total for Whse PCM</td>
                    <td class="px-0"></td>
                    <td class="text-end px-0">{{ number_format(0.00, 2) }}</td>
                    <td class="text-end px-0">{{ number_format(0.00, 2) }}</td>
                    <td class="text-end px-0">{{ number_format(0.00, 2) }}</td>
                    <td class="text-end px-0">{{ number_format(0.00, 2) }}</td>
                    <td class="text-end px-0">{{ number_format(0.00, 2) }}</td>
                    <td class="text-end px-0">{{ number_format(0.00, 2) }}</td>
                    <td class="text-end px-0">{{ number_format(0.00, 2) }}</td>
                    <td class="text-end px-0">{{ number_format(0.00, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="page-footer mt-3">
        <div class="d-flex justify-content-end align-items-center">
            <div class="me-3">
                <p class="text-center">Approved</p>
                <br><br><br>
                <span>(..............)</span>
            </div>
            <div>
                <p class="text-center">Checked</p>
                <br><br><br>
                <span>(..............)</span>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function () {
            var headerHeight = $('.page-header').outerHeight();
            var pageContent = $('.page-content');

            // Saat halaman selesai dicetak
            window.onafterprint = function () {
                var printedTableHeight = pageContent.height();
                var newMargin = printedTableHeight + headerHeight;
                pageContent.css('margin-top', newMargin + 'px');
            };
        });
</script>
</html>