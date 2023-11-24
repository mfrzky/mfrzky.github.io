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
                    <th></th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $key => $file)
                @if ($file !== '.' && $file !== '..')
                        <tr>
                            <td class="text-center" style="width:5%;">{{$key - 1}}</td>
                            <td>{{$file}}</td>
                            <td class="text-center" style="width:5%;">
                                <button class="btn border-0">
                                    <a href="{{ route('dts.downloadFile', ['filename' => $file]) }}" class="fa-solid fa-download"></a>
                                </button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $('.overlay').hide();
    // ----------------------------------------------------------TABLE ITEM----------------------------------------------------------
    $('#dts-list').dataTable({
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

    var tDtsList = $('#dts-list').DataTable();
    if (tDtsList.rows()[0].length > 10) {
        $('#dts-list_paginate').attr('style', 'display: block !important');
    } else {
        $('#dts-list_paginate').attr('style', 'display: none !important');
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
</script>