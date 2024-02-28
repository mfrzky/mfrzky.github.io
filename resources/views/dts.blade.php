@include('welcome')
<div class="main" id="main-content">
    <div class="p-3">
        <!-- <div class="d-flex align-items-center w-100 mb-3">
            <span class="me-2">
                Group Material
            </span>
            <select id="" class="form-select">
                <option value="" hidden selected>Select Group</option>
                <option value="">INJECTION</option>
            </select>
        </div> -->
        <div class="d-flex justify-content-between align-items-center p-1 w-100 bg-header-menu rounded-top">
            <div>
                <i class="fa-solid fa-list"></i>
                <span>LIST</span>
            </div>
            <div>
                <button class="btn py-0 border-0" type="button">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </button>
                <button class="btn py-0 border-0" type="button">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
        </div>
        <table id="dts-list" class="display cell-border" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <!-- <th>No.</th> -->
                    <th>Title</th>
                    <th>Download At</th>
                    <th>Last Download</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($files) && $files)
                    @foreach ($filesWithDownloadInfo as $key => $file)
                        <tr>
                            <!-- <td class="text-center" style="width:5%;"></td> -->
                            <td>{{$key}}</td>
                            <td>{{ $file['DOWNLOAD_AT'] ? \Carbon\Carbon::parse($file['DOWNLOAD_AT'])->format('d-m-Y H:i:s') : '-'}}</td>
                            <td>{{ $file['LAST_DOWNLOAD'] ? \Carbon\Carbon::parse($file['LAST_DOWNLOAD'])->format('d-m-Y H:i:s') : '-'}}</td>
                            <td class="text-center" style="width:5%;">
                                <button class="btn border-0">
                                    <a href="{{ url('/download/' . $key) . '?timestamp=' . now()->timestamp }}" class="fa-solid fa-download" onclick="handleDownloadClick()"></a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $('.overlay').hide();
    // ----------------------------------------------------------TABLE ITEM----------------------------------------------------------
    var tDtsList = $('#dts-list').DataTable({
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
        pagingType: 'input',
        lengthChange: false
    });

    if (tDtsList.rows()[0].length > 10) {
        $('#dts-list_paginate').attr('style', 'display: block !important');
    } else {
        $('#dts-list_paginate').attr('style', 'display: none !important');
    }

    $('#downloadFile').on('click', function() {
       
    })
    function handleDownloadClick() {
        Swal.fire({
            type: 'success',
            title: 'File berhasil di download!',
        }).then(function(){ 
           window.location.reload()
        });
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
</script>