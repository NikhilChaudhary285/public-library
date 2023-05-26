<?php
session_start();

session_unset();
session_destroy();

header("location: login.php");
exit;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logout</title>
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body>

    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Website Content -->
    <h1>Logout Page</h1>

    <!-- Footer -->
    <?php include 'partials/_footer.php'; ?>
    
    <script src="../js/jquery-3.6.3.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>