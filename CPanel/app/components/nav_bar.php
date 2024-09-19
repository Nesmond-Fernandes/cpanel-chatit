<nav class="navbar navbar-dark bg-dark shadow-sm  d-block d-md-none">
    <div class="container-fluid">
        <a class="ps-2 text-warning text-decoration-none">
            <span class="fs-4 fw-bold">Chat !t <span class="lead">Panel</span></span>
        </a>
        <div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header ps-0">
                    <a class="ps-2 text-warning text-decoration-none">
                        <span class="fs-4 fw-bold">Chat !t <span class="lead">Panel</span></span>
                    </a>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <!-- list of navigations -->
                <div class="offcanvas-body p-0 d-flex flex-column">
                    <ul class="nav nav-pills flex-column mb-auto p-1 gap-1">
                        <li>
                            <a id="default-menu-tab-link " onclick="showMainContent(this,'dashboard-tab')"
                               data-bs-dismiss="offcanvas" class="menu-tab-link  btn w-100 nav-link text-white border-0 text-start">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a onclick="showMainContent(this,'manage-admin-tab')"
                               data-bs-dismiss="offcanvas" class="menu-tab-link  btn w-100 nav-link text-white border-0 text-start">
                                Manage Admin
                            </a>
                        </li>
                        <li>
                            <a onclick="showMainContent(this,'settings-tab')"
                               data-bs-dismiss="offcanvas" class="menu-tab-link  btn w-100 nav-link text-white border-0 text-start">
                                Settings
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class=" container-fluid p-2">
                        <button onclick="logout()" class="btn btn-outline-danger text-white w-100">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>