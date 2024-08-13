<?php
  // Start a session for all pages to allow access to ALL variables stored within the $_SESSION superglobal
  session_start();
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Bootstrap 5 Icon CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

  <!-- Project Style Sheet -->
  <link rel="stylesheet" href="styles.css">

  <title>bbqReview</title>
</head>
<body>

<header class="site-nav mb-5">
  <div class="container">
    <div id="site-logo" class="text-center">
      <img src="./site-images/site-logo.gif" alt="bbqReview Site Logo">
    </div>
      
    <!-- Site Navigation -->
    <ul class="nav justify-content-center pb-2">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reviews.php">Reviews</a>
      </li>
        
      <?php
        // Check session to determine if user is logged in before allowing option to add review
        if (isset($_SESSION['userID'])) {
          echo '
            <li class="nav-item">
              <a class="nav-link" href="addreview.php">Add Review</a>
            </li>
          ';
        }
      ?>
  
      <li class="nav-item">
        <a class="nav-link" href="bbqimages.php">Images</a>
      </li>
        
      <!-- Check session to determine if user is logged in.  If yes, "Join" option is redundant and needs to be removed -->
      <?php
        if (!isset($_SESSION['userID'])) {
          echo '
            <li class="nav-item">
              <a class="nav-link" href="join.php">Join</a>
            </li>          
          ';
        }
      ?>
  
      <!-- Check session to determine if user is logged in.  If yes, "Login" option is redundant and needs to be removed.  If no, "Logout" option is redundant and needs to be removed. -->
      <?php
        if (!isset($_SESSION['userID'])) {
          echo '
            <li class="nav-item">
              <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </li>
          ';
        } else {
          echo '
            <li class="nav-item">
              <form action="includes/logout.inc.php" method="POST">
                <button type="submit" class="btn text-white">Logout</button>
              </form>
            </li>
          ';
        }
      ?>
    </ul>
  </div>

  
  <!-- Modal - Site Login -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login | bbqReview</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
  
        <!-- Dynamic Form Component - connect to login.inc.php to process the data captured-->
        <div class="modal-body">
          <form action="includes/login.inc.php" method="POST">
            <div class="mb-3">
              <label for="login-username" class="form-label">Username or Email</label>
              <input type="text" class="form-control" id="login-username" name="login-username" placeholder="Enter your user ID">
              <div id="emailHelp" class="form-text">We'll never share your details with anyone else!</div>
            </div>
            <div class="mb-3">
              <label for="login-password" class="form-label">Enter password</label>
              <input type="password" class="form-control" id="login-password" name="login-password" placeholder="Password">
            </div>
  
            <!-- Login / Cancel Buttons -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" name="login-button">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>
  <!-- Site Logo -->

  <!-- Error message handling for login form -->
  <!-- Image icons for alert boxes -->
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
  </svg>

  <div class="container mt-4" style="width:1000px">
    <?php
      // Check $_GET superglobal for any error messages
      if (isset($_GET['signinerror'])) {

        // Error #1: Empty login fields
        if ($_GET['signinerror'] == "emptyfields") {
        $errorAlert = "Please complete all login fields";

        // Error #2: SQL connection error
        } else if ($_GET['signinerror'] == "sqlerror") {
          $errorAlert = "Internal server error occurred, please try again later.";

        // Error #3: User ID not found
        } else if ($_GET['signinerror'] == "nouser") {
          $errorAlert = "User does not exist, please create an account.";
          
        // Error #4: Incorrect password entry
        // IMPORTANT - Change once testing has been confirmed!!!
        } else if ($_GET['signinerror'] == "nomatch") {
          $errorAlert = "Sign in error - check credentials and try again!";
        }
        // Display applicable error message on screen
        echo '
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>' . $errorAlert . '</div>
          </div>
        ';
        
        // If no errors detected, display login success on screen
      } else if (isset($_GET['login']) == "success") {
        echo '
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>Login Successful!</div>
          </div>
        ';
      }
    ?>
  </div>