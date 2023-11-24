
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" integrity="sha256-zaSoHBhwFdle0scfGEFUCwggPN7F+ip9XRglo8IWb4w=" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.6/purify.min.js" integrity="sha512-H+rglffZ6f5gF7UJgvH4Naa+fGCgjrHKMgoFOGmcPTRwR6oILo5R+gtzNrpDp7iMV3udbymBVjkeZGNz1Em4rQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.7/pagination/input.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" integrity="sha256-9yRP/2EFlblE92vzCA10469Ctd0jT48HnmmMw5rJZrA=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <script type="text/javascript" src="{{ asset('/js/jquery.printPage.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/moment-with-locales.js') }}"></script>

        <title>TBP - VENDOR PORTAL</title>

        <style>
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                z-index: 999;
            }
            #loader {
                display: none;
                border: 4px solid rgba(255, 255, 255, 0.3);
                border-top: 4px solid #3498db;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                animation: spin 2s linear infinite;
                z-index: 9999;

                /* Menempatkan elemen spinner di tengah halaman */
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body id="body-pd">
        <div class="overlay" id="overlay"></div>
        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif
        @include('components.header')
        @include('components.sidebar')
    </body>
    <script type="text/javascript">
        moment.locale('id');
        
        // ----------------------------------------------------------SIDEBAR----------------------------------------------------------
        $('#divTime').attr('style','display:none !important');
        document.addEventListener("DOMContentLoaded", function (event) {
            const showNavbar = (toggleId, navId, bodyId, headerId, mainContentId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId);
                mainContent = document.getElementById(mainContentId);

            if (toggle && nav && bodypd && headerpd && mainContent) {
                toggle.addEventListener("click", () => {
                nav.classList.toggle("showNav");
                toggle.classList.toggle("bx-x");
                bodypd.classList.toggle("body-pd");
                headerpd.classList.toggle("body-pd");
                mainContent.classList.toggle("main-content-width");
                
                var checkClassShow = $("#nav-bar").hasClass("showNav");
                if (checkClassShow == true) {
                    $('#divTime').show();
                } else {
                    console.log('tes')
                    $('#divTime').attr('style','display:none !important');
                }
                });
            }
            };

            showNavbar("header-toggle", "nav-bar", "body-pd", "header", "main-content");

            const linkColor = document.querySelectorAll(".nav_link");

            function colorLink() {
            if (linkColor) {
                linkColor.forEach((l) => l.classList.remove("active"));
                this.classList.add("active");
            }
            }
            linkColor.forEach((l) => l.addEventListener("click", colorLink));
        });
        
        // ----------------------------------------------------------TIME SIDEBAR----------------------------------------------------------
        function refreshTime() {
            const timeDisplay = document.getElementById("time");
            const dateString = new Date().toLocaleString("id-ID");
            const formattedString = dateString.replace(", ", " ").replace(".", ":").replace(".", ":");
            timeDisplay.textContent = formattedString;
        }
        setInterval(refreshTime, 1000);

        $('#logoutButton').on('click', function() {
            Swal.fire({
                title: 'Apakah Anda ingin tetap keluar?',
                showCancelButton: true,
            }).then((result) => {
                if (result.value == true) {
                    $.ajax({
                        url: "{{route('logout')}}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        type: 'GET',
                        success: function(response) {
                            window.location.href = "{{route('login')}}";
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
        })
    </script>
</html>
