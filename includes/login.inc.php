<?php
  // Check that user accessed 'login.inc.php' only by clicking the Login button
  if (isset($_POST['login-button'])) {

    // Connect to the bbqDB database
    require 'connect.inc.php';

    // Collect the entry fields from the modal stored in $_POST superglobal
    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    // Validate form $_POST information for errors
    if (empty($username) || empty($password)) {

      // 
      header("Location: ../index.php?signinerror=emptyfields");
      exit();
    
    // No empty fields found, proceed to check $_POST information against database records
    } else {

      // Create prepared SQL statement, store in variable
      $preparedSQL = "SELECT * FROM tblUsers WHERE userName=? OR email=?";

      // Initialise prepared SQL statement
      $statement = mysqli_stmt_init($connection);

      // Prepare statement & send to bbqDB (database) to check for possible errors
      if (!mysqli_stmt_prepare($statement, $preparedSQL)) {

        // Error 1: Problem encountered when preparing SQL statement
        header("Location: ../index.php?signinerror=sqlerror");
        exit();

        // No SQL statement errors, proceed with checking against existing user records - same entry field checks against userName & email
      } else {

        // Bind the login form data with the statement, escape the strings
        mysqli_stmt_bind_param($statement, 'ss', $username, $username);

        // Execute the SQL statement
        mysqli_stmt_execute($statement);

        // Store returned result in a variable
        $result = mysqli_stmt_get_result($statement);

        // Check result in variable for a match
        if ($row = mysqli_fetch_assoc($result)) {

          // Compare user input password against password in bbqDB, return T or F
          $checkPassword = password_verify($password, $row['userPassword']);

          // Error handling if password is not a match
          if ($checkPassword == false) {
            header("Location: ../index.php?signinerror=nomatch");
            exit();

            // User's password is a match in database
          } else if ($checkPassword == true) {

            // Start session and add user data to session variables
            session_start();
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['userName'] = $row['userName'];
            $_SESSION['firstName'] = $row['firstName'];
            header("Location: ../index.php?login=success");
            exit();
          
            // Catch any other error that may occur
          } else {
            header("Location: ../index.php?signinerror=nomatch");
            exit();
          }

          // No user exists in Database
        } else {
          header("Location: ../index.php?signinerror=nouser");
          exit();
        }
      }
    }

  // User made their way to this page other than clicking Login button... redirect
  } else {
    header("Location: ../index.php");
    exit();
  }
?>