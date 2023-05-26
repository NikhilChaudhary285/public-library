<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $loggedin= true;
  }
  else{
    $loggedin = false;
  }

echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid fixed-top">
        <div class="container-fluid">';
            if(!$loggedin){
            echo '<a class="navbar-brand" href="/publiclibrary">Public <img src="/publiclibrary/images/public_library.jpg" class = "rounded-circle" height = "23px" width = "23px" alt="library image"> Library</a>';
            }
            if($loggedin){
            echo '<a class="navbar-brand" href="/publiclibrary/admin/welcome.php">Public <img src="/publiclibrary/images/public_library.jpg" class = "rounded-circle" height = "23px" width = "23px" alt="library image"> Library</a>';               
            }
      echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">';
                    if(!$loggedin){
              echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/publiclibrary">Home</a>
                    </li>';
                    }
                    if($loggedin){
              echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/publiclibrary/admin/welcome.php">Home</a>
                    </li>';               
                    }
              echo '<li class="nav-item">
                        <a class="nav-link" href="/publiclibrary/library\'s/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/publiclibrary/library\'s/contact-us.php">Contact Us</a>
                    </li>                  
                </ul>

                <div class="d-flex mx-2">';
                if(!$loggedin){            
              echo '<a class="nav-link" href="/publiclibrary/editor/login.php">
                        <button class="btn btn-outline-success">Editor Login</button>
                    </a>';
                }
                if($loggedin){
              echo '<a class="nav-link" href="/publiclibrary/admin/signup-editor.php">
                        <button class="btn btn-success">Signup Editor</button>
                    </a>
                    <a class="nav-link" href="/publiclibrary/admin/account.php">
                        <button class="btn btn-success mx-2"><img src="/publiclibrary/images/admin_profile.jpg" class="rounded-circle" height="19px" width="19px" alt="profile image"> '. $_SESSION['username'] .'</button>
                    </a>
                    <a class="nav-link" href="/publiclibrary/admin/logout.php">
                        <button class="btn btn-outline-success">Logout</button>
                    </a>';
                }                
          echo '</div>

            </div>
        </div>
    </nav>
';

?>