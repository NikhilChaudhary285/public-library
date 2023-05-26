<?php

// we have to call sessoion_start() method first for many reasons
session_start();

// Connecting to the Database
include 'reset-partials/_dbconnect.php';

$showAlert = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Check email exists or not
        // Variables
        $emailid = $_POST["emailid"];

        // Sql query to be executed
        $sql = "Select * from `libraryadmins` where emailid='$emailid'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1){
            // session_start() method is called in above section
            $_SESSION['emailid'] = $emailid;
            header("location: change-password.php");
        }
        else{
            $showAlert = "We don't have a registered user with that email address.";
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Public Library</title>
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body class="reset_body">

    <!-- Header -->
    <?php include 'reset-partials/_header.php'; ?>

    <!-- Alert -->
    <?php
    if($showAlert){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong></strong> '.$showAlert.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    ?>

    <!-- Website Content -->
    <!-- reset_password_email -->
    <div class="reset_password">
        <div class="card reset_card mx-auto">
            <div class="d-flex g-0">
                <div class="w-50 d-none rounded-start d-md-block reset_email_image">
                    <!-- image url in css -->
                </div>
                <div class="w-50 p-4 mx-auto shadow-lg bg-white rounded">
                    <img src="../images/public_library.jpg" class="rounded-circle d-block mx-auto" height="44px"
                        width="44px" alt="library image">
                    <h5 class="text-center fs-4 fw-semibold text-dark-emphasis pt-2 mb-0">Public Library</h5>
                    <form action="/publiclibrary/admin/reset-password.php" method="post">
                        <hr class="text-muted mt-2 mb-1">
                        <h1 class="text-center fs-17 fw-semibold text-dark-emphasis">Reset Password</h1>
                        <div class="mt-3">
                            <label for="emailid" class="form-label fw-bold text-dark">Email</label>
                            <input type="email" class="form-control bg-dark-subtle" id="emailid" name="emailid"
                                aria-describedby="emailHelp" required>
                        </div>

                        <button type="submit" class="btn btn-dark col-12 mt-3 mb-2">Submit</button>
                    </form>
                    <div class="d-flex justify-content-between mt-4">
                        <span class="border-top border-b"></span>
                        <span class=""><a class="text-muted _anchor" href="/publiclibrary">PUBLIC&nbsp;&nbsp;<img src="/publiclibrary/images/public_library.jpg" class = "rounded-circle" height = "16px" width = "16px" alt="library image">&nbsp;&nbsp;LIBRARY</a></span>
                        <span class="border-top border-b"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'reset-partials/_footer.php'; ?>

    <script src="../js/jquery-3.6.3.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>