@include('welcome')
<div class="main" id="main-content">
  <header class="bg-header-menu">
    <div class="p-3">
      <i class="fa-solid fa-cart-shopping"></i>
      <span>PURCHASE ORDERS</span>
    </div>
  </header>

  <div class="p-3">
    <table id="purchase-list" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>No PO</th>
              <th>Tanggal</th>
              <th>Delivery</th>
              <th>Rev No</th>
              <th>Full</th>
              <th>Jumlah</th>
              <th>Open</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>09200/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09201/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09202/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09203/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09204/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09205/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09206/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09207/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09208/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09209/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09210/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
          <tr>
              <td>09211/2023</td>
              <td>07 Aug 2023</td>
              <td>10 Aug 2023</td>
              <td>-</td>
              <td>Y</td>
              <td>4.400.000</td>
              <td>10 Aug 2023 11.54</td>
              <td>Print</td>
          </tr>
      </tbody>
    </table>
  </div>
  
  <div class="p-3">
    <div class="p-2 w-100 bg-header-menu rounded-top">
      <i class="fa-solid fa-file-lines"></i>
      <span>ITEMS</span>
    </div>
    <table id="purchase-item" class="display table table-bordered" cellspacing="0" width="100%">
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
    <button class="btn border">
      Print
    </button>
    <button type="button" class="btn border" data-bs-toggle="modal" data-bs-target="#ModalControlDelivery">
      Control Delivery
    </button>
  </div>

  <!-- Modal Control Delivery -->
  <div class="modal fade" id="ModalControlDelivery" tabindex="-1" aria-labelledby="ModalControlDeliveryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalControlDeliveryLabel">Control Delivery</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <div class="p-2 w-100 bg-header-menu rounded-top">
              <i class="fa-solid fa-cart-shopping"></i>
              <span>SURAT JALAN</span>
            </div>
            <table id="surat-jalan" class="display table table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>Tiger Nixon</td>
                      <td>System Architect</td>
                      <td>Edinburgh</td>
                      <td>61</td>
                      <td>2011-04-25</td>
                      <td>$320,800</td>
                  </tr>
                  <tr>
                      <td>Garrett Winters</td>
                      <td>Accountant</td>
                      <td>Tokyo</td>
                      <td>63</td>
                      <td>2011-07-25</td>
                      <td>$170,750</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
              </tbody>
            </table>
          </div>

          <div class="my-5">
            <div class="p-2 w-100 bg-header-menu rounded-top">
              <i class="fa-solid fa-cart-shopping"></i>
              <span>BON PENERIMAAN BARANG</span>
            </div>
            <table id="bon-penerimaan-barang" class="display table table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>Tiger Nixon</td>
                      <td>System Architect</td>
                      <td>Edinburgh</td>
                      <td>61</td>
                      <td>2011-04-25</td>
                      <td>$320,800</td>
                  </tr>
                  <tr>
                      <td>Garrett Winters</td>
                      <td>Accountant</td>
                      <td>Tokyo</td>
                      <td>63</td>
                      <td>2011-07-25</td>
                      <td>$170,750</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
              </tbody>
            </table>
          </div>

          <div class="mb-3">
            <div class="p-2 w-100 bg-header-menu rounded-top">
              <i class="fa-solid fa-cart-shopping"></i>
              <span>BON RETUR BARANG</span>
            </div>
            <table id="bon-retur-barang" class="display table table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>Tiger Nixon</td>
                      <td>System Architect</td>
                      <td>Edinburgh</td>
                      <td>61</td>
                      <td>2011-04-25</td>
                      <td>$320,800</td>
                  </tr>
                  <tr>
                      <td>Garrett Winters</td>
                      <td>Accountant</td>
                      <td>Tokyo</td>
                      <td>63</td>
                      <td>2011-07-25</td>
                      <td>$170,750</td>
                  </tr>
                  <tr>
                      <td>Ashton Cox</td>
                      <td>Junior Technical Author</td>
                      <td>San Francisco</td>
                      <td>66</td>
                      <td>2009-01-12</td>
                      <td>$86,000</td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  // ----------------------------------------------------------TABLE LIST & TABLE ITEM----------------------------------------------------------
  $('#purchase-list').dataTable({
    responsive: true,
    bInfo: false,
    scrollCollapse: true,
    scrollY: '20vh',
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
  });
  
  $('#purchase-item').dataTable({
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

  $('div.toolbar').html(`<div class="p-2 w-100 bg-header-menu rounded-top">
      <i class="fa-solid fa-cart-shopping"></i>
      <span>LIST</span>
  </div>`).insertAfter(".dataTables_filter");
 
  $('div.reloadList').html(`<div class="p-2 float-end">
    <button class="btn py-0 border-0 reloadListTable" type="button">
      <i class="fa-solid fa-arrows-rotate"></i>
    </button>
  </div>`).insertBefore(".dataTables_paginate paging_input");

  $('div.reloadItem').html(`<div class="p-2 float-end">
    <button class="btn py-0 border-0 reloadItemTable" type="button">
      <i class="fa-solid fa-arrows-rotate"></i>
    </button>
  </div>`).insertAfter($("#purchase-item_wrapper > .dataTables_scroll > .dataTables_scrollBody"));

  var tPurchaseList = $('#purchase-list').DataTable();
  var tPurchaseItem = $('#purchase-item').DataTable();
  $('#purchase-list tbody').on('click', 'tr', function () {
    const noPO = tPurchaseList.row(this).data()[0];
    var selectedRows = tPurchaseItem.rows( { selected: true } ).count();
    
    if (selectedRows > 0 && (noPO == '09200/2023' || noPO == '09201/2023')) {
      Swal.fire({
        type: 'warning',
        title: 'List sudah ditambahkan!',
        text: 'Silahkan refresh table items'
      });
      return
    } else {
      if (noPO == '09200/2023') {
        tPurchaseItem.rows.add(
          [
            ["FILTER: U/MASKER HIJAU", "21250","0", "65" ],
            ["SARUNG TANGAN: KATUN B-4", "7650", "0", "1,200" ],
            ["SARUNG TANGAN KARET PANJANG", "1536", "0", "5,400" ],
          ]
        ).draw()
      } else if (noPO == '09201/2023') {
        tPurchaseItem.rows.add(
          [
            ["FILTER: U/MASKER MERAH", "10200","0", "55" ],
            ["SARUNG TANGAN: KOMBINASI", "1820", "0", "1,200" ],
            ["SARUNG TANGAN KARET PENDEK", "9201", "0", "5,400" ],
          ]
        ).draw()
      }
    }
  });

  $('.reloadItemTable').on('click', function() {
    tPurchaseItem.clear().draw();
  })
  
  // ----------------------------------------------------------TABLE MODAL CONTROL DELIVERY----------------------------------------------------------
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
  // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
</script>