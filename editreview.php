<?php
  require 'header.php';
?>

<main class="container bg-white p-3 mb-5" style="width:1000px">
<?php
  // Dynamic error messaging
  if (isset($_SESSION['userID']) && isset($_GET['id'])) {

    // Connect to bbqDB (database)
    require './includes/connect.inc.php';

    // Declare a variable to store the array of review data from the database with the matching ID
    $row;

    // Collect data via $_GET, escape strings and store
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $id = intval($id);

    // Declare prepared SQL statement to retrieve data from database related to the reviewID
    $preparedSQL = "SELECT venueName, venueCity, regionStyle, foodImgURL, reviewComments, rating, websiteURL FROM tblReviews WHERE reviewID=?";

    // Initialise SQL Statement
    $statement = mysqli_stmt_init($connection);

    // Prepare and send statement to database, check for errors
    if (!mysqli_stmt_prepare($statement, $preparedSQL)) {

      // Error - Problem encountered when preparing SQL
      header("Location: reviews.php?id=$id&error=sqlerror");
      exit();

    } else {

      // No error found, proceed with retrieving review
      // Bind the id associated to the review being edited
      mysqli_stmt_bind_param($statement, "i", $id);

      // Execute the SQL statement
      mysqli_stmt_execute($statement);

      // Store result and convert it into an array
      $result = mysqli_stmt_get_result($statement);
      $row = mysqli_fetch_assoc($result);
    }

    // If user has accessed page other than clicking editpost button, redirect back to reviews.php
  } else {
    header("Location: reviews.php");
    exit();
  }

  // Dynamic error alert for edit review
  if (isset($_GET['error'])) {

    // User has left empty fields
    if ($_GET['error'] == "emptyfields") {
      $errorAlert = "Please fill out all form fields";
    
    } else if ($_GET['error'] == "sqlerror") {
      $errorAlert = "Internal server error occurred, please try again later.";
    }

    // Display any error alerts to the page
    echo '
      <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>' . $errorAlert . '</div>
      </div>
    ';
  }
?>


<!-- Pull in data using $_GET with applicable ID data -->
<form action="includes/editreview.inc.php?id=<?php echo $id ?>" method="POST">
<h3 class="display-6 text-center mb-5">Edit Review</h3>

  <!-- Venue Name -->
  <div class="row mb-3">
    <label for="venueName" class="col-sm-2 col-form-label">Venue Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="venueName" value="<?php echo $row['venueName'] ?>">
    </div>
  </div>

  <!-- Location -->
  <div class="row mb-3">
    <label for="city" class="col-sm-2 col-form-label">City</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="city" value="<?php echo $row['venueCity'] ?>">
    </div>
  </div>

  <!-- Regional BBQ Style -->
  <fieldset class="row mb-3">
    <legend class="col-form-label col-sm-2 pt-0">Regional BBQ Style</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="bbq-style" id="gridRadios1" value="Carolina" <?php if ($row['regionStyle']== "Carolina") echo "checked";?>>
        <label class="form-check-label" for="Carolina">
          Carolina
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="bbq-style" id="gridRadios2" value="Kansas City" <?php if ($row['regionStyle']== "Kansas City") echo "checked";?>>
        <label class="form-check-label" for="Kansas City">
          Kansas City
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="bbq-style" id="gridRadios3" value="Memphis" <?php if ($row['regionStyle']== "Memphis") echo "checked";?>>
        <label class="form-check-label" for="Memphis">
          Memphis
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="bbq-style" id="gridRadios3" value="Texas" <?php if ($row['regionStyle']== "Texas") echo "checked";?>>
        <label class="form-check-label" for="Texas">
          Texas
        </label>
      </div>
    </div>
  </fieldset>

  <!-- Review Comments -->
  <div class="row mb-3">
    <label for="reviewComments" class="col-form-label">Review Comments</label>
    <div class="col-sm-10 offset-sm-2">
      <textarea class="form-control" name="reviewComments" rows="3"><?php echo $row['reviewComments'] ?></textarea>
    </div>
  </div>

  <!-- Rating -->
  <div class="row mb-3">
    <label for="rating" class="col-sm-2 col-form-label">Score Rating</label>
    <div class="col-sm-10 w-25">
      <select class="form-select" aria-label="Default select example" name="rating">
        <option selected>Rating out of 5</option>
        <option value="5" <?php if ($row['rating']== "5") echo "selected";?>>Five</option>
        <option value="4" <?php if ($row['rating']== "4") echo "selected";?>>Four</option>
        <option value="3" <?php if ($row['rating']== "3") echo "selected";?>>Three</option>
        <option value="2" <?php if ($row['rating']== "2") echo "selected";?>>Two</option>
        <option value="1" <?php if ($row['rating']== "1") echo "selected";?>>One</option>
      </select>
    </div>
  </div>

  <!-- Img URL -->
  <div class="row mb-3">
    <label for="imgURL" class="col-sm-2 col-form-label">Image URL</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="imgURL" value="<?php echo $row['foodImgURL'] ?>">
    </div>
  </div>
  
  <!-- Website URL -->
  <div class="row mb-3">
    <label for="websiteURL" class="col-sm-2 col-form-label">Website URL</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="websiteURL" value="<?php echo $row['websiteURL'] ?>">
    </div>
  </div>
  
  <div class="row mb-3">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" name="edit-review-btn" type="submit">Update Review</button>
    </div>
  </div>

</form>


</main>

<?php
  require 'footer.php';
?>