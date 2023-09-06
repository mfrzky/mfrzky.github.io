
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.7/pagination/input.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <title>TBP - VENDOR PORTAL</title>
    </head>
    <body id="body-pd">
        @include('components.header')
        @include('components.sidebar')
    </body>
    <script type="text/javascript">
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
    </script>
</html>
