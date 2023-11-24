<header class="header" id="header">
    <div class="container-fluid text-white bg-header">
        <div class="d-flex justify-content-between align-items-center p-1">
            <div class="d-flex justify-content-center align-items-center">
                <h6 class="m-0">TBP - VENDOR PORTAL</h6>
                <span class="px-3">|</span>
                <h6 class="m-0">{{session('supplier')->NAMA ? session('supplier')->NAMA : ''}}</h6>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <i class="fa-solid fa-user"></i>
                <h6 class="mb-0 mx-3">{{session('user')->EMAIL ? session('user')->EMAIL : 'User'}}</h6>
                <span class="mb-0 me-3">
                    {{session('user')->LAST_LOGIN_AT}}
                </span>
                <a href="{{route('login.changePassword')}}" class="text-white">
                    <i class="fa-solid fa-lock"></i>
                </a>
                <button class="btn text-white p-0" id="logoutButton">
                    <i class="fa-solid fa-power-off mx-3"></i>
                </button>
            </div>
        </div>
    </div>
</header>