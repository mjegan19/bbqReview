<?php
  // Check the user accessed includes file by clicking add review button
  if (isset($_POST['add-review-btn'])) {

    // Connect to bbqDB (database)
    require 'connect.inc.php';

    // Collect form $_POST information & store in variables
    $venue = $_POST['venueName'];
    $city = $_POST['city'];
    $bbqStyle = $_POST['bbq-style'];
    $comments = $_POST['reviewComments'];
    $rating = $_POST['rating'];
    $imgURL = $_POST['imgURL'];
    $webURL = $_POST['websiteURL'];

    // Check form for empty fields
    if (empty($venue) || empty($city) || empty($bbqStyle) || empty($comments) || empty($rating) || empty($imgURL) || empty($webURL)) {

      // Redirect back to addreview.php 
      header("Location: ../addreview.php?error=emptyfields&venueName=". $venue ."&city=". $city . "&bbq-style=" . $bbqStyle . "&reviewComments=" . $comments . "&rating=" . $rating . "&imgURL=" . $imgURL . "&websiteURL=" . $webURL);
      exit();

      // Proceed saving post to bbqDB
    } else {

      // Declare SQL template with ? placeholders
      $preparedSQL = "INSERT INTO tblReviews VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";

      // Initialise SQL statement
      $statement = mysqli_stmt_init($connection);

      // Prepare and send statement to bbqDB to check for errors
      if (!mysqli_stmt_prepare($statement, $preparedSQL)) {

        // Redirect back to addreview.php
        header("Location: ../addreview.php?error=sqlerror");
        exit();
      
      } else {

        // Bind user input data with the statement, escape the strings
        mysqli_stmt_bind_param($statement, "sssssis", $venue, $city, $bbqStyle, $imgURL, $comments, $rating, $webURL);

        // Execute the SQL statement
        mysqli_stmt_execute($statement);

        // Confirmation of saved post and redirect back to the reviews page
        header("Location: ../reviews.php?review=success");
        exit();
      }
    }  

  // User accessed includes file other than clicking add review button, redirect back to addreview.php
  } else {
    header("Location: ../addreview.php");
    exit();
  }
?>