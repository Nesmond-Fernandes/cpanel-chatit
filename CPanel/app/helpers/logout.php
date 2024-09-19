<?php
session_start();
if (isset($_SESSION["admin"]["isAdminLoggedIn"]) && $_SESSION["admin"]["isAdminLoggedIn"] == true) {
    unset($_SESSION["admin"]);
} 

?>