<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper bg-primary d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
            <a class="navbar-brand brand-logo" href="/"><img src="{{ asset('admin/images/kooldoc-logo.svg') }}" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="/"><img src="{{ asset('admin/images/kooldoc-logo-mini.svg') }}" alt="logo"/></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant text-white"></span>
            </button>
        </div>  
    </div>
    <div class="navbar-menu-wrapper bg-primary d-flex align-items-center justify-content-end text-capitalize text-white">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <img id="dashboard_image" alt="profile"/>
                    <span id="dashboard_name" class="nav-profile-name"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/">
                        <i class="mdi mdi-home text-primary"></i>
                        HOME
                    </a>
                    <hr class="dropdown-divider">
                    <a id="link_profile" class="dropdown-item" href="/">
                        <i class="mdi mdi-baby-face-outline text-primary"></i>
                        PROFILE
                    </a>
                    <hr class="dropdown-divider">
                    <button id="logout_btn" class="dropdown-item">
                        <i class="mdi mdi-logout text-primary"></i>LOGOUT
                    </button> 
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center text-white" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>