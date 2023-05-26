<?php

// Check user login or not
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

?>

<?php

$insert = false;
$update = false;
$borrower_profile_update = false;
$delete = false;
$issued = false;
$return = false;

// Connecting to the Database
include 'partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset( $_POST['snoEdit'])){
        /*** Update the record ***/
        // Variables to be inserted into the table
        $sno      = $_POST["snoEdit"];        
        $name     = $_POST["nameEdit"];
        $author   = $_POST["authorEdit"];
        $type     = $_POST["typeEdit"];
        $borrower = $_POST["borrowerEdit"];
       
        // Edit_table_logic
        if($_POST['editTable'] == "issuedbooks"){
            $table = "issuedbooks";
        }
        else{
            $table = "availablebooks";
        }

        // Sql query to be executed
        $sql = "UPDATE `$table` SET `name` = '$name', `author` = '$author', `type` = '$type', `borrower` = '$borrower' WHERE `$table`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);       
    
        // Update book to the availablebooks or issuedbooks table in library database
        if($result){
            $update = true;
        }
        else{
            echo "We could not update the book successfully because of this error ---> ". mysqli_error($conn);
        }
    }
    elseif(isset( $_POST['borrowerid'])){
        /*** Update the Borrower Profile ***/
        // Variables to be inserted into the table
        $sno              = $_POST["borrowerid"];        
        $bor_edit_name    = $_POST["bor_edit_name"];
        $bor_edit_email   = $_POST["bor_edit_email"];
        $bor_edit_phone   = $_POST["bor_edit_phone"];
        $bor_edit_address = $_POST["bor_edit_address"];

        // Sql query to be executed
        $sql = "UPDATE `issuedbooks` SET `borrower` = '$bor_edit_name', `bor_email` = '$bor_edit_email', `bor_phone` = '$bor_edit_phone', `bor_address` = '$bor_edit_address' WHERE `issuedbooks`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);       
    
        // Update borrower_profile_details to the issuedbooks table in library database
        if($result){
            $borrower_profile_update = true;
        }
        else{
            echo "We could not update the borrower profile successfully because of this error ---> ". mysqli_error($conn);
        }
    }
    elseif(isset( $_POST['snoDelete'])){
        /*** Delete the record ***/
        $sno = $_POST['snoDelete'];

        // Delete_table_logic
        if($_POST['deleteTable'] == "issuedbooks"){
            $table = "issuedbooks";
        }
        else{
            $table = "availablebooks";
        }
        
        // Sql query to be executed
        $sql = "DELETE FROM `$table` WHERE `$table`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
       
        // Delete book to the availablebooks or issuedbooks table in library database
        if($result){
            $delete = true;
        }
        else{
            echo "We could not delete the book successfully because of this error ---> ". mysqli_error($conn);
        }
    }
    else{
        if(isset( $_POST['borrowid'])){
            /*** Create or Insert the record in `issuedbooks` table and Delete the record from `availablebooks` table ***/ 
            // Variables to be inserted into the table
            $sno      = $_POST['borrowid'];
            $name     = $_POST['bookborrow'];
            $author   = $_POST['authorname'];
            $type     = $_POST['type'];
            // Borrower Profile
            $borrower    = $_POST['borrower'];
            $bor_email   = $_POST['bor_email'];
            $bor_phone   = $_POST['bor_phone'];
            $bor_address = $_POST['bor_address'];

            // Sql query to be executed
            $sql = "INSERT INTO `issuedbooks` (`name`, `author`, `type`, `borrower`, `bor_email`, `bor_phone`, `bor_address`) VALUES ('$name', '$author', '$type', '$borrower', '$bor_email', '$bor_phone', '$bor_address')";
            $insertresult = mysqli_query($conn, $sql);
            $sql = "DELETE FROM `availablebooks` WHERE `availablebooks`.`sno` = $sno";
            $deleteresult = mysqli_query($conn, $sql);
            // Add a new borrow book to the issuedbooks table in library database
            if($insertresult && $deleteresult){
                $issued = true;
            }
            else{
                echo "The book was not issued successfully because of this error ---> ". mysqli_error($conn);
            }
            // Submit these to a database
        }
        elseif(isset( $_POST['returnid'])){
            /*** Create or Insert the record in `availablebooks` table and Delete the record from `issuedbooks` table ***/ 
            // Variables to be inserted into the table
            $sno         = $_POST['returnid'];
            $name        = $_POST['bookreturn'];
            $author      = $_POST['returnauthor'];
            $type        = $_POST['returntype'];            
            $borrower    = $_POST['returnborrower'];
            $anyborrower = $_POST['anyborrower'];

            // Sql query to be executed
            $sql = "INSERT INTO `availablebooks` (`name`, `author`, `type`, `borrower`) VALUES ('$name', '$author', '$type', '$anyborrower')";
            $insertresult = mysqli_query($conn, $sql);
            $sql = "DELETE FROM `issuedbooks` WHERE `issuedbooks`.`sno` = $sno";
            $deleteresult = mysqli_query($conn, $sql);
            // Add a new return book to the availablebooks table in library database
            if($insertresult && $deleteresult){
                $return = true;
            }
            else{
                echo "The book was not returned successfully because of this error ---> ". mysqli_error($conn);
            }
            // Submit these to a database
        }
        else{
            /*** Create the record ***/ 
            // Variables to be inserted into the table
            $name     = $_POST['bookname'];
            $author   = $_POST['author'];
            $type     = $_POST['booktype'];
            $borrower = $_POST['bookborrower'];
        
            // Sql query to be executed
            $sql = "INSERT INTO `availablebooks` (`name`, `author`, `type`, `borrower`) VALUES ('$name', '$author', '$type', '$borrower')";
            $result = mysqli_query($conn, $sql);
            
            // Add a new book to the availablebooks table in library database
            if($result){
                $insert = true;
            }
            else{
                echo "The book was not inserted successfully because of this error ---> ". mysqli_error($conn);
            }
            // Submit these to a database
        }
    }
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
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/library.css">

</head>

<body class="welcome_body">

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabwelcome="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit this Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/publiclibrary/admin/welcome.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <!-- Edit_table_logic -->
                        <input type="hidden" name="editTable" id="editTable">

                        <div class="mb-3">
                            <label for="nameEdit">Name</label>
                            <input type="text" class="form-control" id="nameEdit" name="nameEdit"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="authorEdit">Author</label>
                            <input type="text" class="form-control" id="authorEdit" name="authorEdit"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="typeEdit">Type</label>
                            <input type="text" class="form-control" id="typeEdit" name="typeEdit"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="borrowerEdit">Borrower</label>
                            <input type="text" class="form-control" id="borrowerEdit" name="borrowerEdit"
                                aria-describedby="emailHelp" required>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabwelcome="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete this Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/publiclibrary/admin/welcome.php" method="POST">
                    <div class="modal-body">
                        <h5>Are you sure you want to delete this book!</h5>
                        <input type="hidden" name="snoDelete" id="snoDelete">
                        <!-- Delete_table_logic -->
                        <input type="hidden" name="deleteTable" id="deleteTable">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">OK</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Borrow Modal -->
    <div class="modal fade" id="borrowModal" tabwelcome="-1" aria-labelledby="borrowModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="borrowModalLabel">Issue this Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/publiclibrary/admin/welcome.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="bookborrow">Book Name</label>
                            <input type="text" class="form-control" id="bookborrow" name="bookborrow" required>
                        </div>
                        <!-- Auhtor -->
                        <input type="hidden" id="authorname" name="authorname">
                        <!-- Type -->
                        <input type="hidden" id="type" name="type">
                        <!-- Borrow_table_logic -->
                        <input type="hidden" id="borrowid" name="borrowid">
                        <!-- Borrower Profile Enter Details -->
                        <div class="mb-3">
                            <label for="borrower">Borrower Name</label>
                            <input type="text" class="form-control" id="borrower" name="borrower"
                                placeholder="Book Borrower" required>
                        </div>
                        <div class="mb-3">
                            <label for="bor_email">Borrower Email</label>
                            <input type="email" maxlength="200" class="form-control" id="bor_email" name="bor_email"
                                placeholder="Email Address">
                        </div>
                        <div class="mb-3">
                            <label for="bor_phone">Borrower Phone</label>
                            <input type="text" maxlength="10" class="form-control" id="bor_phone" name="bor_phone"
                                placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="bor_address">Borrower Address</label>
                            <textarea maxlength="200" class="form-control" id="bor_address" name="bor_address" rows="1"
                                placeholder="Residential Address" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Borrow</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Borrower Profile Modal -->
    <div class="modal fade" id="borrowerModal" tabwelcome="-1" aria-labelledby="borrowerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bor_header">
                    <h1 class="modal-title fs-5" id="borrowerModalLabel"><img src='/publiclibrary/images/borrower_profile.jpg' class='rounded-circle' height='28px' width='29px' alt='profile image'> Borrower Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/publiclibrary/admin/welcome.php" method="POST">
                    <div class="modal-body">
                        <!-- Borrower_table_logic -->
                        <input type="hidden" id="borrowerid" name="borrowerid">
                        <!-- Borrower Profile and Update Content -->
                        <div class="row mb-3">
                            <label for="bor_edit_name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="bor_edit_name" name="bor_edit_name"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="bor_edit_email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" maxlength="200" class="form-control" id="bor_edit_email"
                                    name="bor_edit_email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="bor_edit_phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="10" class="form-control" id="bor_edit_phone"
                                    name="bor_edit_phone" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="bor_edit_address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea maxlength="200" class="form-control" id="bor_edit_address"
                                    name="bor_edit_address" rows="1" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="bor_issued_time" class="col-sm-5 w-35 col-form-label">Book Issued At</label>
                            <div class="col-sm-4 w-40">
                                <h6 class="fw-normal border rounded py-9 px-12 mb-0" id="issued_Time"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Return Modal -->
    <div class="modal fade" id="returnModal" tabwelcome="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="returnModalLabel">Return this Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/publiclibrary/admin/welcome.php" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="bookreturn" class="col-sm-2 col-form-label">Book</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="bookreturn" name="bookreturn" required>
                            </div>
                        </div>
                        <!-- Auhtor -->
                        <input type="hidden" id="returnauthor" name="returnauthor">
                        <!-- Type -->
                        <input type="hidden" id="returntype" name="returntype">
                        <!-- Borrower -->
                        <input type="hidden" id="returnborrower" name="returnborrower">
                        <!-- AnyBorrower -->
                        <input type="hidden" id="anyborrower" name="anyborrower" value="None">
                        <!-- Return_table_logic -->
                        <input type="hidden" id="returnid" name="returnid">
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Alerts -->
    <?php
    if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Your book has been inserted successfully!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>
    <?php
    if($update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Your book has been updated successfully!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>
    <?php
    if($borrower_profile_update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Borrower Profile has been updated successfully!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>
    <?php
    if($delete){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Your book has been deleted successfully!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>
    <?php
    if($issued){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Book has been issued to " . $borrower . " successfully!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>
    <?php
    if($return){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> Book has been returned by " . $borrower . " successfully!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>
    
    <!-- Website Content -->
    <div class="container add_book">
        <h1>Add a Book to library</h1>
        <hr>
        <form action="/publiclibrary/admin/welcome.php" method="POST">
            <div class="row mb-3">
                <label for="bookname" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="bookname" name="bookname" placeholder="Book Name" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="author" class="col-sm-2 col-form-label">Author</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="author" name="author" placeholder="Book Author" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="booktype" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="booktype" name="booktype" placeholder="Book Type" required>
                </div>
            </div>
            <input type="hidden" id="bookborrower" name="bookborrower" value="None">

            <button type="submit" class="btn btn-success">Add Book</button>
        </form>
    </div>

    <!-- Display the data from the database -->
    <div class="container rel-pos-content my-4">
        <table class="table" id="ab_Table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Type</th>
                    <th scope="col">Borrower</th>
                    <th scope="col">Actions</th>
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
                            <!-- Borrow_table_logic -->
                            <td><button class='edit btn btn-sm btn-primary' id=". $row['sno'] .">Edit</button> <button type='button' class='borrow btn btn-sm btn-primary' id=b". $row['sno'] .">Borrow</button> <button class='delete btn btn-sm btn-primary' id=d". $row['sno'] .">Delete</button></td>
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
    <div class="container rel-pos-content my-4">
        <table class="table" id="ib_Table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Type</th>
                    <th scope="col">Borrower</th>
                    <th scope="col" class='d-none'> bor_name </th>
                    <th scope="col" class='d-none'> bor_email </th>
                    <th scope="col" class='d-none'> bor_phone </th>
                    <th scope="col" class='d-none'>bor_address</th>
                    <th scope="col" class='d-none'> timestamp </th>
                    <th scope="col">Actions</th>
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
                            <td><button class='borrower btn btn-sm btn-primary' id=bp". $row['sno'] ."><img src='/publiclibrary/images/borrower_profile.jpg' class='rounded-circle' height='17px' width='17px' alt='profile image'> " . $row['borrower'] . "</button></td>
                            <td class='d-none'>" . $row['borrower']    . "</td>
                            <td class='d-none'>" . $row['bor_email']   . "</td>
                            <td class='d-none'>" . $row['bor_phone']   . "</td>
                            <td class='d-none'>" . $row['bor_address'] . "</td>
                            <td class='d-none'>" . $row['timestamp']   . "</td>
                            <!-- Edit_table_logic & Return_table_logic & Delete_table_logic -->
                            <td><button class='edit btn btn-sm btn-primary' id=i". $row['sno'] .">Edit</button> <button type='button' class='return btn btn-sm btn-primary' id=r". $row['sno'] .">Return</button> <button class='delete btn btn-sm btn-primary' id=id". $row['sno'] .">Delete</button></td>
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
    <script src="../js/event-modal.js"></script>
</body>

</html>