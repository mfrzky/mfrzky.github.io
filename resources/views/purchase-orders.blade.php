@include('welcome')
<div class="main" id="main-content">
  <header class="bg-header-menu">
    <div class="p-1">
      <i class="fa-solid fa-cart-shopping fa-xs"></i>
      <span>PURCHASE ORDERS</span>
    </div>
  </header>

  <div class="p-1">
    <table id="purchase-list" class="display cell-border" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>No PO</th>
              <th>Tanggal</th>
              <th>Delivery</th>
              <th>Rev No</th>
              <th>Status</th>
              <th>Jumlah</th>
              <th>Open</th>
          </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  
  <div class="p-1">
    <div class="p-1 w-100 bg-header-menu rounded-top">
      <i class="fa-solid fa-file-lines fa-xs"></i>
      <span>ITEMS</span>
    </div>
    <table id="purchase-item" class="display cell-border" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>Item</th>
              <th>Quantity</th>
              <th>Sisa</th>
              <th>Harga</th>
          </tr>
      </thead>
      <tbody>
          
      </tbody>
    </table>
  </div>

  <div class="px-3 pb-3">
    <a class="btn border btnprn" onclick="PrintClick()">
      Print
    </a>
    <a class="btn border btnprn" target="_blank" id="saveAsPDFButton">
      Lihat Print
    </a>
    <button type="button" class="btn border" id="controlDelivery">
      Control Delivery
    </button>
  </div>

  <!-- Modal Control Delivery -->
  <div class="modal fade" id="ModalControlDelivery" tabindex="-1" aria-labelledby="ModalControlDeliveryLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalControlDeliveryLabel">Control Delivery</h5>
          <button type="button" class="btn-close" id="closeModalDelivery" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <div class="p-1 w-100 bg-header-menu rounded-top">
              <i class="fa-solid fa-cart-shopping fa-xs"></i>
              <span>SURAT JALAN</span>
            </div>
            <table id="surat-jalan" class="display cell-border" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>No.SJ</th>
                      <th>Tgl.SJ</th>
                      <th>NO.PO</th>
                      <th>ID Barang</th>
                      <th>Description</th>
                      <th>Satuan</th>
                      <th>QTY PO</th>
                      <th>QTY SJ</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

          <div class="my-5">
            <div class="p-1 w-100 bg-header-menu rounded-top">
              <i class="fa-solid fa-cart-shopping fa-xs"></i>
              <span>BON PENERIMAAN BARANG</span>
            </div>
            <table id="bon-penerimaan-barang" class="display cell-border" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>No.BPB</th>
                      <th>Tgl.BPB</th>
                      <th>No.SJ</th>
                      <th>No.PO</th>
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

  <div id='loader'></div>
</div>

<script type="text/javascript">
  $('.overlay').hide();
  // --------------------------------------------------------------------------------------------------------------------
  var listTable = $('#purchase-list').DataTable({
    processing: true,
    serverSide: true,
    deferRender: true,
    responsive: true,
    bInfo: false,
    pageLength: 20,
    scrollCollapse: true,
    scrollY: '30vh',
    language: {
      search: "ID",
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
			url : "{{ route('purchase-orders.index') }}",
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
			{"data" : "REVNO"},
      {"data" : "FHABIS", "render": function(data){
        if(data == 'Y') {
          return 'Close'
        } else {
          return 'Open'
        }
      }},
			{"data" : "JUMLAHPO", className: "text-end", "render": function(data){
        return parseFloat(data).toLocaleString()  
      }},
			{"data" : "TANGGALENTRI", className: "text-center", "render": function(data){
        if (data) {
          return moment(data).format('DD MMM YYYY H:MM:SS');
        } else {
          return '-'
        }
      }},
		],
    order: [[1, 'desc']]
  });
  
  $('#purchase-item').dataTable({
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

  var tableSj = $('#surat-jalan').DataTable({
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
  var rowCount = tableSj.rows().count();
  if (rowCount > 10) {
    tableSj.scrollY('30vh');
  }

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

  var tPurchaseList = $('#purchase-list').DataTable();
  var tPurchaseItem = $('#purchase-item').DataTable();
  var tSuratJalan = $('#surat-jalan').DataTable();
  var tBonPenerimaanBarang = $('#bon-penerimaan-barang').DataTable();
  var tBonReturBarang = $('#bon-retur-barang').DataTable();

  $('#purchase-item_paginate').attr('style', 'display: none !important');
  $('#surat-jalan_paginate').attr('style', 'display: none !important');
  $('#bon-penerimaan-barang_paginate').attr('style', 'display: none !important');
  $('#bon-retur-barang_paginate').attr('style', 'display: none !important');
   
  tPurchaseList.on('click', 'tbody tr', (e) => {
    let classList = e.currentTarget.classList;

    if (classList.contains('selected')) {
      classList.remove('selected');
    } else {
      tPurchaseList.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
      classList.add('selected');
    }
  });

  $('#purchase-list').on('search.dt', function() {
    tPurchaseItem.clear().draw();
  });
  

  var noPO;
  var ajaxRequestPending = false;
  var checkSj;
  var checkItemPO;
  $('#purchase-list tbody').on('click', 'td:not(:last-child)', function (e) {
    tPurchaseItem.clear().draw();
    tSuratJalan.clear().draw();
    tBonPenerimaanBarang.clear().draw();
    tBonReturBarang.clear().draw();

    if (checkSj && checkSj.readyState !== 4) {
      checkSj.abort();
    }

    noPO = tPurchaseList.row(this).data().IDPO;
    var selectedRows = tPurchaseItem.rows( { selected: true } ).count();

    if (ajaxRequestPending) {
      var newId = tPurchaseList.row(this).data().IDPO;
      noPO = newId
    }

    ajaxRequestPending = true;

    // -------------- GET ITEM PO --------------
    checkItemPO = $.ajax({
      url: "{{route('purchase-orders-item-po.indexItemPo')}}",
      type: 'GET',
      data: {
        id: noPO,
      },
      success: function(response) {
        ajaxRequestPending = false;
        if (response.length > 10) {
          $('#purchase-item_paginate').attr('style', 'display: block !important');
        } else {
          $('#purchase-item_paginate').attr('style', 'display: none !important');
        }

        $.each(response, function(i, item) {
          tPurchaseItem.rows.add(
            [
              [
                response[i].BARANGTIPE, 
                "<div class='text-end'>"+parseFloat(response[i].QUANTITY).toLocaleString().toLocaleString()+"</div>",
                "<div class='text-end'>"+parseFloat(response[i].SISAPO).toLocaleString()+"</div>",
                "<div class='text-end'>"+parseFloat(response[i].HARGA).toLocaleString()+"</div>",
              ],
            ]
          ).draw()
        });
      },
      error: function(response) {
        ajaxRequestPending = false;
      }
    });

    // -------------- GET SJ --------------
    checkSj = $.ajax({
      url: "{{route('purchase-orders-item-sj.indexItemSuratJalan')}}",
      type: 'GET',
      data: {
        id: noPO,
      },
      success: function(response) {
        if (response.length > 10) {
          $('#surat-jalan_paginate').attr('style', 'display: block !important');
        } else {
          $('#surat-jalan_paginate').attr('style', 'display: none !important');
        }

        if (response.length > 0) {
          $.each(response, function(i, item) {
            tSuratJalan.rows.add(
              [
                [
                  response[i].NOSJ,
                  moment(response[i].TANGGAL).format('DD MMM YYYY'),
                  response[i].IDPO,
                  response[i].IDBARANGMERK,
                  response[i].DESKRIPSI,
                  response[i].SATUAN,
                  "<div class='text-end'>"+parseFloat(response[i].QTY_PO).toLocaleString()+"</div>",
                  "<div class='text-end'>"+parseFloat(response[i].QTY_SJ).toLocaleString()+"</div>",
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
    $.ajax({
      url: "{{route('purchase-orders-item-bpb.indexItemBonPenerimaanBarang')}}",
      type: 'GET',
      data: {
        id: noPO,
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
                  "<div class='text-end'>"+parseFloat(response[i].QTY_SJ == null ? 0 : response[i].QTY_SJ).toLocaleString()+"</div>",
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
        id: noPO,
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
                  moment(response[i].TGLSTOCKIN).format('DD MMM YYYY'),
                  response[i].NOSJ,
                  response[i].IDBARANGMERK,
                  response[i].DESKRIPSI,
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

    $('.overlay').show();
    $('#loader').show();
    checkItemPO.done(function(data, textStatus, jqXHR) {
      if (jqXHR.status === 200) {
          $('.overlay').hide();
          $('#loader').hide();
      }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log('Permintaan Ajax gagal dengan status: ' + jqXHR.status);
    });
  });

  $('#controlDelivery').on('click', function() {
    if (checkSj == undefined) {
      Swal.fire({
        type: 'warning',
        title: 'Silahkan pilih No PO!',
      });
    } else {
      $('.overlay').show();
      $('#loader').show();
      checkSj.done(function(data, textStatus, jqXHR) {
        if (jqXHR.status === 200) {
            $('.overlay').hide();
            $('#loader').hide();
            $('#ModalControlDelivery').modal('show');
        }
      }).fail(function(jqXHR, textStatus, errorThrown) {
          console.log('Permintaan Ajax gagal dengan status: ' + jqXHR.status);
      });
    }
  })

  function PrintClick() {
    if (noPO == undefined) {
      Swal.fire({
        type: 'warning',
        title: 'Silahkan pilih No PO!',
      });
    } else {
      var iframe = document.createElement('iframe');
  
      iframe.style.display = 'none';
      iframe.src = "{{ route('print.prnpriview') }}?id=" + noPO;
  
      // Hapus margin dan padding iframe
      iframe.style.margin = '0';
      iframe.style.padding = '0';
      
      iframe.onload = function() {
        var mql = iframe.contentWindow.matchMedia('print');
        mql.addListener(function(m) {
          if (m.matches) {
            iframe.contentWindow.print();
            setTimeout(function() {
              iframe.contentWindow.document.close();
              iframe.parentNode.removeChild(iframe);
            }, 1000);
          }
        });
  
        iframe.contentWindow.print();
      
        setTimeout(function() {
          // Reset pengaturan cetakan
          iframe.contentWindow.document.close();
          iframe.parentNode.removeChild(iframe);
        }, 1000);
      };
  
      document.body.appendChild(iframe);
    }
  }
  
  $('#saveAsPDFButton').on('click', function() {
    if (noPO == undefined) {
      Swal.fire({
        type: 'warning',
        title: 'Silahkan pilih No PO!',
      });
    } else {
      var newTab = window.open();
  
      // Mengambil URL yang ingin ditampilkan dalam iframe
      var url = "{{ route('print.prnpriview') }}?id=" + noPO;
  
      // Membuat elemen iframe
      var iframe = document.createElement('iframe');
      iframe.src = url;
      iframe.style.width = '148mm';
      iframe.style.height = '210mm';
      iframe.style.overflow = 'hidden';
      iframe.style.margin = '0';
      iframe.style.padding = '0';
      iframe.style.border = 'none';
  
      // Atur orientasi halaman potret (portrait)
      iframe.style.transform = 'rotate(0deg)';
  
      // Menambahkan iframe ke tab baru
      newTab.document.body.appendChild(iframe);
  
      iframe.onload = function() {
        // Mendapatkan dokumen dalam iframe
        var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
  
        // Mencari semua elemen dengan class .row dan mengubah nilainya menjadi 0
        var rows = iframeDocument.querySelectorAll('.row');
        rows.forEach(function(row) {
          row.style.marginRight  = '0';
        });
      };
    }
  });

  // --------------------------------------------------------------------------------------------------------------------

  $('div.dataTables_filter').addClass('d-flex align-items-center justify-content-between').append(`
    <label class="ms-3">
      <span>FILTER STATUS:</span>
      <select id="statusFilter">
        <option value="all" selected>All</option>
        <option value="N">Open</option>
        <option value="Y">Close</option>
      </select>
    </label>
  `);
  $('#statusFilter').on('change', function () {
    var selectedValue = $(this).val();
    if (selectedValue === 'all') {
      listTable.column(4).search('').draw();
    } else {
      listTable.column(4).search(selectedValue).draw();
    }
  });

  $('div.toolbar').html(`<div class="p-1 w-100 bg-header-menu rounded-top">
      <i class="fa-solid fa-cart-shopping fa-xs"></i>
      <span>LIST</span>
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
  </div>`).insertAfter($("#purchase-item_wrapper > .dataTables_scroll > .dataTables_scrollBody"));

  $('.reloadListTable').on('click', function() {
    tPurchaseList.ajax.reload();
  })

  $('.reloadItemTable').on('click', function() {
    tPurchaseItem.clear().draw();
    $('#purchase-item_paginate').attr('style', 'display: none !important');
    window.location.reload();
  })

  $('.dataTables_filter input')
    .off()
    .on( 'keyup', function () {
      tPurchaseList.column(0).search( this.value ).draw();
  });

  // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
</script>