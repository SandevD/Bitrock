<!-- Top navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <div class="container-fluid">
        <button class="btn navbtn" id="sidebarToggle"><span class="material-icons md-48">Menu</span> </button>
        <div class="btn-group p-1">
            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-person-lines-fill px-2 " style="color:#e78d02"></i>
                <span class="text-secondary">{{ auth()->user()->email }}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('welcome.index') }}" style="text-decoration:none;" class="">
                    <button class="dropdown-item text-secondary" style="cursor:pointer;" type="button">
                        Home
                    </button>
                </a>
                <a href="{{ route('changepassword') }}" style="text-decoration:none;" class="text-secondary">
                    <button class="dropdown-item text-secondary" style="cursor:pointer;" type="button">
                        Reset Password
                    </button>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" style="text-decoration:none;" onclick="logoutForm.submit()">
                    <button class="dropdown-item text-dark" type="button" style="cursor:pointer;">
                        Logout
                        <i class="bi bi-arrow-up-right-circle-fill text-dark"></i>
                    </button>
                </a>
                <form action="{{ route('logout') }}" id="logoutForm" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>