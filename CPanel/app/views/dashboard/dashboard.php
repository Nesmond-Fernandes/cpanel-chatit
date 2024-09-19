<?php

// var_dump($_SESSION);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat Admin Panel| Dashboard</title>
    <link rel="stylesheet" href="public/css/style.css">
    <script defer src="public/js/dashboard.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="vh-100">
    <div class="container-fluid d-flex flex-column bg-body-secondary h-100 p-0">
        <?php require "./app/components/nav_bar.php"; ?>
        <!-- Content -->
        <div class="container-fluid p-0 h-100 ">

            <!-- Large screen view -->
            <div class="row m-0 h-100">
                <!-- side menu tab bar -->
                <?php include('components/side_tab.php'); ?>


                <!--main content -->
                <div class="vh-100 p-2 col-12 col-sm-12 col-md-9 col-lg-9 bg-white  ">
                    <!-- Dashboard -->
                    <?php require 'tabs/dashboard_tab.php' ?>
                    <!-- Manage admin -->
                    <div id="manage-admin-tab" class="menu-tab-content h-100 bg-dark position-relative rounded">
                        <p class="position-absolute top-50 start-50 translate-middle text-secondary">Manage Admin</p>
                    </div>
                    <!-- Settings -->
                    <div id="settings-tab" class="menu-tab-content h-100 bg-dark position-relative rounded">
                        <p class="position-absolute top-50 start-50 translate-middle text-secondary">Settings</dpiv>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>