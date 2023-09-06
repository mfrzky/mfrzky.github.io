<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card bg-white shadow">
                        <div class="card-body p-5">
                            <h1 class="h3 mb-3 fw-bold text-center">Trimitra Baterai Prakasa</h1>
                            <h1 class="h5 mb-3 fw-normal text-center">Vendor Portal</h1>
                            <div class="input-group mb-3">
                                <i class="fa-solid fa-user input-group-text d-flex justify-content-center align-items-center" id="basic-email"></i>
                                <input type="email" class="form-control" name="email" id="email" required value="" aria-describedby="basic-email">
                            </div>
                            <div class="input-group mb-3">
                                <i class="fa-solid fa-lock input-group-text d-flex justify-content-center align-items-center"></i>
                                <input type="password" class="form-control" name="password" id="password" required aria-describedby="basic-pass">
                            </div>
            
                            <button class="w-100 btn btn-lg mt-3 border btn-login" type="submit">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $(".btn-login").click( function() {
            var email = $("#email").val();
            var password = $("#password").val();
            var token = $("meta[name='csrf-token']").attr("content");

            if(email.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Alamat Email Wajib Diisi !'
                });
            } else if(password.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Password Wajib Diisi !'
                });
            } else {
                $.ajax({
                    url: "{{ route('login.check_login') }}",
                    type: "POST",
                    dataType: "JSON",
                    cache: false,
                    data: {
                        "email": email,
                        "password": password,
                        "_token": token
                    },

                    success:function(response){
                        if (response.success) {
                            window.location.href = "{{ route('purchase-orders.index') }}";
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
                            text: 'server error!'
                        });
                        console.log(response);
                    }
                });
            }
        });
    });
</script>
</body>
</html>