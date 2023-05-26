<?php

// Check user login or not
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

// Connecting to the Database
include 'partials/_dbconnect.php';

// Variable to store current editor username
$editor_username  = $_SESSION['username'];

// Sql query to be executed for fetching data of user and it will be used or displayed further
$sql = "Select * from `libraryeditors` where username='$editor_username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<?php

$updateAccountDetails  = false;
$updateAccountPassword = false;
$showError             = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset( $_POST['editAccountDetails'])){
        /*** Update Editor Account Details Record ***/
        // Variables to be inserted into the table       
        $username = $_POST["usernameEdit"];
        $emailid  = $_POST["emailidEdit"];

        // Sql query to be executed
        $sql = "UPDATE `libraryeditors` SET `username` = '$username', `emailid` = '$emailid' WHERE `libraryeditors`.`username` = '$editor_username'";
        $result = mysqli_query($conn, $sql);       

        // Update Editor Account Details to the libraryeditors table in library database
        if($result){
            $updateAccountDetails = true;
            // Set updated username to username session variable
            $_SESSION['username'] = $username;
            // Reinitialize editor username variable with updated username session variable
            $editor_username  = $_SESSION['username'];
            // Sql query to be executed for fetching data of user and it will be displayed further
            $sql = "Select * from `libraryeditors` where username='$editor_username'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        }
        else{
            echo "We could not update the account details successfully because of this error ---> ". mysqli_error($conn);
        }
    }
    else{
        /*** Update Editor Account Password ***/
        // Variables
        $current_password  = $_POST["current_password"];
        $new_password      = $_POST["new_password"];
        $confirm_password  = $_POST["confirm_password"];        

        // Some values are given by executing some lines of code which are present in above portion of code(Please see this code)
        if(password_verify($current_password, $row['password'])){
            if(($new_password == $confirm_password)){
                // Variable to be inserted into the table
                $hash = password_hash($new_password, PASSWORD_DEFAULT);
                // Sql query to be executed
                // $editor_username variable is initialized with $_SESSION['username'] or current editor username in above portion of code
                $sql = "UPDATE `libraryeditors` SET `password` = '$hash' WHERE `libraryeditors`.`username` = '$editor_username'";
                $result = mysqli_query($conn, $sql);
                // Update Editor Account Password to the libraryeditors table in library database
                if ($result){
                    $updateAccountPassword = true;
                }
            }
            else{
                $showError = "Passwords do not match";
            }
        }
        else{
            $showError = "Incorrect Current Password";
        }
    }

}
?>

<?php


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account - Public Library</title>
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body class="account_body">

    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Alerts -->
    <?php
    if($updateAccountDetails){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Your account details has been updated successfully!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>
    <?php
    if($updateAccountPassword){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Your account password has been updated successfully!
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
    <div class="account">
        <div class="account_container mx-auto shadow-lg bg-white rounded p-4">
            <img src="../images/public_library.jpg" class="rounded-circle d-block mx-auto" height="44px"
            width="44px" alt="library image">
            <div class="d-flex justify-content-between py-3">
                <span class="border-top border-account"></span>
                <span class="fs-4 fw-semibold text-dark-emphasis">Public Library</span>
                <span class="border-top border-account"></span>
            </div>
            <div class="d-none d-sm-block">
                <div class="d-flex justify-content-between px-4">
                    <ul class="list-unstyled mb-0">
                        <li><span class="fs-6 fw-semibold text-dark-emphasis">Username:</span></li>
                        <li><span class="fs-5 fw-semibold"><?php echo $row['username']; ?></span></li>
                    </ul>
                    <ul class="list-unstyled mb-0">
                        <li><span class="fs-6 fw-semibold text-dark-emphasis">Email Address:</span></li>
                        <li><span class="fs-5 fw-semibold"><?php echo $row['emailid']; ?></span></li>
                    </ul>
                    <ul class="list-unstyled mb-0">
                        <li><span class="fs-6 fw-semibold text-dark-emphasis">Account Created:</span></li>
                        <li><span class="fs-5 fw-semibold"><?php echo substr($row['datetime'], 0, 10); ?></span></li>
                    </ul>
                </div>
                <hr>
            </div>
            <div class="d-flex g-0">
                <div class="w-50 px-4 pt-1 pb-4 mx-auto">
                    <h4 class="mb-0"><span class="fs-5 fw-semibold text-dark-emphasis">Account Details</span></h4>
                    <form action="/publiclibrary/editor/account.php" method="post">
                        <input type="hidden" name="editAccountDetails" id="editAccountDetails" value="yes">

                        <div class="mt-3">
                            <label for="usernameEdit" class="form-label fw-bold text-dark">Username</label>
                            <input type="text" maxlength="20" class="form-control bg-dark-subtle" id="usernameEdit"
                            name="usernameEdit" value="<?php echo $row['username']; ?>" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mt-3">
                            <label for="emailidEdit" class="form-label fw-bold text-dark">Email Address</label>
                            <input type="email" maxlength="200" class="form-control bg-dark-subtle" id="emailidEdit"
                            name="emailidEdit" value="<?php echo $row['emailid']; ?>" aria-describedby="emailHelp" required>
                        </div>
                        
                        <button type="submit" class="btn btn-dark px-3 mt-4">Save Changes</button>
                    </form>
                </div>
                <div class="w-50 px-4 pt-1 pb-4 mx-auto">
                    <h4 class="mb-0"><span class="fs-5 fw-semibold text-dark-emphasis">Change Password</span></h4>
                    <form action="/publiclibrary/editor/account.php" method="post">
                        <input type="hidden" name="editAccountPassword" id="editAccountPassword" value="yes">
                        
                        <div class="mt-3">
                            <label for="current_password" class="form-label fw-bold text-dark">Current Password</label>
                            <input type="password" maxlength="200" class="form-control bg-dark-subtle" id="current_password"
                            name="current_password" aria-describedby="emailHelp" required>
                        </div>
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
                        
                        <button type="submit" class="btn btn-dark px-3 mt-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'partials/_footer.php'; ?>

    <script src="../js/jquery-3.6.3.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>