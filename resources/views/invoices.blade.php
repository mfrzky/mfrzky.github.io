@include('welcome')
<div class="main" id="main-content">
    <header class="bg-header-menu">
      <div class="p-1">
        <i class="fa-solid fa-credit-card fa-xs"></i>
        <span>INVOICES</span>
      </div>
    </header>
  
    <div class="p-1">
      <table id="invoices-list" class="display cell-border" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No Invoices</th>
                <th>Tanggal</th>
                <th>No Faktur Pajak</th>
                <th>Tanggal Pajak</th>
                <th>Cur</th>
                <th>DPP</th>
                <th>PPN</th>
                <th>DPP + PPN</th>
                <th>PPH</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    
    <div class="p-1">
      <div class="p-1 w-100 bg-header-menu rounded-top d-flex justify-content-between align-items-center">
        <div>
            <i class="fa-solid fa-file-lines fa-xs"></i>
            <span>ITEMS</span>
        </div>
        <div>
            <button class="btn border-0 p-0" type="button" data-bs-toggle="modal" data-bs-target="#ModalInvoicesItemType">
                <i class="fa-solid fa-plus fa-xs"></i>
            </button>
        </div>
      </div>
      <table id="invoices-item" class="display cell-border" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No Surat Jalan</th>
                <th>No PO</th>
                <th>Tanggal Bayar</th>
                <th>Nilai</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  
    {{-- Modal Add Invoice --}}
    <div class="modal fade" id="ModalAddListInvoices" tabindex="-1" aria-labelledby="ModalAddListInvoices" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalAddListInvoicesLabel">Invoice</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <label for="noInvoices">No Invoices</label>
                        <label for="tgl" class="my-4">Tanggal</label>
                        <label for="cur" class="mt-2">Currency</label>
                        <label for="noFP" class="my-4">No Faktur Pajak</label>
                        <label for="tglPjk" class="mt-1">Tanggal Pajak</label>
                    </div>
                    <div class="col-9"> 
                        <form action="" id="formAddInvoice">
                            <div class="input-group">
                                <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" value="" id="noInvoices" required>
                            </div>
                            <div class="input-group mt-1">
                                <input type="date" class="form-control" value="" id="tgl" required>
                            </div>
                            <div class="input-group mt-1">
                                <select id="cur" class="form-select" required>
                                    <option hidden value="">Choose Cureency</option>
                                    <option value="IDR">IDR</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="input-group mt-1">
                                <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" value="" id="noFP" required>
                            </div>
                            <div class="input-group mt-1">
                                <input type="date" class="form-control" value="" id="tglPjk" required>
                            </div>

                            <div class="modal-footer border-0 px-0">
                                <button type="submit" class="btn btn-primary">OK</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>                 
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    
    {{-- Modal Invoices Item Type --}}
    <div class="modal fade" id="ModalInvoicesItemType" tabindex="-1" aria-labelledby="ModalInvoicesItemType" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalInvoicesItemTypeLabel">Invoices Item Type</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <button class="btn border w-100">
                    Uang Muka
                </button>
                <button class="btn border my-3 w-100" type="button" data-bs-toggle="modal" data-bs-target="#ModalDaftarSuratJalan">
                    Surat Jalan
                </button>
                <button class="btn border w-100" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
          </div>
        </div>
    </div>

    {{-- Modal Daftar PO --}}
    <div class="modal fade" id="ModalDaftarPO" tabindex="-1" aria-labelledby="ModalDaftarPOLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDaftarPOLabel">Purchase Orders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="daftar-po" class="display cell-border" cellspacing="0" width="100%">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Daftar Surat Jalan --}}
    <div class="modal fade" id="ModalDaftarSuratJalan" tabindex="-1" aria-labelledby="ModalDaftarSuratJalanLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDaftarSuratJalanLabel">Surat Jalan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="formAddItemInvoice">
                    <div class="modal-body">
                        <div>
                            <table id="daftar-surat-jalan" class="display cell-border" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No Surat Jalan</th>
                                        <th>Tanggal</th>
                                        <th>No PO</th>
                                        <th>No BPB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btnAddDaftarSj">OK</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Rincian Items --}}
    <div class="modal fade" id="ModalRincianItem" tabindex="-1" aria-labelledby="ModalRincianItemLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalRincianItemLabel">Items</h5>
                    <button type="button" class="btn-close btn-close-rincian" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="rincian-item-surat-jalan" class="display cell-border" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Deskripsi</th>
                                    <th>Quantity</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger border btn-close-rincian" data-bs-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Invoice --}}
    <div class="modal fade" id="ModalEditListInvoice" tabindex="-1" aria-labelledby="ModalEditListInvoiceLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditListInvoiceLabel">Edit List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <label for="noInvoices">No Invoices</label>
                            <label for="tgl" class="my-4">Tanggal</label>
                            <label for="cur" class="mt-2">Currency</label>
                            <label for="noFP" class="my-4">No Faktur Pajak</label>
                            <label for="tglPjk" class="mt-1">Tanggal Pajak</label>
                        </div>
                        <div class="col-9"> 
                            <form action="" id="formEditInvoice" enctype="multipart/form-data">
                                <div class="input-group">
                                    <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" value="" id="noInvoicesEdit" required disabled>
                                </div>
                                <div class="input-group mt-1">
                                    <input type="date" class="form-control" value="" id="tglEdit" required>
                                </div>
                                <div class="input-group mt-1">
                                    <select id="curEdit" class="form-select" required>
                                        <option hidden value="">Choose Cureency</option>
                                        <option value="IDR">IDR</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                                <div class="input-group mt-1">
                                    <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" value="" id="noFPEdit" required>
                                </div>
                                <div class="input-group mt-1">
                                    <input type="date" class="form-control" value="" id="tglPjkEdit" required>
                                </div>
    
                                <div class="modal-footer border-0 px-0">
                                    <button type="submit" class="btn btn-primary">OK</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='loader'></div>
</div>
  
<script type="text/javascript">
    $('.overlay').hide();
    // --------------------------------------------------------------------------------------------------------------------
    $('#invoices-list').dataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        responsive: true,
        bInfo: false,
        scrollCollapse: true,
        scrollY: '40vh',
        aaSorting: [[ 1, "desc" ]],
        language: {
        search: "No Invoices",
        lengthMenu: "Full _MENU_",
            paginate: {
                first: `<i class="fa-solid fa-angles-left"></i>`,
                last: `<i class="fa-solid fa-angles-right"></i>`,
                previous: `<i class="fa-solid fa-chevron-left"></i>`,
                next: `<i class="fa-solid fa-chevron-right"></i>`,
            }
        },
        sDom: '<"toolbar">Blfrtip<"reloadList">',
        pagingType: 'input',
        lengthChange: false,
        ajax: {
            url : "{{ route('invoices.index') }}",
            type: 'GET',
        },
        columns : [
            {"data" : "IDINVOICE"},
            {"data" : "TANGGAL", "render": function(data) {
                return moment(data).format('DD MMM YYYY')
            }},
            {"data" : "TAX_NOFAKTUR"},
            {"data" : "TAX_TANGGAL", "render": function(data) {
                return moment(data).format('DD MMM YYYY')
            }},
            {"data" : "IDCURRENCY"},
            {"data" : "NILAI", className:"text-end", "render": function(data){
                if (!$.trim(data) == true) {
                    return 0
                } else {
                    return parseFloat(data).toLocaleString()
                }
            }},
            {"data" : "TAX_PPN", className:"text-end", "render": function(data){
               if (!$.trim(data) == true) {
                    return 0
                } else {
                    return parseFloat(data).toLocaleString()
                }  
            }},
            {"data" : "TOTAL", className:"text-end", "render": function(data){
               if (!$.trim(data) == true) {
                    return 0
                } else {
                    return parseFloat(data).toLocaleString()
                }  
            }},
            {"data" : "TAX_PPH", className:"text-end", "render": function(data){
               if (!$.trim(data) == true) {
                    return 0
                } else {
                    return parseFloat(data).toLocaleString()
                }  
            }},
            {"data": "IDINVOICE" , className: "text-center", render : function (data) {
                return `
                    <button class="btn border-0 p-0" onclick="getListById('`+data+`')" data-bs-toggle="modal" data-bs-target="#ModalEditListInvoice">
                        <i class="fa-solid fa-pencil fa-xs"></i>
                    </button>
                    <button class="btn border-0 p-0">
                        <i class="fa-solid fa-upload fa-xs"></i>
                    </button>
                    <button class="btn border-0 p-0">
                        <i class="fa-solid fa-print fa-xs"></i>
                    </button>
                    <button class="btn border-0 p-0" onclick="deleteListInvoices('`+data+`')">
                        <i class="fa-solid fa-trash-can fa-xs"></i>
                    </button>`
            }},
        ],
    });

    $('#invoices-item').dataTable({
        responsive: true,
        bInfo: false,
        scrollCollapse: true,
        scrollY: '20vh',
        searching: false,
        language: {
            paginate: {
                first: `<i class="fa-solid fa-angles-left"></i>`,
                last: `<i class="fa-solid fa-angles-right"></i>`,
                previous: `<i class="fa-solid fa-chevron-left"></i>`,
                next: `<i class="fa-solid fa-chevron-right"></i>`,
            }
        },
        sDom: '<"reloadItem">Blfrtip',
        pagingType: 'input',
        lengthChange: false
    });

    $('#rincian-item-surat-jalan').dataTable({
        responsive: true,
        bInfo: false,
        scrollCollapse: true,
        scrollY: '20vh',
        searching: false,
        language: {
            paginate: {
                first: `<i class="fa-solid fa-angles-left"></i>`,
                last: `<i class="fa-solid fa-angles-right"></i>`,
                previous: `<i class="fa-solid fa-chevron-left"></i>`,
                next: `<i class="fa-solid fa-chevron-right"></i>`,
            }
        },
        pagingType: 'input',
        lengthChange: false
    });

    $('#surat-jalan').dataTable({
        responsive: true,
        bInfo: false,
        scrollCollapse: true,
        scrollY: '10vh',
        searching: false,
        language: {
        paginate: {
            first: `<i class="fa-solid fa-angles-left"></i>`,
            last: `<i class="fa-solid fa-angles-right"></i>`,
            previous: `<i class="fa-solid fa-chevron-left"></i>`,
            next: `<i class="fa-solid fa-chevron-right"></i>`,
        }
        },
        pagingType: 'input',
        lengthChange: false
    });

    $('#bon-penerimaan-barang').dataTable({
        responsive: true,
        bInfo: false,
        scrollCollapse: true,
        scrollY: '10vh',
        scrollX: true,
        searching: false,
        language: {
        paginate: {
            first: `<i class="fa-solid fa-angles-left"></i>`,
            last: `<i class="fa-solid fa-angles-right"></i>`,
            previous: `<i class="fa-solid fa-chevron-left"></i>`,
            next: `<i class="fa-solid fa-chevron-right"></i>`,
        }
        },
        pagingType: 'input',
        lengthChange: false
    });

    $('#bon-retur-barang').dataTable({
        responsive: true,
        bInfo: false,
        scrollCollapse: true,
        scrollY: '10vh',
        searching: false,
        language: {
        paginate: {
            first: `<i class="fa-solid fa-angles-left"></i>`,
            last: `<i class="fa-solid fa-angles-right"></i>`,
            previous: `<i class="fa-solid fa-chevron-left"></i>`,
            next: `<i class="fa-solid fa-chevron-right"></i>`,
        }
        },
        pagingType: 'input',
        lengthChange: false
    });

    $('#daftar-surat-jalan').dataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        bInfo: false,
        language: {
            paginate: {
                first: `<i class="fa-solid fa-angles-left"></i>`,
                last: `<i class="fa-solid fa-angles-right"></i>`,
                previous: `<i class="fa-solid fa-chevron-left"></i>`,
                next: `<i class="fa-solid fa-chevron-right"></i>`,
            }
        },
        pagingType: 'input',
        lengthChange: false,
        ajax: {
            url : "{{ route('invoices.indexDaftarSuratJalan') }}",
            type: 'GET',
        },
        columns : [
            {"data" : "NOSJ"},
            {"data" : "TANGGAL", "render": function(data){
                return moment(data).format('DD MMM YYYY');
            }},
            {"data" : "IDPO"},
            {"data" : "IDSTOCKIN"},
        ],
        order: [[1, 'desc']]
    });

    // --------------------------------------------------------------------------------------------------------------------

    $('#invoices-item_paginate').attr('style', 'display: none !important');
    $('#rincian-item-surat-jalan_paginate').attr('style', 'display: none !important');

    var tInvoicesList = $('#invoices-list').DataTable();
    var tInvoicesItem = $('#invoices-item').DataTable();
    var tRincianItem = $('#rincian-item-surat-jalan').DataTable();
    var tDaftarSuratJalan = $('#daftar-surat-jalan').DataTable();

    tInvoicesList.on('click', 'tbody tr', (e) => {
        let classList = e.currentTarget.classList;

        if (classList.contains('selected')) {
            classList.remove('selected');
        } else {
            tInvoicesList.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
            classList.add('selected');
        }
    });

    var noInvoices = "";
    var checkItemInvoices;
    $('#invoices-list tbody').on('click', 'td:not(:last-child)', function () {
        noInvoices = tInvoicesList.row(this).data().IDINVOICE;
        var selectedRows = tInvoicesItem.rows( { selected: true } ).count();
        
        checkItemInvoices = $.ajax({
            url: "{{route('invoices.indexItemInvoices')}}",
            type: 'GET',
            data: {
                id: noInvoices,
            },
            success: function(response) {
                if (response.length > 10) {
                    $('#invoices-item_paginate').attr('style', 'display: block !important');
                } else {
                    $('#invoices-item_paginate').attr('style', 'display: none !important');
                }

                if (response.length > 0) {
                    $.each(response, function(i, item) {
                        tInvoicesItem.rows.add(
                            [
                                [
                                    response[i].NOSJ,
                                    response[i].IDPO,
                                    moment(response[i].CREATEDAT).format('DD MMM YYYY'),
                                    "<div class='text-end'>"+parseFloat(response[i].NILAI).toLocaleString()+"</div>",
                                    `<div class="d-flex align-items-center">
                                        <button class="btn border-0 p-0 me-3" onclick="getRincianItem('`+response[i].IDPO+`')" data-bs-toggle="modal" data-bs-target="#ModalRincianItem">
                                            <i class="fa-solid fa-ellipsis fa-xs"></i>
                                        </button>
                                        <button class="btn border-0 p-0" onclick="deleteItemInvoices('`+response[i].NOSJ+`')">
                                            <i class="fa-solid fa-trash-can fa-xs"></i>
                                        </button>
                                    </div>`
                                ],
                            ]
                        ).draw()
                    });
                }
            },
            error: function(response) {
                Swal.fire({
                    type: 'error',
                    title: 'Item tidak ditemukan!',
                    text: 'Item pada PO ini tidak ada'
                });
            }
        });

        $('.overlay').show();
        $('#loader').show();
        checkItemInvoices.done(function(data, textStatus, jqXHR) {
        if (jqXHR.status === 200) {
            $('.overlay').hide();
            $('#loader').hide();
        }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log('Permintaan Ajax gagal dengan status: ' + jqXHR.status);
        });
        tInvoicesItem.clear().draw();
    });

    $('#btnAddDaftarSj').attr('disabled', true);
    tDaftarSuratJalan.on('click', 'tbody tr', (e) => {
        let classList = e.currentTarget.classList;
    
        if (classList.contains('selected')) {
            classList.remove('selected');
        } else {
            tDaftarSuratJalan.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
            classList.add('selected');
            $('#btnAddDaftarSj').attr('disabled', false);
        }
    });

    var noDaftarPoSelect
    $('#btnAddDaftarPo').on('click', function () {
        var noDaftarPoSelect = tDaftarSuratJalan.row('.selected').data().IDPO;

        $('#ModalDaftarPO').modal('hide');
        $('#ModalAddListSuratJalan').modal('show');

        $('#noSj').val(noDaftarPoSelect);
        $('#noSj').attr("disabled", true);
    });

    // --------------------------------------------------------------------------------------------------------------------

    $('.btn-close-rincian').on('click', function() {
        tRincianItem.clear().draw();
    })

    $('div.toolbar').html(`<div class="p-1 w-100 bg-header-menu rounded-top d-flex justify-content-between align-items-center">
        <div>
            <i class="fa-solid fa-truck fa-xs"></i>
            <span>LIST</span>
        </div>
        <div>
            <button class="btn border-0 p-0" type="button" data-bs-toggle="modal" data-bs-target="#ModalAddListInvoices">
                <i class="fa-solid fa-plus fa-xs"></i>
            </button>
        </div>
    </div>`).insertAfter(".dataTables_filter");

    $('div.reloadList').html(`<div class="p-2 float-end">
        <button class="btn py-0 border-0 reloadListTable" type="button">
            <i class="fa-solid fa-arrows-rotate fa-xs"></i>
        </button>
    </div>`).insertBefore(".dataTables_paginate paging_input");

    $('div.reloadItem').html(`<div class="p-2 float-end">
        <button class="btn py-0 border-0 reloadItemTable" type="button">
            <i class="fa-solid fa-arrows-rotate fa-xs"></i>
        </button>
    </div>`).insertAfter($("#invoices-item_wrapper > .dataTables_scroll > .dataTables_scrollBody"));

    $('.reloadItemTable').on('click', function() {
        tInvoicesItem.clear().draw();
    })

    // --------------------------------------------------------------------------------------------------------------------

    function getRincianItem(idPo) {
        $.ajax({
            url: "{{route('invoices.indexRincianInvoices')}}",
            type: 'GET',
            data: {
                id: idPo,
            },
            success: function(response) {
                if (response.length > 10) {
                    $('#surat-jalan-item_paginate').attr('style', 'display: block !important');
                } else {
                    $('#surat-jalan-item_paginate').attr('style', 'display: none !important');
                }

                if (response.length > 0) {
                    $.each(response, function(i, item) {
                        tRincianItem.rows.add(
                            [
                                [
                                    i + 1,
                                    response[i].DESKRIPSI,
                                    parseFloat(response[i].QUANTITY),
                                    response[i].SATUAN,
                                    parseFloat(response[i].HARGASATUAN).toLocaleString(),
                                ],
                            ]
                        ).draw()
                    });
                }
            },
            error: function(response) {
                Swal.fire({
                    type: 'error',
                    title: 'Item tidak ditemukan!',
                    text: 'Item pada PO ini tidak ada'
                });
            }
        });
    }

    $("#formAddInvoice").submit(function (event) {
        var formData = {
            IDINVOICE: $("#noInvoices").val(),
            TANGGAL: $("#tgl").val(),
            IDCURRENCY: $("#cur").val(),
            TAX_NOFAKTUR: $("#noFP").val(),
            TAX_TANGGAL: $("#tglPjk").val(),
        };

        $.ajax({
            type: "POST",
            url: "{{route('invoices.addInvoiceList')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: formData,
            dataType: "json",
            encode: true,
            success:function(response){
                Swal.fire({
                    type: 'success',
                    title: 'Data Berhasil Ditambahkan!',
                }).then(function(){ 
                    location.reload();
                });
            }, error:function(response){
                Swal.fire({
                    type: 'error',
                    title: 'Opps!',
                    text: 'Error!'
                });
            }
        });

        event.preventDefault();
    });

    $("#formAddItemInvoice").submit(function (event) {
        var formData = {
            IDINVOICE: noInvoices,
            NOSJ: tDaftarSuratJalan.row('.selected').data().NOSJ,
            IDPO: tDaftarSuratJalan.row('.selected').data().IDPO,
        };

        if (formData.IDINVOICE == '') {
            Swal.fire({
                type: 'error',
                title: 'Silahkan pilih List Invoice terlebih dahulu!',
            }).then(function(){ 
                $('#ModalDaftarSuratJalan').modal('hide');
            });
        } else {
            $.ajax({
                type: "POST",
                url: "{{route('invoices.addInvoiceItem')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: formData,
                dataType: "json",
                encode: true,
                success:function(response){
                    Swal.fire({
                        type: 'success',
                        title: 'Data Berhasil Ditambahkan!',
                    }).then(function(){ 
                        tInvoicesItem.clear().draw();
                        $('#ModalDaftarSuratJalan').modal('hide');
                        $.ajax({
                            url: "{{route('invoices.indexItemInvoices')}}",
                            type: 'GET',
                            data: {
                                id: noInvoices,
                            },
                            success: function(response) {
                                if (response.length > 10) {
                                    $('#invoices-item_paginate').attr('style', 'display: block !important');
                                } else {
                                    $('#invoices-item_paginate').attr('style', 'display: none !important');
                                }

                                if (response.length > 0) {
                                    $.each(response, function(i, item) {
                                        tInvoicesItem.rows.add(
                                            [
                                                [
                                                    response[i].NOSJ,
                                                    response[i].IDPO,
                                                    moment(response[i].CREATEDAT).format('DD MMM YYYY'),
                                                    "<div class='text-end'>"+parseFloat(response[i].NILAI).toLocaleString()+"</div>",
                                                    `<div class="d-flex align-items-center">
                                                        <button class="btn border-0 p-0 me-3" onclick="getRincianItem('`+response[i].IDPO+`')" data-bs-toggle="modal" data-bs-target="#ModalRincianItem">
                                                            <i class="fa-solid fa-ellipsis fa-xs"></i>
                                                        </button>
                                                        <button class="btn border-0 p-0" onclick="deleteItemInvoices('`+response[i].NOSJ+`')">
                                                            <i class="fa-solid fa-trash-can fa-xs"></i>
                                                        </button>
                                                    </div>`
                                                ],
                                            ]
                                        ).draw()
                                    });
                                }
                            },
                            error: function(response) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Item tidak ditemukan!',
                                    text: 'Item pada PO ini tidak ada'
                                });
                            }
                        });
                    });
                }, error:function(response){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: 'Error!'
                    });
                }
            });
        }

        event.preventDefault();
    });

    function getListById(idInvoice) {
        $.ajax({
            url: "{{route('invoices.getListInvoicesById')}}",
            type: 'GET',
            data: {
                id: idInvoice,
            },
            success: function(response) {
                $("#noInvoicesEdit").val(response[0].IDINVOICE);
                $("#tglEdit").val(response[0].TANGGAL);
                $("#curEdit").val(response[0].IDCURRENCY);
                $("#noFPEdit").val(response[0].TAX_NOFAKTUR);
                $("#tglPjkEdit").val(response[0].TAX_TANGGAL);
            },
            error: function(response) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                });
            }
        });
    }

    $("#formEditInvoice").submit(function (event) {
        var formData = {
            IDINVOICE: $("#noInvoicesEdit").val(),
            TANGGAL: $("#tglEdit").val(),
            IDCURRENCY: $("#curEdit").val(),
            TAX_NOFAKTUR: $("#noFPEdit").val(),
            TAX_TANGGAL: $("#tglPjkEdit").val(),
        };

        $.ajax({
            type: "POST",
            url: "{{route('invoices.editListInvoicesById')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function(data) {
            Swal.fire({
                type: 'success',
                title: 'Data Berhasil Diubah!',
            }).then(function(){ 
                location.reload();
            });
        });

        event.preventDefault();
    });    

    function deleteListInvoices(idInvoice) {
        Swal.fire({
            title: 'Apakah Anda yakin untuk menghapusnya?',
            showCancelButton: true,
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: "{{route('invoices.deleteListInvoices')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: 'DELETE',
                    data: {
                        id: idInvoice,
                    },
                    success: function(response) {
                        Swal.fire({
                            type: 'success',
                            title: 'Sukses hapus data!',
                        }).then(function(){ 
                            location.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                        });
                    }
                });
            }
        })
    }

    function deleteItemInvoices(noSj) {
        Swal.fire({
            title: 'Apakah Anda yakin untuk menghapusnya?',
            showCancelButton: true,
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: "{{route('invoices.deleteItemInvoices')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: 'DELETE',
                    data: {
                        id: noSj,
                        IDINVOICE: noInvoices,
                    },
                    success: function(response) {
                        Swal.fire({
                            type: 'success',
                            title: 'Sukses hapus data!',
                        }).then(function(){ 
                            tInvoicesItem.clear().draw();
                            $('#ModalDaftarSuratJalan').modal('hide');
                            $.ajax({
                                url: "{{route('invoices.indexItemInvoices')}}",
                                type: 'GET',
                                data: {
                                    id: noInvoices,
                                },
                                success: function(response) {
                                    if (response.length > 10) {
                                        $('#invoices-item_paginate').attr('style', 'display: block !important');
                                    } else {
                                        $('#invoices-item_paginate').attr('style', 'display: none !important');
                                    }

                                    if (response.length > 0) {
                                        $.each(response, function(i, item) {
                                            tInvoicesItem.rows.add(
                                                [
                                                    [
                                                        response[i].NOSJ,
                                                        response[i].IDPO,
                                                        moment(response[i].CREATEDAT).format('DD MMM YYYY'),
                                                        "<div class='text-end'>"+parseFloat(response[i].NILAI).toLocaleString()+"</div>",
                                                        `<div class="d-flex align-items-center">
                                                            <button class="btn border-0 p-0 me-3" onclick="getRincianItem('`+response[i].IDPO+`')" data-bs-toggle="modal" data-bs-target="#ModalRincianItem">
                                                                <i class="fa-solid fa-ellipsis fa-xs"></i>
                                                            </button>
                                                            <button class="btn border-0 p-0" onclick="deleteItemInvoices('`+response[i].NOSJ+`')">
                                                                <i class="fa-solid fa-trash-can fa-xs"></i>
                                                            </button>
                                                        </div>`
                                                    ],
                                                ]
                                            ).draw()
                                        });
                                    }
                                },
                                error: function(response) {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Item tidak ditemukan!',
                                        text: 'Item pada PO ini tidak ada'
                                    });
                                }
                            });
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                        });
                    }
                });
            }
        })
    }
</script>