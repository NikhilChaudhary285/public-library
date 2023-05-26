<?php

// Connecting to the Database
include 'partials/_dbconnect.php';
?>

<?php 

$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "Select * from `libraryadmins` where username='$username' OR emailid='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['role']     = "admin";
                header("location: welcome.php");
            }
            else{
                $showError = "Invalid Credentials";
            }
        }
    }
    else{
        $showError = "Invalid Credentials";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Public Library</title>
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body class="login_body">

    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Alerts -->
    <?php
    if($login){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You have been logged in succesfully!
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
    <div class="login">
        <div class="card login_card mx-auto">
            <div class="d-flex g-0">
                <div class="w-50 d-none rounded-start d-md-block login_image">
                    <!-- image url in css -->
                </div>
                <div class="w-50 p-4 mx-auto shadow-lg bg-white rounded">
                    <img src="../images/public_library.jpg" class="rounded-circle d-block mx-auto" height="44px"
                        width="44px" alt="library image">
                    <h5 class="text-center fs-4 fw-semibold text-dark-emphasis pt-2 mb-0">Public Library</h5>
                    <p class="card-text text-center mb-0">Welcome Back!</p>
                    <div class="text-center my-2">
                        <span class="border py-1 px-2 fw-normal">Admin Login</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="border-top border-t"></span>
                        <span class="text-muted">Login To Public Library</span>
                        <span class="border-top border-t"></span>
                    </div>
                    <form action="/publiclibrary/admin/login.php" method="post">
                        <div class="mt-4">
                            <label for="username" class="form-label fw-bold text-dark">Username or Email</label>
                            <input type="text" class="form-control bg-dark-subtle" id="username" name="username"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label fw-bold text-dark">Password</label>
                                <span class=""><a class="text-muted fs-14 forgot_password" href="/publiclibrary/admin/reset-password.php">Forgot Password?</a></span>
                            </div>
                            <input type="password" class="form-control bg-dark-subtle" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-dark col-12 mt-46">Login</button>
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
    <?php include 'partials/_footer.php'; ?>

    <script src="../js/jquery-3.6.3.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>