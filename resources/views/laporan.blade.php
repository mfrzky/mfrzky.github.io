@include('welcome')
<div class="main" id="main-content">
    <header class="bg-header-menu">
        <div class="p-1">
        <i class="fa-regular fa-folder fa-xs"></i>
        <span>LAPORAN</span>
        </div>
    </header>
    <div class="p-3">
        <h4>{{$getWcCentre->WCCENTRE}}</h4>
        <p>Start Date: <input type="text" id="start_date" placeholder="dd/mm/yyyy" readonly></p>
        <p>End Date  : &nbsp;<input type="text" id="end_date" placeholder="dd/mm/yyyy" readonly></p>
        <a class="btn border btnprn" onclick="PrintClick()">
          Print
        </a>
        <a class="btn border btnprn" target="_blank" id="saveAsPDFButton">
            Lihat Print
        </a>
    </div>
</div>

<script>
    $( "#start_date" ).datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
    $( "#end_date" ).datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
    $("#start_date").datepicker("setDate", new Date());
    $("#end_date").datepicker("setDate", new Date());

    $('.overlay').hide();
    
    function PrintClick() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();

        if (startDate == '' || endDate == '') {
            Swal.fire({
                type: 'warning',
                title: 'Silahkan mengisi tanggal!',
            });
        } else {
            var iframe = document.createElement('iframe');
        
            iframe.style.display = 'none';
            iframe.src = "{{ route('print.prnpriviewLaporan') }}?startDate=" + startDate + "&endDate=" + endDate;
        
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
                    iframe.contentWindow.document.close();
                    iframe.parentNode.removeChild(iframe);
                }, 1000);
            };
        
            document.body.appendChild(iframe);
        }
    }

    $('#saveAsPDFButton').on('click', function() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        
        if (startDate == '' || endDate == '') {
            Swal.fire({
                type: 'warning',
                title: 'Silahkan mengisi tanggal!',
            });
        } else {
            var newTab = window.open();
        
            // Mengambil URL yang ingin ditampilkan dalam iframe
            var url = "{{ route('print.prnpriviewLaporan') }}?startDate=" + startDate + "&endDate=" + endDate;
        
            // Membuat elemen iframe
            var iframe = document.createElement('iframe');
            iframe.src = url;
            iframe.style.width = '100%';
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
</script>