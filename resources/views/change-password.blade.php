@include('welcome')
<div class="main" id="main-content">
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card bg-white shadow">
                        <div class="card-body p-5">
                            <form method="POST" action="{{ route('login.postChangePassword') }}" autocomplete="off">
                                @csrf
                                <h1 class="h3 mb-3 fw-bold text-center">Ubah Password</h1>
                                <div class="input-group mb-2">
                                    <!-- <i class="fa-solid fa-lock input-group-text d-flex justify-content-center align-items-center"></i> -->
                                    <input type="password" class="form-control" name="oldPass" id="oldPass" autofocus="off" required value="" aria-describedby="basic-email" placeholder="Password Lama">
                                    <div class="input-group-append input-group-text toggle-password">
                                        <i class="fa-solid fa-eye"></i>
                                   </div>
                                </div>
                                <div class="input-group mb-2">
                                    <!-- <i class="fa-solid fa-lock input-group-text d-flex justify-content-center align-items-center"></i> -->
                                    <input type="password" class="form-control" name="newPass" id="newPass" autofocus="off" required aria-describedby="basic-pass" placeholder="Password Baru">
                                    <div class="input-group-append input-group-text toggle-password">
                                        <i class="fa-solid fa-eye"></i>
                                   </div>
                                </div>
                
                                <div class="d-flex">
                                    <button class="w-100 btn btn-lg mt-3 border btn-primary" type="submit">Ok</button>
                                    <button class="w-100 btn btn-lg mt-3 border btn-danger" id="cancel" type="button">Cancel</button>
                                </div>
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
        $('.overlay').hide();

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

        $('.toggle-password').click(function(){
            $(this).children().toggleClass('fa-eye fa-eye-slash');
            let input = $(this).prev();
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
        });

        $('#cancel').on('click', function(){
            window.history.back();
        })
    });
</script>