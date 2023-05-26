<?php

// Connecting to the Database
include 'partials/_dbconnect.php';                   
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact - Public Library</title>
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body class="contact_body">

    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Website Content -->
    <div class="container px-4 contact_intro">
        <img src="../images/public_library.jpg" class="rounded-circle d-block mx-auto" height="44px"
            width="44px" alt="library image">
        <div class="text-center">
            <h1 class="mb-0"><span class="fs-4 fw-semibold text-dark-emphasis">Public Library</span></h1>
        </div>
        <div class="d-flex justify-content-between pt-3 pb-2 mb-4">
            <span class="border-top border-w"></span>
            <span class="fs-4 fw-semibold">Library Inquiry Members</span>
            <span class="border-top border-w"></span>
        </div>
        <div class="row">
            <?php
                // Sql query to be executed for fetching data of librarians and it will be used or displaying further
                $sql = "SELECT * FROM `libraryinquirymembers`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while($row = mysqli_fetch_assoc($result)){                       
                echo'
                    <div class="col-lg-4 my-2">
                        <div class="card shadow-lg" style="width: 19rem;">
                            <img src="' . $row['librarianimage'] . '" class="card-img-top" alt="librarian image">
                            
                            <ul class="list-group bg-gray list-group-flush">
                                <li class="list-group-item"><img src="/publiclibrary/images/name.jpg"
                            class="rounded-circle" height="19px" width="19px" alt="name image"> ' . $row['librarianname'] . '</li>
                                <li class="list-group-item"><img src="/publiclibrary/images/phone.png"
                            class="rounded-circle" height="19px" width="19px" alt="phone image"> ' . $row['librarianphone'] . '</li>
                                <li class="list-group-item"><img src="/publiclibrary/images/email.jpg"
                            class="rounded-circle" height="19px" width="19px" alt="email image"> ' . $row['librarianemail'] . '</li>
                                <li class="list-group-item"><img src="/publiclibrary/images/clock.jpg"
                            class="rounded-circle" height="19px" width="19px" alt="clock image"> ' . $row['librarianworkinghours'] . '</li>
                            </ul>
                        </div>
                    </div>';                          
                }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'partials/_footer.php'; ?>

    <script src="../js/jquery-3.6.3.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>