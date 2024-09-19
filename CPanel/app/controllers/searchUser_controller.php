<?php
// MODEL & CONFIG 
include '../../config/config.php';
include '../models/Users.php';

# FILTER DATA FOR GET PARAMS
function filter_Data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

# CHECK FOR QUERY
try {
    if ($_GET['query']!="") {
        
        $query = filter_Data($_GET['query']);
        $regexUsername = '/^\@[A-Za-z0-9\.]+$/i';

        // check if query search type [username] or [email]
        if (preg_match($regexUsername, $query)) {
            //  Type @username
            $username = preg_replace('/\@/','',$query);
           $res =  searchUsersBY_username($username);
           viewTable($res);
        } else {
            // Type email
            // Validate email
            $email = filter_var($query, FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_SANITIZE_EMAIL)) {
                // Valid email 
                $res =  searchUsersBY_email($email);
                viewTable($res);
         
            } else {
                // invalid email
            }
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

#RETURN A TABLE TEMPLATE COLUMN OF ALL USERS
function viewTable(array $users)
{
    // Check if user data is more than 0 or not  
    if (count($users)>0) {
        foreach ($users as $__user) {
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
    

}
