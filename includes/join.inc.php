<?php
  // Check user accessed includes file by clicking submit button
  if(isset($_POST['register-button'])){

    // Connect to bbqDB (database)
    require 'connect.inc.php';

    // Collect form $_POST information & store in variables
    $firstname = $_POST['fname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password-repeat'];

    // Validate form $_POST information for errors

    // Check for empty form fields, redirect back to join.php with custom error msg 
    // Pass back any other fields that were completed (excluding passwords)
    if (empty($firstname) || empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
      header("Location: ../join.php?error=emptyfields&fname=".$firstname."&username=".$username."&email=".$email);
      exit();

      // Check if name, username & email fields all contain invalid entries or syntax errors
      // Return only the error message, as all fields are invalid
    } else if (!preg_match("/^[a-zA-Z]*$/", $firstname) && !preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../join.php?error=allfieldsinvalid");
      exit();
      
      // Catch if name field contains characters other than letters
      // Pass back any other fields that were completed (excluding passwords)
    } else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
      header("Location: ../join.php?error=invalidfname&username=".$username."&email=".$email);
      exit();
      
      // Catch if username field is invalid & contains characters other than letters or numbers
      // Pass back any other fields that were completed (excluding passwords)
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../join.php?error=invalidusername&fname=".$firstname."&email=".$email);
      exit();
      
      // Catch if email field contains invalid characters / formatting
      // Pass back any other fields that were completed (excluding passwords)
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../join.php?error=invalidemail&fname=".$firstname."&username=".$username);
      exit();
      
      // Catch if both password fields are different to one another
      // Pass back any other fields that were completed (excluding passwords)
    } else if ($password !== $passwordRepeat) {
      header("Location: ../join.php?error=passwordmatch&fname=".$firstname."&username=".$username."&email=".$email);
      exit();


      // Validation checks of form information completed without error(s) detected
      // Proceed to check bbqDB (database) for existing users (username taken)
    } else {

      // Create prepared SQL statement, store in variable
      $preparedSQL = "SELECT userName FROM tblUsers WHERE userName=?";

      // Initialise prepared SQL statement
      $statement = mysqli_stmt_init($connection);

      // Prepare statement & send to bbqDB (database) to check for possible errors
      if (!mysqli_stmt_prepare($statement, $preparedSQL)) {
        // Error #1: Problem encountered when preparing SQL statement
        header("Location: ../join.php?error=sqlerror");
        exit();

        // No SQL statement errors, proceed with checking against existing users
      } else {

        // Bind the input form data with the statement, escape the strings
        mysqli_stmt_bind_param($statement, 's', $username);

        // Execute the SQL statement
        mysqli_stmt_execute($statement);

        // Return and store the results found in database
        mysqli_stmt_store_result($statement);

        // Store in variable the amount of rows where a match was found
        $checkResults = mysqli_stmt_num_rows($statement);

        // If variable has 1 or more matched results, then the username already exists
        if ($checkResults > 0) {
          header("Location: ../join.php?error=usernametaken&fname=".$firstname."&email=".$email);
          exit();

          // User confirmed as a new user, write $_POST information to bbqDB (database)
        } else {
      
          // Create prepared SQL statement, store in variable
          $preparedSQL = "INSERT INTO tblUsers (firstName, userName, email, userPassword) VALUES (?, ?, ?, ?)";

          // Initialise prepared SQL statement
          $statement = mysqli_stmt_init($connection);

          // Prepare statement & send to bbqDB (database) to check for possible errors
          if(!mysqli_stmt_prepare($statement, $preparedSQL)){
            // Error #1: Problem encountered when preparing SQL statement
            header("Location: ../join.php?error=sqlerror");
            exit();

            // No SQL statement errors
          } else {
            // Encrypt the password prior to binding and storing in bbqDB (database)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Bind the input form data with the statement, escape the strings
            mysqli_stmt_bind_param($statement, "ssss", $firstname, $username, $email, $hashedPassword);

            // Execute the SQL statement
            mysqli_stmt_execute($statement);

            // Send user back to join.php page with Confirmation Alert
            header("Location: ../index.php?signup=success");
            exit();
          }
        }
      }
    }
    
    // Close the prepared statement and connection to database
    mysqli_stmt_close($statement);
    mysqli_close($connection);
  
  // User didn't click submit button, send back to site registration page
  } else {
    header("Location: ../join.php");
    exit();
  }
?>