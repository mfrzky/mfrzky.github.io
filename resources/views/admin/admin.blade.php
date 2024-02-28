@include('welcome')
<div class="main" id="main-content">
  <header class="bg-header-menu">
    <div class="p-1">
      <i class="fa-solid fa-user fa-xs"></i>
      <span>ADMIN</span>
    </div>
  </header>

  <div class="p-1">
    <table id="list-vendor" class="display cell-border" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>ID Supplier</th>
              <th>Nama Vendor</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

  <!-- Modal Ubah Password -->
  <div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="ModalUbahPasswordLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalUbahPasswordLabel">Ubah Password</h5>
          <button type="button" class="btn-close" id="closeModalDelivery" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
            <div class="modal-body">
                <label>Password Baru</label>
                <input type="text" oninput="this.value" class="form-control" value="" id="newPass">
            </div>
            <div class="modal-footer">
                <button class="btn btn-info border text-white">
                    Ubah Password
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <div id='loader'></div>
</div>

<script type="text/javascript">
    $('.overlay').hide();

    var listTable = $('#list-vendor').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        responsive: true,
        bInfo: false,
        pageLength: 20,
        scrollCollapse: true,
        scrollY: '50vh',
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
                url : "{{ route('admin-menu.index') }}",
                type: 'GET',
        },
        columns : [
            {"data" : "IDSUPPLIER"},
            {"data" : "EMAIL"},
            {
                data: "EMAIL",
                render: function (data, type, row, meta) {
                    if (type === 'display') {
                        return '<button type="button" class="btn btn-warning border py-1 px-3 my-2 text-white" onclick="changePassword(\'' + row.EMAIL + '\')">Ubah Password</button>';
                    }
                    return data;
                }
            },
        ],
        order: [[1, 'asc']]
    });

    function changePassword(email){
        $('#ModalUbahPassword').modal('show');

        $("form").submit(function(event) {
            event.preventDefault();
            var newPass = $('#newPass').val();
    
            $.ajax({
                url: "{{route('email-vendor.changeEmailVendor')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'POST',
                data: {
                    email: email,
                    newPassword: newPass
                },
                success: function(response){
                    Swal.fire({
                        type: 'success',
                        title: 'Sukses Mengubah Password',
                    }).then(function(){
                        $('#ModalUbahPassword').modal('hide');
                    });
                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        title: 'Sudah ada BPB!',
                    });
                }
            });
        });
    };

    $('div.toolbar').html(`<div class="p-1 w-100 bg-header-menu rounded-top d-flex justify-content-between align-items-center">
        <div>
            <i class="fa-solid fa-user fa-xs"></i>
            <span>LIST VENDOR</span>
        </div>
        <div>
            <button class="btn border-0 p-0" type="button" data-bs-toggle="modal" data-bs-target="#ModalAddListSuratJalan">
                <i class="fa-solid fa-plus fa-xs"></i>
            </button>
        </div>
    </div>`).insertAfter(".dataTables_filter");
</script>