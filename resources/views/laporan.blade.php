@include('welcome')
<div class="main" id="main-content">
    <header class="bg-header-menu">
        <div class="p-1">
        <i class="fa-regular fa-folder fa-xs"></i>
        <span>LAPORAN</span>
        </div>
    </header>
    <div class="p-3">
        <p>Start Date: <input type="date" id="start_date"></p>
        <p>End Date  : &nbsp;<input type="date" id="end_date"></p>
        <a class="btn border btnprn" onclick="PrintClick()">
          Print
        </a>
    </div>
</div>

<script>
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
</script>