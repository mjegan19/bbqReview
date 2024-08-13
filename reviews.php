<?php
  require 'header.php';
?>

<main class="container p-3 review-body mb-5" style="width:1000px">
  <h1 class="display-4 text-center mb-5">BBQ Restaurant Reviews</h1>
<?php
// Connect to bbqDB (database)
require './includes/connect.inc.php';

// Declare SQL statement to retrieve all posts from the DB
$preparedSQL = "SELECT reviewID, venueName, venueCity, regionStyle, foodImgURL, reviewComments, rating, websiteURL FROM tblReviews";

// Call SQL query and store in variable $result
$result = mysqli_query($connection, $preparedSQL);
?>

<!-- Dynamic success alert for review creation -->
<?php
  if (isset($_GET['review']) == "success") {
    echo '
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>Review created! Thanks for sharing.</div>
          </div>
        ';
  }
  
  if (isset($_GET['edit']) == "success") {
    echo '
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>Review successfully edited!</div>
          </div>
        ';
  }

  // Dynamic success or error alert for review deletion
  if (isset($_GET['error']) == "sqlerror") {
    echo '
      <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>Internal server error occurred, please try again later.</div>
      </div>
    ';
  } else if (isset($_GET['delete']) == "success") {
      echo '
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>Review successfully deleted!</div>
        </div>
      ';
  }
?>

<!-- Dynamic review output to card template -->
<?php
  // Check for reviews returned in result variable and output if present
  if (mysqli_num_rows($result) > 0) {

    // Loop over data, load each review into Bootstrap card and output to page

    // Declare new variable with default state
    $output = "";

    // Convert result variable into array, and loop over array with while statement
    while ($row = mysqli_fetch_assoc($result)) {

      // Join cards together (.=)
      $output .= '
        <div class="card mb-3" id="' . $row['reviewID'] . '">
          <h3 class="card-header review-bar">' . $row['venueName'] . '</h3>
          <div class="row g-0">
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Located in ' . $row['venueCity'] . '</h5>
                <h6 class="card-title">BBQ Region Style - ' . $row['regionStyle'] . '</h6>
                <p class="card-text">' . $row['reviewComments'] . '</p>
                <p class="card-text"><small class="text-muted">Rated ' . $row['rating'] . ' / 5</small></p>
                <a class="btn btn-primary" href="' . $row['websiteURL'] . '" target="_blank" role="button">Visit ' . $row['venueName'] . '\'s Website &#187;</a>
              </div>
            </div>
            <div class="col-md-4">
              <img src="' . $row['foodImgURL'] . '" class="img-fluid rounded-start" alt="' . $row['venueName'] . ' Restaurant Image">
            </div>
          </div>  
      ';

      // If the user is logged in, toggle on the edit and delete options
      if (isset($_SESSION['userID'])) {
        $output .= '
          <div class="review-btns">
            <a href="editreview.php?id=' . $row['reviewID'] . '" class="btn btn-light">
              <i class="bi bi-pencil-square"></i>
              Edit Post
            </a>
            <a href="includes/deletereview.inc.php?id=' . $row['reviewID'] . '" class="btn btn-light">
              <i class="bi bi-x-square-fill"></i>
              Delete Post
            </a>
          </div>        
        ';
      }

      // Close off the HTML element
      $output .= '
        </div>      
      ';
    }

    // Print out the result in looped array to the screen
    echo $output;
  
    // Alert user if there are currently no reviews in the database
  } else {
    echo "The are currently no reviews to display.";

  }
  // Close connection to the database
  mysqli_close($connection);
?> 

</main>

<?php
  require 'footer.php';
?>