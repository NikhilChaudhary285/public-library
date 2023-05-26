<?php 
    
// Connecting to the Database
include 'partials/_dbconnect.php';

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Public Library</title>
    <!-- Title Bar Icon -->
    <link rel="icon" href="/publiclibrary/images/public_library_icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body class="welcome_body">
 
    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- user intro image -->
    <div class="welcome_user_image user_intro d-none d-sm-block">
        <!-- image url in css -->
    </div>
    
            <!-- Website Content -->
    <!-- Display the data from the database -->
    <div class="container user-rel-pos-content my-4">
        <table class="table" id="ab_Table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Type</th>
                    <th scope="col">Borrower</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    /*** Read the record ***/
                    $sql = "SELECT * FROM `availablebooks`";
                    $result = mysqli_query($conn, $sql);
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                    $sno = $sno + 1;
                    echo "<tr>
                            <th scope='row'>" . $sno . "</th>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['author'] . "</td>
                            <td>" . $row['type'] . "</td>
                            <td>" . $row['borrower'] . "</td>
                          </tr>";                          
                    }
                ?>
            </tbody>
            <div class="my-4">
                <button type="button" class="btn btn-primary">Available Books <img src="/publiclibrary/images/books.png"
                        class="rounded-circle" height="28px" width="23px" alt="books image">
                    <?php echo $sno ?>
                </button>
            </div>

        </table>
    </div>

    <!-- Display the data from the database -->
    <div class="container user-rel-pos-content my-4">
        <table class="table" id="ib_Table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Type</th>
                    <th scope="col">Borrower</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    /*** Read the record ***/
                    $sql = "SELECT * FROM `issuedbooks`";
                    $result = mysqli_query($conn, $sql);
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                    $sno = $sno + 1;
                    echo "<tr>
                            <th scope='row'>" . $sno . "</th>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['author'] . "</td>
                            <td>" . $row['type'] . "</td>
                            <td>" . $row['borrower'] . "</td>                            
                          </tr>";
                    }
                ?>
            </tbody>
            <div class="my-4">
                <button type="button" class="btn btn-primary">Issued Books <img src="/publiclibrary/images/books.png"
                        class="rounded-circle" height="28px" width="23px" alt="books image">
                    <?php echo $sno ?>
                </button>
            </div>

        </table>
    </div>
    
    <!-- Footer -->
    <?php include 'partials/_footer.php'; ?>

    <script src="../js/jquery-3.6.3.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.js"></script>
</body>

</html>    