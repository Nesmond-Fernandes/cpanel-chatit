<?php
// if not logged in goto login
is_Not_LoggedIn();

$query_params = [];

// GET THE PARAMS AND INITIALIZE TO A VARIABLE
$page_params = get_params('page', 1);
$sort_params = get_params('sort', 'asc');

// SANTIZE THE DATA & ASSIGN 
$query_params['page'] = check_sanitize_Data($page_params == 0 ? 1 : $page_params, 1, FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
$query_params['sort'] = filter_Data($sort_params);

// MAKE SURE THE SORT HAS ONLY ONE OF THE TWO VALUE
if ($query_params['sort'] != 'asc' && $query_params['sort'] != 'desc') {
    $query_params['sort'] = 'asc';
}

// USER MODELS
require './app/models/Users.php';

try {

    // FETCH ALL THE USERS
    $_users = getAllUsers($query_params['page'], $query_params['sort']);

    // GET TOTAL USERS 
    $_totalUsers = getTotalUsers();

    // CALCULATE THE TOTAL NUMBER OF PAGES TO BE CREATED
    $_totalpages = ceil($_totalUsers['total_users'] / 10);

    // DASHBOARD VIEW
    require './app/views/dashboard/dashboard.php';
    $conn = null;
} catch (Exception $e) {
    http_response_code(500);
    // show_alertError($e->getMessage());
    // header()
    require './app/views/error.php';
}
