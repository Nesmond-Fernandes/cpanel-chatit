<div id="dashboard-tab" class="menu-tab-content container-fluid p-0 rounded h-100 ">
    <div class="position-relative d-flex flex-column overflow-hidden h-100">
        <!--  -->
        <div class=" container-fluid mb-2 d-flex justify-content-between align-items-center">
            <!-- Title -->
            <div class="">
                <h2 class="fw-bold fs-1 m-0">Dashboard</h2>
                <p class="m-0 d-none d-sm-block lh-1 fs-6 text-secondary">Manage all users of your application from this dashboard.</p>
            </div>
            <!-- admin user  -->
            <div class="  user-select-none">
                <div class="row flex-nowrap align-items-center text-end justify-content-center">
                    <!-- <div class="col "><img src="https://storage.sonusvos.com/v2/default/assets/default-pfp-2.jpg"  width="42" height="42" class="rounded-circle" alt="profile" ></div> -->
                    <div class="col">
                        <!-- <h5 class="m-0 p-0 lh-1 fs-5"><?php echo $_SESSION["admin"]["name"]; ?></h5> -->
                        <p class="m-0 lh-1 fs-6 text-secondary"><?php echo $_SESSION["admin"]['username'] ?></p>
                    </div>
                    <div class="col-auto d-block ps-0"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdl5Jx2gwkFZcmwesbDEda6Obht5McEd0Y_Q&s" width="42" height="42" class="rounded-circle" alt="profile"></div>
                </div>
            </div>
        </div>
        <!-- Search -->
        <div class=" container-fluid ">
            <nav class="navbar rounded ">
                <div class="container-fluid align-items-end justify-content-end justify-content-sm-start justify-content-md-start gap-1 p-0 user-select-none">
                    <div class="d-flex flex-wrap justify-content-center flex-md-row gap-1" role="search">
                        <input style="width: 17rem;" oninput="searchUser(this.value)" class="form-control me-2 shadow-none border-light-subtle" type="search" placeholder="Search by @username or email" aria-label="Search">
                        <!-- <button class="btn btn-outline-dark " type="submit">Search</button> -->
                    </div>
                    <!-- <h4 class="navbar-brand fw-bold m-0">Users <small class="text-secondary"><?php echo $_totalUsers['total_users']; ?></small></h4> -->
                    <div class="dropstart" id="sort-by-btn">
                        <div class="dropdown ">
                            <button class="btn btn-outline-dark text-nowrap" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort By
                            </button>
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item <?php if (htmlspecialchars($query_params['sort']) == 'asc') {
                                                                echo 'active';
                                                            } ?>" onclick="getUser()">Created at (asc)</a></li>
                                <li><a class="dropdown-item <?php if (htmlspecialchars($query_params['sort']) == 'desc') {
                                                                echo 'active';
                                                            } ?>" onclick="getUser(1,'desc')">Created at (desc)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div style="flex: 1 0 0;" class=" bg-body-tertiary overflow-y-scroll  m-2 m-md-0  overflow-x-hidden position-relative rounded h-75 p-0  d-flex flex-column">
            <div class="row m-0  justify-content-between py-1 pe-2 fs-6 fw-bold">
                <div class="col-1 d-none d-md-block col-md-1">#</div>
                <div class="col-11 col-md-4 ">Users</div>
                <div class="col-3 d-none d-md-block col-md-3">@Username</div>
                <div class="col-2 d-none d-md-block col-md-2">Last Active</div>
                <div class="col-2 d-none d-md-block col-md-2">Created At</div>
            </div>
            <div class="overflow-y-scroll m-2 m-md-0 w-100 overflow-x-hidden " id="user-table">
                <?php
                if (count($_users)>0) {
                    
                    foreach ($_users as $__user) {
                    echo '<div class="row m-0 py-1 pe-2  align-items-center py-2">
                <div class="col-1 d-none d-md-block col-md-1 fw-medium">' . $__user['sr_no'] . '</div>
                <div class="col-12 col-md-4">
                <div class="row m-0 justify-content-start gap-1 flex-nowrap">
                    <div class="p-0  col-1"><img  loading="lazy" src="https://randomuser.me/api/portraits/women/' . $__user['id'] . '.jpg"  class="float-end w-100 rounded-circle" alt="profile">
                    </div>
        
                    <div class="col-10  ">
                    <h6 class="m-0 fs-6  text-truncate">' . $__user['firstname'] . ' ' . $__user['lastname'] . '</h6>
                    <small class="d-block lh-sm text-primary fw-medium  text-truncate">' . $__user['email'] . '</small>
                    <!-- <small class="d-block lh-1 text-secondary">' . $__user['username'] . '</small> -->
                    </div>
                    </div>
                </div>
                <div class="col-3 d-none d-md-block col-md-3 ">' . $__user['username'] . '</div>
                <div class="col-2 d-none d-md-block col-md-2 fw-medium"><small>' . date_format(date_create($__user['last_logged_in']), 'D j, M Y') . '</small></div>
                <div class="col-2 d-none d-md-block col-md-2 fw-medium"><small>' . date_format(date_create($__user['created_at']), 'D j, M Y') . '</small></div>
            </div>';
                } 
                } else {
                    echo '<div class="position-absolute top-50 start-50 translate-middle container-fluid text-center text-secondary">Users not found</div>';
                }
                 
               ?>
            </div>
        </div>
        <!-- pages -->
        <div class="container-fluid py-2" id="pager">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center gap-1">
                    <!-- Previous Page Link -->
                    <li class="page-item <?php echo (htmlspecialchars($query_params['page']) <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link btn"
                            onclick="getUser('<?php echo (htmlspecialchars($query_params['page']) > 1) ?  htmlspecialchars($query_params['page']) - 1 : 1; ?>',
                                        '<?php echo htmlspecialchars($query_params['sort']); ?>')"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <!-- Dynamic Page Numbers -->
                    <?php
                    // Total pages
                    // $_totalpages = 10;
                    $current_page = htmlspecialchars(htmlspecialchars($query_params['page']));
                    // Determine the start and end page
                    $start = max(1, $current_page - 1);  // at least 1 #1
                    $end = min($_totalpages, $current_page + 1); // no more than total pages #2
                    if ($end - $start < 2) {
                        if ($start == 1) {
                            $end = min($start + 2, $_totalpages);  // if near the start, show more from the right
                        } else if ($end == $_totalpages) {
                            $start = max($end - 2, 1);  // if near the end, show more from the left
                        }
                    }
                    // Loop through the determined range of pages
                    for ($i = $start; $i <= $end; $i++) {
                        echo '<li class="page-item ' . (($current_page == $i) ? 'active' : '') . '">';
                        echo '<a class="page-link btn" onclick="getUser(' . $i . ', \'' . htmlspecialchars($query_params['sort']) . '\')">' . $i . '</a>';
                        echo '</li>';
                    }
                    ?>
                    <!-- Next Page Link -->
                    <li class="page-item <?php echo (htmlspecialchars($query_params['page']) >= $_totalpages) ? 'disabled' : ''; ?>">
                        <a class="page-link btn"
                            onclick="getUser('<?php echo (htmlspecialchars($query_params['page']) < $_totalpages) ?  htmlspecialchars($query_params['page']) + 1 : $_totalpages; ?>',
                                        '<?php echo htmlspecialchars($query_params['sort']); ?>')"
                            aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <!-- <p class="position-absolute top-50 start-50 translate-middle text-secondary">Dashboard</p> -->
</div>