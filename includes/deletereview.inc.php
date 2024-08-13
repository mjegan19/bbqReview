<?php
  session_start();

  // Check user is logged in and accessed the includes file by clicking the delete post button
  if (isset($_SESSION['userID']) && isset($_GET['id'])) {

    // Connect to bbqDB (database)
    require 'connect.inc.php';
  
    // Collect & store all data - that from the ID and that via $_POST
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $id = intval($id);

    // Declare prepared SQL statement to delete review
    $preparedSQL = "DELETE FROM tblReviews WHERE reviewID=?";

    // Initialise SQL statement
    $statement = mysqli_stmt_init($connection);

    // Prepare statement to bbqDB to check for possible errors
    if(!mysqli_stmt_prepare($statement, $preparedSQL)) {

      // ERROR: Something wrong when preparing SQL
      header("Location: ../reviews.php?id=$id&error=sqlerror");
      exit();
    } else { 
    
      // Bind the id associated to the review being deleted
      mysqli_stmt_bind_param($statement, 'i', $id);

      // Execute the SQL statement
      mysqli_stmt_execute($statement);

      // Confirmation of deleted post and redirect back to the reviews page
      header("Location: ../reviews.php?delete=success");
      exit();
      
    }
    // Redirect user if they accessed the includes file other than by clicking edit post button
  } else {
    header("Location: ../index.php");
  }
?>