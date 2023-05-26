<?php

// we have to call sessoion_start() method first for many reasons
session_start();

// Check email is set or not 
if(!isset( $_SESSION['emailid'])){
    header("location: reset-password.php");
    exit;
}

// Connecting to the Database
include 'reset-partials/_dbconnect.php';

$resetAccountPassword = false;
$showError            = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        /*** Update/Reset Editor Account Password ***/
        // Variables
        // session_start() method is called in above section and this below session variable is set from reset-password page of website
        $emailid          = $_SESSION['emailid']; 
        $new_password     = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];        
    
        if(($new_password == $confirm_password)){
            // Variable to be inserted into the table
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            // Sql query to be executed
            $sql = "UPDATE `libraryeditors` SET `password` = '$hash' WHERE `libraryeditors`.`emailid` = '$emailid'";
            $result = mysqli_query($conn, $sql);
            // Update/Reset Editor Account Password to the libraryeditors table in library database
            if ($result){
                $resetAccountPassword = true;
                unset($_SESSION['emailid']);
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password - Public Library</title>
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body class="reset_body">

    <!-- Header -->
    <?php include 'reset-partials/_header.php'; ?>

    <!-- Alerts -->
    <?php
    if($resetAccountPassword && $loggedin){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Success!</strong> Your account password has been reset successfully!
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    }
    elseif($resetAccountPassword){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Success!</strong> Your account password has been reset successfully! Please login to start your journey on Public Library.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    }
    if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> '.$showError.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    ?>

    <!-- Website Content -->
    <!-- reset_account_password -->
    <div class="reset_password">
        <div class="card reset_card mx-auto">
            <div class="d-flex g-0">
                <div class="w-50 d-none rounded-start d-md-block reset_password_image">
                    <!-- image url in css -->
                </div>
                <div class="w-50 p-4 mx-auto shadow-lg bg-white rounded">
                    <img src="../images/public_library.jpg" class="rounded-circle d-block mx-auto" height="44px"
                        width="44px" alt="library image">
                    <h5 class="text-center fs-26 fw-semibold text-dark-emphasis pt-2 mb-0">Public Library</h5>
                    <form action="/publiclibrary/editor/change-password.php" method="post">
                        <hr class="text-muted mt-2 mb-1">
                        <h1 class="text-center fs-17 fw-semibold text-dark-emphasis">Change Password</h1>
                        <div class="mt-3">
                            <label for="new_password" class="form-label fw-bold text-dark">New Password</label>
                            <input type="password" maxlength="200" class="form-control bg-dark-subtle" id="new_password"
                            name="new_password" minlength="8" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mt-3">
                            <label for="confirm_password" class="form-label fw-bold text-dark">Confirm Password</label>
                            <input  type="password" class="form-control bg-dark-subtle" id="confirm_password"
                            name="confirm_password" aria-describedby="emailHelp" required>
                        </div>

                        <button type="submit" class="btn btn-dark col-12 mt-4 mb-2">Save Changes</button>
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