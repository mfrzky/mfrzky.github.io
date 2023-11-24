@include('welcome')
<div class="main" id="main-content">
  <header class="bg-header-menu">
    <div class="p-1">
      <i class="fa-solid fa-list-check fa-xs"></i>
      <span>MANAGEMENT MATERIAL</span>
    </div>
  </header>

  <div class="p-1">
    <table id="management-material-list" class="display cell-border" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>ID DOCKET</th>
              <th>Tanggal</th>
              <th>Type</th>
              <th>WHS FINISH</th>
              <th>WHS COMP</th>
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
  </div>

  <!-- Modal Add List -->
  <div class="modal fade" id="ModalAddList" tabindex="-1" aria-labelledby="ModalAddListLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"> 
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalAddListLabel">Add Management Material</h5>
          <button type="button" class="btn-close" id="closeModalDelivery" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formAddManagementMaterial">
            <div class="row">
              <div class="col-6">
                <div class="input-group mb-3">
                  <label class="input-group">Type</label>
                  <select name="type" class="form-select" id="typeManagementMaterial" required>
                    <option value="" hidden></option>
                    <option value="P">P</option>
                    <option value="S">S</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group">Stock Code</label>
                  <div class="input-group">
                    <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" id="idStock" required>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <button class="btn border-0 p-0" type="button" id="getStockCode" data-bs-toggle="modal" data-bs-target="#ModalStockCode">
                                <i class="fa-solid fa-ellipsis fa-xs"></i>
                            </button>
                        </span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group">PI NO</label>
                  <input type="text" class="form-control" id="piNoManagementMaterial" value="-">
                </div>
                <!-- <div class="input-group mb-3">
                  <label class="input-group" id="wcManagementMaterial">W/C</label>
                  <select name="wc" class="form-select" id="wcManagementMaterial">
                  </select>
                </div> -->
              </div>
              <div class="col-6">
                <div class="input-group mb-3">
                  <label class="input-group">Shift</label>
                  <select name="shift" class="form-select" id="shiftManagementMaterial" required>
                    <option value="" hidden></option>
                    <option value="D">D</option>
                    <option value="A">A</option>
                    <option value="N">N</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group">Grup</label>
                  <input type="text" class="form-control" id="grupManagementMaterial" disabled>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group">Quantity</label>
                  <input type="text" class="form-control" id="qtyManagementMaterial" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary border">
                Add
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Stock Code -->
  <div class="modal fade" id="ModalStockCode" tabindex="-1" aria-labelledby="ModalStockCode" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalStockCodeLabel">Stock Code</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <table id="stock-code-list" class="display cell-border" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID Stock</th>
                        <th>Deskripsi</th>
                        <th>ID Stock Group</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger border" id="btnAddStockCode">
                OK
            </button>
            <button class="btn btn-primary border" id="btnCancelStockCode">
                Cancel
            </button>
        </div>
      </div>
    </div>
  </div>

  <!-- <div id='loader'></div> -->
</div>

<script>
  $('.overlay').hide();
  $('#management-material-list').dataTable({
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
      sDom: '<"toolbar">',
      pagingType: 'input',
      lengthChange: false,
      ajax: {
        url : "{{ route('management-material.index') }}",
        type: 'GET',
      },
      columns : [
          {"data" : "IDDOCKET"},
          {"data" : "TGLDOCKET", "render": function(data){
              return moment(data).format('DD MMM YYYY');
          }},
          {"data" : "TYPEDOCKET"},
          {"data" : "WHSFINISH"},
          {"data" : "WHSCOMP"},
      ],
  });

  $('#stock-code-list').dataTable({
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
    pagingType: 'input',
    lengthChange: false,
    ajax: {
      url : "{{ route('management-material.indexStockCode') }}",
      type: 'GET',
    },
    columns : [
        {"data" : "IDSTOCK"},
        {"data" : "DESKRIPSI"},
        {"data" : "IDSTOCKGROUP"},
    ],
  });
  
  var tManagementMaterial = $('#management-material-list').DataTable();
  tManagementMaterial.on('click', 'tbody tr', (e) => {
    let classList = e.currentTarget.classList;

    if (classList.contains('selected')) {
      classList.remove('selected');
    }
    else {
      tManagementMaterial.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
      classList.add('selected');
    }
  });

  var tDaftarStockCode = $('#stock-code-list').DataTable();
  tDaftarStockCode.on('click', 'tbody tr', (e) => {
    let classList = e.currentTarget.classList;

    if (classList.contains('selected')) {
      classList.remove('selected');
    }
    else {
      tDaftarStockCode.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
      classList.add('selected');
    }
  });

  var idDocket;
  function PrintClick() {
    idDocket = tManagementMaterial.row('.selected').data().IDDOCKET;
    var iframe = document.createElement('iframe');

    iframe.style.display = 'none';
    iframe.src = "{{ route('print.prnpriviewManagementMaterial') }}?id=" + idDocket;

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

  $('#btnAddStockCode').on('click', function() {
    $('#ModalStockCode').modal('hide');
    $('#ModalAddList').modal('show');
    $('#idStock').val(tDaftarStockCode.row('.selected').data().IDSTOCK);
    $('#grupManagementMaterial').val(tDaftarStockCode.row('.selected').data().IDSTOCKGROUP);
  })

  $('#btnCancelStockCode').on('click', function() {
    $('#ModalStockCode').modal('hide');
    $('#ModalAddList').modal('show');
  })

  $('#formAddManagementMaterial').submit(function(event) {
    var formData = {
      TYPE : $('#typeManagementMaterial').val(),
      SHIFT :  $('#shiftManagementMaterial').val(),
      STOCKCODE :  $('#idStock').val(),
      GRUP :  $('#grupManagementMaterial').val(),
      PINO :  $('#piNoManagementMaterial').val(),
      QUANTITY :  $('#qtyManagementMaterial').val(),
    }

    $.ajax({
      type: "POST",
      url: "{{route('management-material.addManagementMaterial')}}",
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
            title: 'WC Centre tidak terdaftar!',
          });
        } else {
          Swal.fire({
            type: 'success',
            title: 'Item Berhasil Ditambahkan!',
          }).then(function(){
  
          });
        }
      }
    })

    event.preventDefault();
  });

  $('#management-material-list_paginate').attr('style', 'display: none !important');
  $('div.toolbar').html(`<div class="p-1 w-100 bg-header-menu rounded-top d-flex justify-content-between align-items-center">
      <div>
          <i class="fa-solid fa-list fa-xs"></i>
          <span>LIST</span>
      </div>
      <div>
          <button class="btn border-0 p-0" type="button" data-bs-toggle="modal" data-bs-target="#ModalAddList">
              <i class="fa-solid fa-plus fa-xs"></i>
          </button>
      </div>
  </div>`).insertAfter("#management-material-list_filter");
</script>