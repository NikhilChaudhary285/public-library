<?php

// Connecting to the Database
include 'user/partials/_dbconnect.php';

// Sql query to be executed for fetching data of designers and it will be used or displayed further
$sql = "SELECT * FROM `designers`";
$result = mysqli_query($conn, $sql);
$sno = 0;
$name = 'designer';
while($row = mysqli_fetch_assoc($result)){
    $sno = $sno + 1;
    ${$name . $sno} = $row['designername'];
}                     
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Public Library</title>    
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/library.css">

</head>

<body class="home_body">

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/publiclibrary">Public <img src="/publiclibrary/images/public_library.jpg" class = "rounded-circle" height = "23px" width = "23px" alt="library image"> Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/publiclibrary">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/publiclibrary/library's/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/publiclibrary/library's/contact-us.php">Contact Us</a>
                    </li>                  
                </ul>
                <div class="d-flex mx-2">                
                    <a class="nav-link" href="/publiclibrary/user/welcome.php">
                        <button class="btn btn-success">View Books</button>
                    </a>
                    <a class="nav-link" href="/publiclibrary/editor/login.php">
                        <button class="btn btn-outline-success mx-2">Editor Login</button>
                    </a>
                    <a class="nav-link" href="/publiclibrary/admin/login.php">
                        <button class="btn btn-outline-success">Admin Login</button>
                    </a>
                </div> 
            </div>
        </div>
    </nav>
         
    <!-- Website Content -->
    <div class="container-fluid">
        <div class="welcome_image text-center intro">
            <!-- image url in css -->
        </div>

        <div class="welcome_key_image key_intro">
        <!-- image url in css -->
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid d-flex justify-content-between text-light bg-dark welcome-footer">
        <h5 class="fs-17 pt-1 mb-0 fw-light">Designed By <?php echo $designer1; ?> & <?php echo $designer2; ?></h5>
        <p class="mb-0">
            <img src="/publiclibrary/images/public_library.jpg" class = "rounded-circle" height = "35px" width = "33px" alt="library image">&nbsp;&nbsp;Public Library&nbsp;&nbsp;<span class="fs-18">|</span>&nbsp;&nbsp;<small>Copyright &copy; 2023</small>
        </p>
        <div class="d-flex pt-1 mx-2">                
            <a class="mx-2" href="" target="_blank">
                <img src="/publiclibrary/images/facebook.jpg" class = "rounded-circle" height = "24px" width = "24px" alt="facebook image">
            </a>
            <a class="" href="" target="_blank">
                <img src="/publiclibrary/images/instagram.jpg" class = "rounded-circle" height = "24px" width = "25px" alt="instagram image">
            </a>
        </div> 
    </div>

    <script src="js/jquery-3.6.3.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>