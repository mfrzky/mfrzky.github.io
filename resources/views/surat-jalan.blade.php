@include('welcome')
<div class="main" id="main-content">
    <header class="bg-header-menu">
        <div class="p-1">
            <i class="fa-solid fa-truck fa-xs"></i>
            <span>SURAT JALAN</span>
        </div>
    </header>

    <div class="p-1">
        <table id="surat-jalan" class="display cell-border text-center nowrap" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">No Surat Jalan</th>
                    <th class="text-center">No PO</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    <div class="p-1">
        <div class="p-1 w-100 bg-header-menu rounded-top d-flex justify-content-between align-items-center">
            <div class="p-1 w-100 bg-header-menu rounded-top">
                <i class="fa-solid fa-file-lines fa-xs"></i>
                <span>ITEMS</span>
            </div>
            <div>
                <button class="btn border-0 p-0" type="button" id="getSj" data-bs-toggle="modal" data-bs-target="#ModalAddItemSj">
                    <i class="fa-solid fa-plus fa-xs"></i>
                </button>
            </div>
        </div>
        <table id="surat-jalan-item" class="display cell-border" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Quantity</th>
                    <th>Satuan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

    <div class="px-3 pb-3">
        <button type="button" class="btn border" id="controlSuratJalan">
            Control Surat Jalan
        </button>
    </div>

    <!-- Modal Add Surat Jalan -->
    <div class="modal fade" id="ModalAddListSuratJalan" tabindex="-1" aria-labelledby="ModalAddListSuratJalan" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalAddListSuratJalanLabel">Surat Jalan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label for="tgl" class="pe-3">Tanggal</label>
                        <label for="noSj" class="my-4 pe-3">No Surat Jalan</label>
                        <label for="noPo" class="mb-4 pe-3">No PO</label>
                    </div>
                    <div class="col-8"> 
                        <form method="POST" action="{{route('surat-jalan.addListSuratJalan')}}" id="formSuratJalan">
                            <div class="input-group">
                                <input type="text" class="form-control" id="tgl" placeholder="dd/mm/yyyy" required>
                            </div>
                            <div class="input-group my-1">
                                <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" id="noSj" required>
                            </div>
                            <div class="input-group">
                                <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" id="noPo" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="padding: 0.675rem .75rem !important;">
                                        <button class="btn border-0 p-0" type="button" data-bs-toggle="modal" data-bs-target="#ModalDaftarPO">
                                            <i class="fa-solid fa-ellipsis fa-xs"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="modal-footer border-0 px-0">
                                <button type="submit" class="btn btn-primary" id="btnAddSuratJalan">Next</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btnCancelSuratJalan">Cancel</button>
                            </div>
                        </form>           
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Modal Item Surat Jalan -->
    <div class="modal fade" id="ModalAddItemSuratJalan" tabindex="-1" aria-labelledby="ModalAddItemSuratJalan" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalAddItemSuratJalanLabel">Surat Jalan</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <label for="itemSj" class="mt-1">Item Surat Jalan</label>
                    </div>
                    <div class="col-8"> 
                        <form method="POST" id="formItemSuratJalan">
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" value="" name="checkboxItemSj" id="itemSjCheck">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Input seluruh item
                                </label>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="itemSj" style="font-size: 12px;">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="padding: 0.675rem .75rem !important;">
                                        <button class="btn border-0 p-0" type="button" data-bs-toggle="modal" data-bs-target="#ModalItemSj">
                                            <i class="fa-solid fa-ellipsis fa-xs"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <input type="number" id="qtyItemSj">
                                <input type="hidden" id="idBarangMerkItemSj">
                                <input type="hidden" id="hargaSatuanItemSj">
                                <input type="hidden" id="idSatuanItemSj">
                            </div>

                            <div class="modal-footer border-0 px-0">
                                <button type="submit" class="btn btn-primary" id="btnAddItemSuratJalan">OK</button>
                            </div>
                        </form>           
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Modal Add Item Surat Jalan -->
    <div class="modal fade" id="ModalAddItemSj" tabindex="-1" aria-labelledby="ModalAddItemSj" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalAddItemSjLabel">Surat Jalan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <label for="itemSj" class="mt-1">Item Surat Jalan</label>
                    </div>
                    <div class="col-8"> 
                        <form method="POST" id="formItemSuratJalan">
                            <div class="input-group">
                                <input type="text" class="form-control" id="itemSj" required style="font-size: 12px;">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="padding: 0.675rem .75rem !important;">
                                        <button class="btn border-0 p-0" type="button" data-bs-toggle="modal" data-bs-target="#ModalItemSj">
                                            <i class="fa-solid fa-ellipsis fa-xs"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <input type="number" id="qtyItemSj">
                                <input type="hidden" id="idBarangMerkItemSj">
                                <input type="hidden" id="hargaSatuanItemSj">
                                <input type="hidden" id="idSatuanItemSj">
                            </div>

                            <div class="modal-footer border-0 px-0">
                                <button type="submit" class="btn btn-primary" id="btnAddItemSuratJalan">OK</button>
                            </div>
                        </form>           
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Modal Control Delivery -->
    <div class="modal fade" id="ModalControlSuratJalan" tabindex="-1" aria-labelledby="ModalControlSuratJalanLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalControlSuratJalanLabel">Control Delivery</h5>
                <button type="button" class="btn-close" id="closeModalDelivery" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">    
                <div class="mb-5">
                    <div class="p-1 w-100 bg-header-menu rounded-top">
                        <i class="fa-solid fa-cart-shopping fa-xs"></i>
                        <span>BON PENERIMAAN BARANG</span>
                    </div>
                    <table id="bon-penerimaan-barang" class="display cell-border" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No. BPB</th>
                                <th>Tgl. BPB</th>
                                <th>No. SJ</th>
                                <th>No. PO</th>
                                <th>ID Barang</th>
                                <th>Description</th>
                                <th>Satuan</th>
                                <th>QTY SJ</th>
                                <th>QTY BPB</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
        
                <div class="mb-3">
                    <div class="p-1 w-100 bg-header-menu rounded-top">
                        <i class="fa-solid fa-cart-shopping fa-xs"></i>
                        <span>BON RETUR BARANG</span>
                    </div>
                    <table id="bon-retur-barang" class="display cell-border" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.BRB</th>
                                <th>Tgl.BRB</th>
                                <th>No.BPB</th>
                                <th>ID Barang</th>
                                <th>Description</th>
                                <th>Satuan</th>
                                <th>QTY BPB</th>
                                <th>QTY BRB</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Daftar PO -->
    <div class="modal fade" id="ModalDaftarPO" tabindex="-1" aria-labelledby="ModalDaftarPOLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDaftarPOLabel">Purchase Orders</h5>
                    <button type="button" class="btn-close" id="btn-closeDaftarPo" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-1">
                        <label for="searchDaftarPo" class="form-label me-3 mb-0">Search Daftar PO</label>
                        <div class="col-3">
                            <input type="text" class="form-control p-1" id="searchDaftarPo">
                        </div>
                    </div>
                    <div>
                        <table id="daftar-po" class="display cell-border" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Delivery</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger border" id="btnAddDaftarPo">
                        OK
                    </button>
                    <button class="btn btn-primary border" id="btnCancelDaftarPo">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Daftar Item SJ -->
    <div class="modal fade" id="ModalItemSj" tabindex="-1" aria-labelledby="ModalItemSjLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalItemSjLabel">Item Surat Jalan</h5>
                    <button type="button" class="btn-close" id="btn-closeItemSj" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="daftar-item-sj" class="display cell-border" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Deskripsi</th>
                                    <th>QTY</th>
                                    <th>IDBARANGMERK</th>
                                    <th>IDSATUAN</th>
                                    <th>HARGA</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger border" id="btnAddItemSj">
                        OK
                    </button>
                    <button class="btn btn-primary border" id="btnCancelItemSj">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="ModalEditListSuratJalan" tabindex="-1" aria-labelledby="ModalEditListSuratJalanLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditListSuratJalanLabel">Edit List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSuratJalan" method="POST" action="{{route('surat-jalan.editListSuratJalanById')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="noListSj" value="" class="form-control" id="noListSj" placeholder="No Sj" required="">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" id="tglEdit" required>
                        </div>
                        <div class="form-group text-right mt-3 float-end">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Item -->
    <div class="modal fade" id="ModalEditItemSuratJalan" tabindex="-1" aria-labelledby="ModalEditItemSuratJalanLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditItemSuratJalanLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editItemSuratJalan">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" disabled class="form-control input-font-size mb-2" id="descBarang">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" id="quantityEdit" required>
                        </div>
                        <div class="text-right mt-3 float-end">
                          <button class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id='loader'></div>
</div>
    
<script type="text/javascript">
    $( "#tgl" ).datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $('#itemSjCheck').change(function() {
        if ($(this).is(':checked')) {
            $("#itemSj").prop("disabled", true);
            $("#itemSj").val('');
            $("#qtyItemSj").hide();
            $("#qtyItemSj").val('');
        } else {
            $("#itemSj").prop("disabled", false);
            $("#qtyItemSj").show();
        };
    });

    $("#qtyItemSj").hide();
    $("#itemSj").on("input", function(){
        if ($(this).val() == '') {
            $("#qtyItemSj").hide();
        } else {
            $("#qtyItemSj").show();
        }
    });

    // ----------------------------------------------------------TABLE LIST & TABLE ITEM----------------------------------------------------------
    var suratJalanTable = $('#surat-jalan').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        responsive: true,
        bInfo: false,
        scrollCollapse: true,
        scrollY: '20vh',
        language: {
            search: "Search",
            lengthMenu: "Full _MENU_",
            paginate: {
                first: `<i class="fa-solid fa-angles-left"></i>`,
                last: `<i class="fa-solid fa-angles-right"></i>`,
                previous: `<i class="fa-solid fa-chevron-left"></i>`,
                next: `<i class="fa-solid fa-chevron-right"></i>`,
            }
        },
        sDom: '<"toolbar">Blfrtip<"reloadSuratJalan">',
        pagingType: 'input',
        lengthChange: false,
        ajax: {
			url : "{{route('surat-jalan.index')}}",
            type: 'GET',
		},
        columns : [
			{"data" : "TANGGAL", "render": function(data){
                return moment(data).format('DD MMM YYYY');
            }},
			{"data" : "NOSJ"},
			{"data" : "IDPO"},
			{"data" : "STATUS", "render": function(data){
                if(data == 0) {
                    return 'Close'
                } else {
                    return 'Open'
                }
            }},
            {"data": "NOSJ" , className: "text-center", render : function (data, type, row) {
                return `
                        <button class="btn border-0 p-0" onclick="getListById('`+data+`')" data-bs-toggle="modal" data-bs-target="#ModalEditListSuratJalan">
                            <i class="fa-solid fa-pencil fa-xs"></i>
                        </button>
                        <button class="btn border-0 p-0" onclick="sendEmail('`+data+`', '`+row.IDPO+`')">
                            <i class="fa-solid fa-upload fa-xs"></i>
                        </button>
                        <button class="btn border-0 p-0">
                            <i class="fa-solid fa-print fa-xs"></i>
                        </button>
                        <button class="btn border-0 p-0" onclick="deleteList('`+data+`')">
                            <i class="fa-solid fa-trash-can fa-xs"></i>
                        </button>`
            }},
		],
    });
    
    $('#surat-jalan-item').dataTable({
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
        columnDefs: [{ width: 200, targets: [1,2,3] }],
        sDom: '<"reloadItem">Blfrtip',
        pagingType: 'input',
        lengthChange: false
    });

    var tableBpb = $('#bon-penerimaan-barang').DataTable({
        responsive: true,
        bInfo: false,
        searching: false,
        scrollCollapse: true,
        language: {
        paginate: {
            first: `<i class="fa-solid fa-angles-left"></i>`,
            last: `<i class="fa-solid fa-angles-right"></i>`,
            previous: `<i class="fa-solid fa-chevron-left"></i>`,
            next: `<i class="fa-solid fa-chevron-right"></i>`,
        },
        },
        bAutoWidth: false,
        pagingType: 'input',
        lengthChange: false
    });
    var rowCountBpb = tableBpb.rows().count();
    if (rowCountBpb > 10) {
        tableBpb.scrollY('30vh');
    }

    var tableBrb = $('#bon-retur-barang').DataTable({
        responsive: true,
        bInfo: false,
        searching: false,
        scrollCollapse: true,
        language: {
        paginate: {
            first: `<i class="fa-solid fa-angles-left"></i>`,
            last: `<i class="fa-solid fa-angles-right"></i>`,
            previous: `<i class="fa-solid fa-chevron-left"></i>`,
            next: `<i class="fa-solid fa-chevron-right"></i>`,
        },
        },
        bAutoWidth: false,
        pagingType: 'input',
        lengthChange: false
    });
    var rowCountBrb = tableBrb.rows().count();
    if (rowCountBrb > 10) {
        tableBrb.scrollY('30vh');
    }

    var daftarPoTable = $('#daftar-po').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        responsive: true,
        bInfo: false,
        language: {
            search: "Seacrh Daftar PO",
            lengthMenu: "Full _MENU_",
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
			url : "{{route('surat-jalan.indexPo')}}",
            type: 'GET',
		},
        columns : [
			{"data" : "IDPO"},
			{"data" : "TANGGALPO", "render": function(data){
                return moment(data).format('DD MMM YYYY');
            }},
			{"data" : "TGLDELIVERY", "render": function(data){
                return moment(data).format('DD MMM YYYY');
            }},
		],
        order: [[1, 'desc']],
    });

    var tSuratJalanList = $('#surat-jalan').DataTable();
    var tSuratJalanItem = $('#surat-jalan-item').DataTable();
    var tBonPenerimaanBarang = $('#bon-penerimaan-barang').DataTable();
    var tBonReturBarang = $('#bon-retur-barang').DataTable();
    var tDaftarPo = $('#daftar-po').DataTable();
    var tDaftarItemSj = $('#daftar-item-sj').DataTable();

    $('#daftar-po_filter').hide();
    $('#searchDaftarPo').on('input', function() {
        var searchTerm = $(this).val();
        tDaftarPo.search(searchTerm).draw();
    });

    $('#surat-jalan-item_paginate').attr('style', 'display: none !important');
    $('#bon-penerimaan-barang_paginate').attr('style', 'display: none !important');
    $('#bon-retur-barang_paginate').attr('style', 'display: none !important');

    tSuratJalanList.on('click', 'tbody tr', (e) => {
        let classList = e.currentTarget.classList;

        if (classList.contains('selected')) {
            classList.remove('selected');
        } else {
            tSuratJalanList.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
            classList.add('selected');
        }
    });

    var noSj;
    var idPoItem;
    var getBpb;
    var getSj;
    $('#surat-jalan tbody').on('click', 'td:not(:last-child)', function () {
        tBonPenerimaanBarang.clear().draw();
        tBonReturBarang.clear().draw();
        
        noSj = tSuratJalanList.row(this).data().NOSJ;
        idPoItem = tSuratJalanList.row(this).data().IDPO;
        var selectedRows = tSuratJalanItem.rows( { selected: true } ).count();
        
        // -------------- GET SJ --------------
        getSj = $.ajax({
            url: "{{route('surat-jalan-item-sj.indexItemSuratJalan')}}",
            type: 'GET',
            data: {
                id: noSj,
            },
            success: function(response) {
                if (response.length > 10) {
                    $('#surat-jalan-item_paginate').attr('style', 'display: block !important');
                } else {
                    $('#surat-jalan-item_paginate').attr('style', 'display: none !important');
                }

                if (response.length > 0) {
                    $.each(response, function(i, item) {
                        tSuratJalanItem.rows.add(
                            [
                                [
                                    response[i].DESKRIPSI,
                                    "<div class='text-end'>"+parseFloat(response[i].QTY_SJ).toLocaleString()+"</div>",
                                    response[i].SATUAN,
                                    `<div class="text-center">
                                        <button class="btn border-0 p-0 me-3" onclick="getItemById('`+response[i].NOSJ+`','`+response[i].IDBARANGMERK+`')" data-bs-toggle="modal" data-bs-target="#ModalEditItemSuratJalan">
                                            <i class="fa-solid fa-pencil fa-xs"></i>
                                        </button>
                                        <button class="btn border-0 p-0" onclick="deleteItemSuratJalan('`+response[i].NOSJ+`','`+response[i].IDBARANGMERK+`')">
                                            <i class="fa-solid fa-trash-can fa-xs"></i>
                                        </button>
                                    </div>`,
                                ],
                            ]
                        ).draw()
                    });
                }
            },
            error: function(response) {
                
            }
        });

        // -------------- GET BPB --------------
        getBpb = $.ajax({
            url: "{{route('surat-jalan.indexItemBonPenerimaanBarang')}}",
            type: 'GET',
            data: {
                id: noSj,
            },
            success: function(response) {
                if (response.length > 10) {
                    $('#bon-penerimaan-barang_paginate').attr('style', 'display: block !important');
                } else {
                    $('#bon-penerimaan-barang_paginate').attr('style', 'display: none !important');
                }

                if (response.length > 0) {
                    $.each(response, function(i, item) {
                        tBonPenerimaanBarang.rows.add(
                            [
                                [
                                    response[i].IDSTOCKIN,
                                    moment(response[i].TGLSTOCKIN).format('DD MMM YYYY'),
                                    response[i].NOSJ,
                                    response[i].IDPO,
                                    response[i].IDBARANG,
                                    response[i].BARANGTIPE,
                                    response[i].SATUAN,
                                    "<div class='text-end'>"+parseFloat(response[i].QTY_SJ).toLocaleString()+"</div>",
                                    "<div class='text-end'>"+parseFloat(response[i].QTY_BPB).toLocaleString()+"</div>",
                                ],
                            ]
                        ).draw()
                    });
                }
            },
            error: function(response) {
               
            }
        });

        // -------------- GET BRB --------------
        $.ajax({
            url: "{{route('purchase-orders-item-brb.indexItemBonReturBarang')}}",
            type: 'GET',
            data: {
                id: noSj,
            },
            success: function(response) {
                if (response.length > 10) {
                    $('#bon-retur-barang_paginate').attr('style', 'display: block !important');
                } else {
                    $('#bon-retur-barang_paginate').attr('style', 'display: none !important');
                }
                
                if (response.length > 0) {
                    $.each(response, function(i, item) {
                        tBonReturBarang.rows.add(
                            [
                                [
                                    response[i].IDSTOCKIN,
                                    response[i].TGLSTOCKIN,
                                    response[i].NOSJ,
                                    response[i].IDBARANGMERK,
                                    response[i].DESKRIPSI,
                                    response[i].SATUAN,
                                    parseFloat(response[i].QTY_SJ),
                                    parseFloat(response[i].QTY_BPB),
                                ],
                            ]
                        ).draw()
                    });
                }
            },
            error: function(response) {
                
            }
        });

        $('.overlay').show();
        $('#loader').show();
        getSj.done(function(data, textStatus, jqXHR) {
        if (jqXHR.status === 200) {
            $('.overlay').hide();
            $('#loader').hide();
        }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log('Permintaan Ajax gagal dengan status: ' + jqXHR.status);
        });

        tSuratJalanItem.clear().draw();
    });

    $('.overlay').hide();
    $('#controlSuratJalan').on('click', function() {
        if (getBpb == undefined) {
            Swal.fire({
                type: 'warning',
                title: 'Silahkan pilih No SJ!',
            });
        } else {
            $('.overlay').show();
            $('#loader').show();
            getBpb.done(function(data, textStatus, jqXHR) {
                if (jqXHR.status === 200) {
                    $('.overlay').hide();
                    $('#loader').hide();
                    $('#ModalControlSuratJalan').modal('show');
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log('Permintaan Ajax gagal dengan status: ' + jqXHR.status);
            });
        }
    })

    tDaftarPo.on('click', 'tbody tr', (e) => {
        let classList = e.currentTarget.classList;
    
        if (classList.contains('selected')) {
            classList.remove('selected');
        }
        else {
            tDaftarPo.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
            classList.add('selected');
        }
    });

    tDaftarItemSj.on('click', 'tbody tr', (e) => {
        let classList = e.currentTarget.classList;
    
        if (classList.contains('selected')) {
            classList.remove('selected');
        }
        else {
            tDaftarItemSj.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
            classList.add('selected');
        }
    });

    var noDaftarPoSelect
    $('#btnAddDaftarPo').on('click', function () {
        var noDaftarPoSelect = tDaftarPo.row('.selected').data().IDPO;

        $('#ModalDaftarPO').modal('hide');
        $('#ModalAddListSuratJalan').modal('show');

        $('#noPo').val(noDaftarPoSelect);
        $('#noPo').attr("disabled", true);
    });

    var noItemSjSelect
    $('#btnAddItemSj').on('click', function () {
        var noItemSjSelect = tDaftarItemSj.row('.selected').data()[1];

        $('#ModalItemSj').modal('hide');
        $('#ModalAddItemSuratJalan').modal('show');

        $('#itemSj').val(noItemSjSelect);
        $('#qtyItemSj').val(tDaftarItemSj.row('.selected').data()[2])
        $('#idBarangMerkItemSj').val(tDaftarItemSj.row('.selected').data()[3])
        $('#idSatuanItemSj').val(tDaftarItemSj.row('.selected').data()[4])
        $('#hargaSatuanItemSj').val(tDaftarItemSj.row('.selected').data()[5])

        $('#itemSj').attr("disabled", true);
        $("#qtyItemSj").show();
    });

    $('#btnCancelDaftarPo').on('click', function () {
        $('#ModalDaftarPO').modal('hide');
        $('#ModalAddListSuratJalan').modal('show');
    });

    $('#btnCancelItemSj').on('click', function () {
        if ($("#noPo").val() == '') {
            $('#ModalItemSj').modal('hide');
            $('#ModalAddItemSj').modal('show');
        } else {
            $('#ModalItemSj').modal('hide');
            $('#ModalAddItemSuratJalan').modal('show');
        }
    });

    $('#btn-closeDaftarPo').on('click', function () {
        $('#ModalDaftarPO').modal('hide');
        $('#ModalAddListSuratJalan').modal('show');
    });

    $('#btn-closeItemSj').on('click', function () {
        $('#ModalItemSj').modal('hide');
        $('#ModalAddItemSuratJalan').modal('show');
    });

    $('#formSuratJalan').submit(function() {
        var formData = {
            TANGGAL: $("#tgl").val(),
            IDPO: $("#noPo").val(),
            NOSJ: $("#noSj").val(),
        };

        $.ajax({
            type: "POST",
            url: "{{route('surat-jalan.addListSuratJalan')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: formData,
            dataType: "json",
            encode: true,
            success:function(response){
                if (response == 400) {
                    Swal.fire({
                        type: 'error',
                        title: 'Silahkan cek Nomor PO, karena tidak terdaftar!',
                    });
                } else if (response.error == 'NO SJ Sudah ada!') {
                    Swal.fire({
                        type: 'error',
                        title: 'No Surat Jalan sudah terdaftar!',
                    });
                } else {
                    Swal.fire({
                        type: 'success',
                        title: 'Data Berhasil Ditambahkan!',
                    }).then(function(){ 
                        $('#ModalAddListSuratJalan').modal('hide'); 
                        $('#ModalAddItemSuratJalan').modal('show');

                        $.ajax({
                            url: "{{route('surat-jalan.getItemSuratJalanById')}}",
                            type: 'GET',
                            data: {
                                id: $("#noPo").val(),
                            },
                            success: function(response) {
                                $.each(response, function(i, item) {
                                    tDaftarItemSj.rows.add(
                                        [
                                            [
                                                i + 1,
                                                response[i].BARANGTIPE,
                                                parseFloat(response[i].QUANTITY).toLocaleString(),
                                                response[i].IDBARANGMERK,
                                                response[i].IDSATUAN,
                                                parseFloat(response[i].HARGA).toLocaleString(),
                                            ],
                                        ]
                                    ).draw()
                                });
                            },
                            error: function(response) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error',
                                });
                            }
                        });
                    });
                }
            }, error:function(response){
                Swal.fire({
                    type: 'error',
                    title: 'Silahkan cek Nomor PO, karena tidak terdaftar!',
                });
            }
        })

        event.preventDefault();
    })

    $('#formItemSuratJalan').submit(function(event) {
        var formData = {
            TANGGAL: $("#tgl").val(),
            IDPO: $("#noPo").val() == '' ? idPoItem : $("#noPo").val(),
            NOSJ: $("#noSj").val() == '' ? noSj : $("#noSj").val(),
            BARANGTIPE: $("#itemSj").val(),
            QUANTITY: $("#qtyItemSj").val(),
            IDBARANGMERK: $('#idBarangMerkItemSj').val(),
            HARGA: $('#hargaSatuanItemSj').val(),
            IDSATUAN: $('#idSatuanItemSj').val(),
            CHECKED : $('#itemSjCheck').is(':checked'),
        };
        
        if (formData.CHECKED == false && formData.BARANGTIPE == "") {
            $("#itemSj").removeAttr('required');
            location.reload();
        } else {
            $.ajax({
                type: "POST",
                url: "{{route('surat-jalan.addItemSuratJalan')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: formData,
                dataType: "json",
                encode: true,
                success:function(response){
                    if (response == 400) {
                        Swal.fire({
                            type: 'error',
                            title: 'Quantity tidak boleh melebihi sisa!',
                        });
                    } else {
                        Swal.fire({
                            type: 'success',
                            title: 'Item Berhasil Ditambahkan!',
                        }).then(function(){ 
                            tSuratJalanItem.clear().draw();
                            $('#ModalAddItemSuratJalan').modal('hide');
                            $.ajax({
                                url: "{{route('surat-jalan-item-sj.indexItemSuratJalan')}}",
                                type: 'GET',
                                data: {
                                    id: noSj,
                                },
                                success: function(response) {
                                    if (response.length > 10) {
                                        $('#surat-jalan-item_paginate').attr('style', 'display: block !important');
                                    } else {
                                        $('#surat-jalan-item_paginate').attr('style', 'display: none !important');
                                    }

                                    if (response.length > 0) {
                                        $.each(response, function(i, item) {
                                            tSuratJalanItem.rows.add(
                                                [
                                                    [
                                                        response[i].DESKRIPSI,
                                                        "<div class='text-end'>"+parseFloat(response[i].QTY_SJ).toLocaleString()+"</div>",
                                                        response[i].SATUAN,
                                                        `<div class="text-center">
                                                            <button class="btn border-0 p-0 me-3" onclick="getItemById('`+response[i].NOSJ+`','`+response[i].IDBARANGMERK+`')" data-bs-toggle="modal" data-bs-target="#ModalEditItemSuratJalan">
                                                                <i class="fa-solid fa-pencil fa-xs"></i>
                                                            </button>
                                                            <button class="btn border-0 p-0" onclick="deleteItemSuratJalan('`+response[i].NOSJ+`','`+response[i].IDBARANGMERK+`')">
                                                                <i class="fa-solid fa-trash-can fa-xs"></i>
                                                            </button>
                                                        </div>`,
                                                    ],
                                                ]
                                            ).draw()
                                        });
                                    }
                                },
                                error: function(response) {
                                    
                                }
                            });
                        });
                    }
                }
            })
        }

        event.preventDefault();
    })

    $('#btnCancelSuratJalan').on('click', function() {
        $('#tgl').val('');
        $('#noSj').val('');
        $('#noPo').val('');
        $('#noPo').attr("disabled", false);
    })

    // --------------------------------------------------------------------------------------------------------------------

    $('div.toolbar').html(`<div class="p-1 w-100 bg-header-menu rounded-top d-flex justify-content-between align-items-center">
        <div>
            <i class="fa-solid fa-truck fa-xs"></i>
            <span>LIST</span>
        </div>
        <div>
            <button class="btn border-0 p-0" type="button" data-bs-toggle="modal" data-bs-target="#ModalAddListSuratJalan">
                <i class="fa-solid fa-plus fa-xs"></i>
            </button>
        </div>
    </div>`).insertAfter(".dataTables_filter");
    
    $('div.reloadSuratJalan').html(`<div class="p-2 float-end">
        <button class="btn py-0 border-0 reloadSuratJalanTable" type="button">
            <i class="fa-solid fa-arrows-rotate fa-xs"></i>
        </button>
    </div>`).insertBefore(".dataTables_paginate paging_input");

    $('.reloadSuratJalanTable').on('click', function() {
        tSuratJalanList.ajax.reload();
    })

    $('div.reloadItem').html(`<div class="p-2 float-end">
        <button class="btn py-0 border-0 reloadItemTable" type="button">
        <i class="fa-solid fa-arrows-rotate fa-xs"></i>
        </button>
    </div>`).insertAfter($("#surat-jalan-item_wrapper > .dataTables_scroll > .dataTables_scrollBody"));

    $('.reloadItemTable').on('click', function() {
        tSuratJalanItem.clear().draw();
    })
    
    $('div.reloadDaftarPo').html(`<div class="p-2 float-end">
        <button class="btn py-0 border-0 reloadDaftarPoTable" type="button">
            <i class="fa-solid fa-arrows-rotate fa-xs"></i>
        </button>
    </div>`).insertBefore(".dataTables_paginate paging_input");

    $('.dataTables_filter input')
        .off()
        .on('keyup', function () {
        tSuratJalanList.column(1).search( this.value ).draw();
    });
    
    // --------------------------------------------------------------------------------------------------------------------
    
    function getListById(noSj) {
        $.ajax({
            url: "{{route('surat-jalan.getListSuratJalanById')}}",
            type: 'GET',
            data: {
                id: noSj,
            },
            success: function(response) {
                $("#tglEdit").val(response[0].TANGGAL);
                $("#editSuratJalan").submit(function (event) {
                    var formData = {
                        NOSJ: noSj,
                        TANGGAL: $("#tglEdit").val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "{{route('surat-jalan.editListSuratJalanById')}}",
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
            },
            error: function(response) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                });
            }
        });
    } 

    function sendEmail(noSj, idPo) {
        Swal.fire({
            title: 'Apakah Anda yakin untuk mengirim email?',
            showCancelButton: true,
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: "{{route('email.sendEmail')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: 'GET',
                    data: {
                        id: noSj,
                        idPo: idPo,
                    },
                    success: function(response) {
                        $('.overlay').hide();
                        $('#loader').hide();
                        Swal.fire({
                            type: 'success',
                            title: 'Sukses kirim email!',
                        }).then(function(){ 
                            location.reload();
                        });
                    },
                    beforeSend: function() {
                        $('.overlay').show();
                        $('#loader').show();
                    },
                    error: function(response) {
                        $('.overlay').hide();
                        $('#loader').hide();
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                        });
                    }
                });
            }
        })
    }

    var barangMerk;
    function getItemById(noSj, idBarangMerk) {
        barangMerk = idBarangMerk;
        $.ajax({
            url: "{{route('surat-jalan.getDataItemById')}}",
            type: 'GET',
            data: {
                id: noSj,
                idBarangMerk: idBarangMerk,
            },
            success: function(response) {
                $("#descBarang").val(response[0].DESKRIPSI);
                $("#quantityEdit").val(parseFloat(response[0].QTY_SJ).toLocaleString());
                
            },
            error: function(response) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                });
            }
        });
    } 

    $("#editItemSuratJalan").submit(function (event) {
        var formData = {
            NOSJ: noSj,
            IDBARANGMERK: barangMerk,
            QTY_SJ: $("#quantityEdit").val()
        };
        $.ajax({
            type: "POST",
            url: "{{route('surat-jalan.editItemSuratJalanById')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: formData,
            dataType: "json",
            encode: true,
            success: function(data) {
                Swal.fire({
                    type: 'success',
                    title: 'Data Berhasil Diubah!',
                }).then(function(){
                    tSuratJalanItem.clear().draw();
                    $('#ModalEditItemSuratJalan').modal('hide');
                    $.ajax({
                        url: "{{route('surat-jalan-item-sj.indexItemSuratJalan')}}",
                        type: 'GET',
                        data: {
                            id: noSj,
                        },
                        success: function(response) {
                            if (response.length > 10) {
                                $('#surat-jalan-item_paginate').attr('style', 'display: block !important');
                            } else {
                                $('#surat-jalan-item_paginate').attr('style', 'display: none !important');
                            }
    
                            if (response.length > 0) {
                                $.each(response, function(i, item) {
                                    tSuratJalanItem.rows.add(
                                        [
                                            [
                                                response[i].DESKRIPSI,
                                                "<div class='text-end'>"+parseFloat(response[i].QTY_SJ).toLocaleString()+"</div>",
                                                response[i].SATUAN,
                                                `<div class="text-center">
                                                    <button class="btn border-0 p-0 me-3" onclick="getItemById('`+response[i].NOSJ+`','`+response[i].IDBARANGMERK+`')" data-bs-toggle="modal" data-bs-target="#ModalEditItemSuratJalan">
                                                        <i class="fa-solid fa-pencil fa-xs"></i>
                                                    </button>
                                                    <button class="btn border-0 p-0" onclick="deleteItemSuratJalan('`+response[i].NOSJ+`','`+response[i].IDBARANGMERK+`')">
                                                        <i class="fa-solid fa-trash-can fa-xs"></i>
                                                    </button>
                                                </div>`,
                                            ],
                                        ]
                                    ).draw()
                                });
                            }
                        },
                        error: function(response) {
                            
                        }
                    });
                });
            }
        });

        event.preventDefault();
    }); 

    $('#getSj').on('click', function() {
        $.ajax({
            url: "{{route('surat-jalan.getItemSuratJalanById')}}",
            type: 'GET',
            data: {
                id: idPoItem,
            },
            success: function(response) {
                $.each(response, function(i, item) {
                    tDaftarItemSj.rows.add(
                        [
                            [
                                i + 1,
                                response[i].BARANGTIPE,
                                parseFloat(response[i].QUANTITY).toLocaleString(),
                                response[i].IDBARANGMERK,
                                response[i].IDSATUAN,
                                parseFloat(response[i].HARGA).toLocaleString(),
                            ],
                        ]
                    ).draw()
                });
            },
            error: function(response) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                });
            }
        });
    })

    function deleteList(noSj) {
        Swal.fire({
            title: 'Apakah Anda yakin untuk menghapusnya?',
            showCancelButton: true,
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: "{{route('surat-jalan.deleteListSuratJalanById')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: 'DELETE',
                    data: {
                        id: noSj,
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

    function deleteItemSuratJalan(noSj, idBarangMerk) {
        Swal.fire({
            title: 'Apakah Anda yakin untuk menghapusnya?',
            showCancelButton: true,
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: "{{route('surat-jalan.deleteItemSuratJalanById')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: 'DELETE',
                    data: {
                        id: noSj,
                        idBarangMerk: idBarangMerk,
                    },
                    success: function(response) {
                        Swal.fire({
                            type: 'success',
                            title: 'Sukses hapus data!',
                        }).then(function(){ 
                            tSuratJalanItem.clear().draw();
                            $('#ModalEditItemSuratJalan').modal('hide');
                            $.ajax({
                                url: "{{route('surat-jalan-item-sj.indexItemSuratJalan')}}",
                                type: 'GET',
                                data: {
                                    id: noSj,
                                },
                                success: function(response) {
                                    if (response.length > 10) {
                                        $('#surat-jalan-item_paginate').attr('style', 'display: block !important');
                                    } else {
                                        $('#surat-jalan-item_paginate').attr('style', 'display: none !important');
                                    }

                                    if (response.length > 0) {
                                        $.each(response, function(i, item) {
                                            tSuratJalanItem.rows.add(
                                                [
                                                    [
                                                        response[i].DESKRIPSI,
                                                        "<div class='text-end'>"+parseFloat(response[i].QTY_SJ).toLocaleString()+"</div>",
                                                        response[i].SATUAN,
                                                        `<div class="text-center">
                                                            <button class="btn border-0 p-0 me-3" onclick="getItemById('`+response[i].NOSJ+`','`+response[i].IDBARANGMERK+`')" data-bs-toggle="modal" data-bs-target="#ModalEditItemSuratJalan">
                                                                <i class="fa-solid fa-pencil fa-xs"></i>
                                                            </button>
                                                            <button class="btn border-0 p-0" onclick="deleteItemSuratJalan('`+response[i].NOSJ+`','`+response[i].IDBARANGMERK+`')">
                                                                <i class="fa-solid fa-trash-can fa-xs"></i>
                                                            </button>
                                                        </div>`,
                                                    ],
                                                ]
                                            ).draw()
                                        });
                                    }
                                },
                                error: function(response) {
                                    
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