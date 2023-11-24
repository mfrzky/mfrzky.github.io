@include('welcome')
<div class="main" id="main-content">
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card bg-white shadow">
                        <div class="card-body p-5">
                            <form method="POST" action="{{ route('login.postChangePassword') }}">
                                @csrf
                                <h1 class="h3 mb-3 fw-bold text-center">Ubah Password</h1>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="oldPass" id="oldPass" required value="" aria-describedby="basic-email" placeholder="Password Lama">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="newPass" id="newPass" autocomplete="on" required aria-describedby="basic-pass" placeholder="Password Baru">
                                </div>
                
                                <button class="w-100 btn btn-lg mt-3 border btn-primary" type="submit">Ok</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("form").submit(function(event) {
            var oldPass = $("#oldPass").val();
            var newPass = $("#newPass").val();
            var token = $("meta[name='csrf-token']").attr("content");

            if(oldPass.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Password Lama Wajib Diisi !'
                });
            } else if(newPass.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Password Baru Wajib Diisi !'
                });
            } else {
                $.ajax({
                    url: "{{ route('login.postChangePassword') }}",
                    type: "POST",
                    dataType: "JSON",
                    cache: false,
                    data: {
                        "oldPass": oldPass,
                        "newPass": newPass,
                        "_token": token
                    },

                    success:function(response){
                        if (response.success) {
                            Swal.fire({
                                type: 'success',
                                title: 'Sukses mengubah password, silakan login kembali!',
                            }).then(function(){ 
                                window.location.href = "{{ route('logout') }}";
                                return false;
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Login Gagal!',
                                text: 'silahkan coba lagi!'
                            });
                        }
                    },

                    error:function(response){
                        Swal.fire({
                            type: 'error',
                            title: 'Opps!',
                            text: 'Silahkan cek kembali password lama Anda!'
                        });
                    }
                });

                event.preventDefault();
            }
        });
    });
</script>