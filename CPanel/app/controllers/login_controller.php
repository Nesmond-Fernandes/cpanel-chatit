<?php
# IF USER LOGGEDIN GOTO -> Dashboard
is_LoggedIn();

# USER MODELS
require './app/models/Admin.php';

$usernameErr = $passwordErr = "";

# CHECK IF USER SUBMITTED THE FORM 
if (isset($_POST['submit'])) {
    $username = $password = "";
    $username = filter_data($_POST["username"]);
    $password = filter_data($_POST["password"]);

    # VALIDATE  USERNAME
    if (empty($username)) {
        $usernameErr = "Username required";
    } else {
        if (!preg_match("/^[A-z][A-z0-9\.]{2,}$/", $username)) {
            // $usernameErr = "Only letters,numeric, period and underscores are allowed.";
            $usernameErr = "invalid username";
            $username = "";
        }
    }

    # VALIDATE PASSWORD
    if (empty($password)) {
        $passwordErr = "Password required";
    } else {
        if (strlen($password) >= 8 && strlen($password) <= 16) {
            $passwordErr = "";
        } else {
            $passwordErr = "password length should be 8-16";
            $password = "";
        }
    }

    # IF FIELDS ARE VALID & NOT EMPTY
    if (!empty($username)  && !empty($password)) {
        try {
            $admin = getAdminUser($username); // CHECK IF ADMIN EXISTS 

            // IF ADMIN EMPTY OR NOT 
            if (isset($admin) && $admin) {
                // USER  FOUNND 

                // GET PASSWORD HASH FROM  FETCHED USER DATA
                $adminPassword = $admin["password"];

                // VERIFY PASSWORD WITH USER ENTERED PASSWORD
                if (password_verify($password, $adminPassword)) {
                    // LOGIN SUCCESSFUL 

                    // UPDATE USER LOGIN TIME
                    updateLog($admin['id']);

                    // SET USER SESSION
                    $_SESSION["admin"]["name"] = $admin['firstname'] . ' ' . $admin['lastname'];
                    $_SESSION["admin"]['isAdminLoggedIn'] = true;
                    $_SESSION["admin"]['username'] = $admin['username'];

                    // GOTO DASHBOARD
                    header("Location: ./dashboard");
                } else {
                    // LOGIN FAILED

                    // Display error alert
                    show_alertError("Incorrect password. Please try again.");
                }
            } else {
                // USER NOT FOUND 

                // Display error alert
                show_alertError("User does not exists. Enter a valid username");
            }
        } catch (Exception $e) {
            show_alertError($e->getMessage());
        }
    } 
}

// LOGIN VIEW
require './app/views/login.php';
