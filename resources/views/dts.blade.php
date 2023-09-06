@include('welcome')
<div class="main" id="main-content">
    <div class="p-3">
        <div class="d-flex align-items-center w-100 mb-3">
            <span class="me-2">
                Group Material
            </span>
            <select id="" class="form-select">
                <option value="" hidden selected>Select Group</option>
                <option value="">INJECTION</option>
            </select>
        </div>
        <div class="d-flex justify-content-between align-items-center p-2 w-100 bg-header-menu rounded-top">
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
        <table id="surat-jalan-item" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" style="width:5%;">1</td>
                    <td>Lampiran 1.jpg</td>
                    <td style="width:5%;">
                        <button class="btn border-0">
                            <i class="fa-solid fa-download"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" style="width:5%;">2</td>
                    <td>PCL.rar</td>
                    <td style="width:5%;">
                        <button class="btn border-0">
                            <i class="fa-solid fa-download"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" style="width:5%;">3</td>
                    <td>ErrorWEB.xlsx</td>
                    <td style="width:5%;">
                        <button class="btn border-0">
                            <i class="fa-solid fa-download"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>