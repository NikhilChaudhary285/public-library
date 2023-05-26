<?php

// Check user login or not
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

?>

<?php

// Connecting to the Database
include 'partials/_dbconnect.php';
?>

<?php

$showAlert     = false;
$usernameexist = false;
$showError     = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username  = $_POST["username"];
    $emailid   = $_POST["emailid"];
    $password  = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Check whether this username exists or not
    $existSql = "SELECT * FROM `libraryeditors` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistUser = mysqli_num_rows($result);
    // Check whether this emailid exists or not
    $existSql = "SELECT * FROM `libraryeditors` WHERE emailid = '$emailid'";
    $result = mysqli_query($conn, $existSql);
    $numExistemailid = mysqli_num_rows($result);
    
    if($numExistUser > 0){
        // $exists = true;
        $usernameexist = "This username already exists! Please try a different username.";
    }
    elseif($numExistemailid > 0){
        // $exists = true;
        $showError = "Invalid Email Address";
    }
    else{
        // $exists = false;
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
            $sql = "INSERT INTO `libraryeditors` (`username`, `emailid`, `password`, `datetime`) VALUES ('$username', '$emailid', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Editor- Public Library</title>
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body class="signup_body">

    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Alerts -->
    <?php
    if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Editor account have been signed up succesfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    if($usernameexist){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong></strong> '.$usernameexist.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    ?>

    <!-- Website Content -->
    <div class="signup">
        <div class="card signup_card mx-auto">
            <div class="d-flex g-0">
                <div class="w-50 d-none rounded-start d-md-block signup_image">
                    <!-- image url in css -->
                </div>
                <div class="w-50 p-4 mx-auto shadow-lg bg-white rounded">
                    <img src="../images/public_library.jpg" class="rounded-circle d-block mx-auto" height="44px"
                        width="44px" alt="library image">
                    <h5 class="text-center fs-4 fw-semibold text-dark-emphasis pt-2 mb-0">Public Library</h5>
                    <div class="text-center my-2">
                        <span class="border py-1 px-2 fw-normal">Signup Editor</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="border-top border-t"></span>
                        <span class="text-muted">Signup To Public Library</span>
                        <span class="border-top border-t"></span>
                    </div>
                    <form action="/publiclibrary/admin/signup-editor.php" method="post">
                        <div class="mt-12">
                            <label for="username" class="form-label fw-bold text-dark">Username</label>
                            <input type="text" maxlength="20" class="form-control bg-dark-subtle" id="username" name="username"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mt-12">
                            <label for="emailid" class="form-label fw-bold text-dark">Email Address</label>
                            <input type="email" maxlength="200" class="form-control bg-dark-subtle" id="emailid" name="emailid"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mt-12">
                            <label for="password" class="form-label fw-bold text-dark">Password</label>
                            <input type="password" minlength="8" maxlength="200" class="form-control bg-dark-subtle" id="password" name="password" required>
                        </div>
                        <div class="mt-12">
                            <label for="cpassword" class="form-label fw-bold text-dark">Confirm Password</label>
                            <input type="password" class="form-control bg-dark-subtle" id="cpassword" name="cpassword" required>
                        </div>

                        <button type="submit" class="btn btn-dark col-12 mt-36">Create an account</button>
                    </form>
                    <div class="d-flex justify-content-between mt-12">
                        <span class="border-top border-b"></span>
                        <span class=""><a class="text-muted _anchor" href="/publiclibrary">PUBLIC&nbsp;&nbsp;<img src="/publiclibrary/images/public_library.jpg" class = "rounded-circle" height = "16px" width = "16px" alt="library image">&nbsp;&nbsp;LIBRARY</a></span>
                        <span class="border-top border-b"></span>
                    </div>
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