<div class=" d-none d-md-block col-3 col-sm-3 col-md-3 col-lg-3  p-0">
  <div class="d-flex flex-column flex-shrink-0 p-3 h-100 text-bg-dark user-select-none ">
    <a  class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-warning text-decoration-none">
      <span class="fs-4 fw-bold">Chat !t <span class="lead">Panel</span></span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto gap-1">
      <li>
        <a  id="default-menu-tab-link" onclick="showMainContent(this,'dashboard-tab')"
          class="menu-tab-link btn w-100 nav-link text-white border-0 text-start">
          Dashboard
        </a>
      </li>
      <li>
        <a  onclick="showMainContent(this,'manage-admin-tab')"
          class="menu-tab-link btn w-100 nav-link text-white border-0 text-start">
          Manage Admin
        </a>
      </li>
      <li>
        <a  onclick="showMainContent(this,'settings-tab')"
          class="menu-tab-link btn w-100 nav-link text-white border-0 text-start">
          Settings
        </a>
      </li>
    </ul>
    <hr>
    <div class=" container-fluid p-0">
      <button onclick="logout()" class="btn btn-outline-danger text-white w-100">
        Logout
      </button>
    </div>
  </div>
</div>