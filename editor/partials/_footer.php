<?php

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

<div class="container-fluid d-flex justify-content-between text-light bg-dark editor-footer">
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