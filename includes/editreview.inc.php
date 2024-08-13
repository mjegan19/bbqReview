<?php
  session_start();

  // Check user accessed the includes file by clicking the edit post button
  if (isset($_POST['edit-review-btn']) && isset($_SESSION['userID'])) {

    // Connect to bbqDB (database)
    require 'connect.inc.php';

    // Collect & store all data - that from the ID and that via $_POST
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $id = intval($id);

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
    
        // Redirect back to editreview.php 
        header("Location: ../editreview.php?id=$id&error=emptyfields");
        exit();
  
        // Proceed saving post to bbqDB
      } else {
    
        // Declare SQL template with ? placeholders
        $preparedSQL = "UPDATE tblReviews SET venueName=?, venueCity=?, regionStyle=?, foodImgURL=?, reviewComments=?, rating=?, websiteURL=? WHERE reviewID=?";
    
        // Initialise SQL statement
        $statement = mysqli_stmt_init($connection);
    
        // Prepare and send statement to bbqDB to check for errors
        if (!mysqli_stmt_prepare($statement, $preparedSQL)) {
    
          // Redirect back to addreview.php
          header("Location: ../editreview.php?id=$id&error=sqlerror");
          exit();
          
        } else {
    
          // Bind user input data with the statement, escape the strings
          mysqli_stmt_bind_param($statement, "sssssisi", $venue, $city, $bbqStyle, $imgURL, $comments, $rating, $webURL, $id);
    
          // Execute the SQL statement
          mysqli_stmt_execute($statement);
    
          // Confirmation of saved post and redirect back to the reviews page
          header("Location: ../reviews.php?edit=success");
          exit();
        }
      }

    // Redirect user if they accessed the includes file other than by clicking edit post button
  } else {
    header("Location: ../index.php");
  }
?>