<?php

// Connecting to the Database
include 'partials/_dbconnect.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About - Public Library</title>
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body class="about_body">

    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Website Content -->
    <div class="w-50 p-4 mx-auto shadow-lg bg-white rounded about_intro">
        <img src="../images/public_library.jpg" class="rounded-circle d-block mx-auto" height="44px"
            width="44px" alt="library image">
        <div class="d-flex justify-content-between pt-4 pb-2">
            <span class="border-top border-w"></span>
            <span class="fs-4 fw-semibold text-dark-emphasis">Public Library</span>
            <span class="border-top border-w"></span>
        </div>
        <p><span class="fs-1 fw-semibold text-dark-emphasis">Public Library</span> has been founded recently and is accessible by the general public and is usually funded from public sources, such as taxes. It is operated by librarians and library professionals, who are also civil servants.</p>
        <p>Its motive to provide knowledgeable books to people and help people to findout books such as Literacy Books, Historical Books, Technical Books, Action and Adventure, Fantasy, Comic Books or Graphic Novels, Biographies, Poetry Books, and many more.</p>
        <div class="d-flex justify-content-between">
            <span class="border-top border-w"></span>
            <a class="contact_anchor" href="/publiclibrary/library's/contact-us.php"><span class="fs-4 fw-semibold text-dark-emphasis">Contact Us</span></a>
            <span class="border-top border-w"></span>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'partials/_footer.php'; ?>

    <script src="../js/jquery-3.6.3.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>