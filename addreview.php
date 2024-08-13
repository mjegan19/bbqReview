<?php
  require 'header.php';
?>

<main class="container bg-white p-3 mb-5" style="width:1000px">

<form action="includes/addreview.inc.php" method="POST">
  <h1 class="display-4 text-center mb-5">Add your review!</h1>

  <!-- Dynamic Error Handling -->
  <?php
    if (isset($_GET['error'])) {

      // Empty fields error message
      if ($_GET['error'] == 'emptyfields') {
        $errorAlert = "Please complete all review fields";
      
      // SQL Error message
      } else if ($_GET['error'] == 'sqlerror') {
        $errorAlert = "Internal server error occurred, please try again later.";
      }

      // Display dynamic error message to user
      echo '
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>' . $errorAlert . '</div>
        </div>
      ';

    }
  ?>

  <!-- Venue Name -->
  <div class="row mb-3">
    <label for="venueName" class="col-sm-2 col-form-label">Venue Name</label>
    <div class="col-sm-10">
      <!-- Auto-refill user entry if field didn't contain error -->
      <input type="text" class="form-control" id="venueName" name="venueName" placeholder="Restaurant Name" value="<?php if (isset($_GET['venueName'])) { echo ($_GET['venueName']); } else { echo null; } ?>">
    </div>
  </div>

  <!-- Location -->
  <div class="row mb-3">
    <label for="city" class="col-sm-2 col-form-label">City</label>
    <div class="col-sm-10">
      <!-- Auto-refill user entry if field didn't contain error -->
      <input type="text" class="form-control" id="city" name="city" placeholder="Where is the restaurant located?" value="<?php if (isset($_GET['city'])) { echo ($_GET['city']); } else { echo null; } ?>">
    </div>
  </div>

  <!-- Regional BBQ Style -->
  <fieldset class="row mb-3">
    <legend class="col-form-label col-sm-2 pt-0">Regional BBQ Style</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="bbq-style" id="carolina" value="Carolina" <?php if (isset($_GET['bbq-style'])) { if ($_GET['bbq-style']== "Carolina") echo "checked"; }?>>
        <label class="form-check-label" for="carolina">
          Carolina
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="bbq-style" id="kansas-city" value="Kansas City" <?php if (isset($_GET['bbq-style'])) { if ($_GET['bbq-style']== "Kansas City") echo "checked"; }?>>
        <label class="form-check-label" for="kansas-city">
          Kansas City
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="bbq-style" id="memphis" value="Memphis" <?php if (isset($_GET['bbq-style'])) { if ($_GET['bbq-style']== "Memphis") echo "checked"; }?>>
        <label class="form-check-label" for="memphis">
          Memphis
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="bbq-style" id="texas" value="Texas" <?php if (isset($_GET['bbq-style'])) { if ($_GET['bbq-style']== "Texas") echo "checked"; }?>>
        <label class="form-check-label" for="texas">
          Texas
        </label>
      </div>
    </div>
  </fieldset>

  <!-- Review Comments -->
  <div class="row mb-3">
    <label for="reviewComments" class="col-form-label">Review Comments</label>
    <div class="col-sm-10 offset-sm-2">
      <textarea class="form-control" id="reviewComments" name="reviewComments" placeholder="Tell us what the highlights were.  Which dishes did you love, which you are a miss.  Anything else you want to tell us about your visit...?" rows="3"><?php
            // Auto-refill user entry if field didn't contain error
            if (isset($_GET['reviewComments'])) {
              echo ($_GET['reviewComments']);
            }
          ?></textarea>
    </div>
  </div>

  <!-- Rating -->
  <div class="row mb-3">
    <label for="rating" class="col-sm-2 col-form-label">Score Rating</label>
    <div class="col-sm-10 w-25">
      <select class="form-select" aria-label="Default select example" id="rating" name="rating">
        <option selected>Rating out of 5</option>
        <option value="5" <?php if (isset($_GET['rating'])) { if ($_GET['rating']== "5") echo "selected"; }?>>Five</option>
        <option value="4" <?php if (isset($_GET['rating'])) { if ($_GET['rating']== "4") echo "selected"; }?>>Four</option>
        <option value="3" <?php if (isset($_GET['rating'])) { if ($_GET['rating']== "3") echo "selected"; }?>>Three</option>
        <option value="2" <?php if (isset($_GET['rating'])) { if ($_GET['rating']== "2") echo "selected"; }?>>Two</option>
        <option value="1" <?php if (isset($_GET['rating'])) { if ($_GET['rating']== "1") echo "selected"; }?>>One</option>
      </select>
    </div>
  </div>

  <!-- Img URL -->
  <div class="row mb-3">
    <label for="imgURL" class="col-sm-2 col-form-label">Image URL</label>
    <div class="col-sm-10">
      <!-- Auto-refill user entry if field didn't contain error -->
      <input type="text" class="form-control" id="imgURL" name="imgURL" placeholder="Enter image URL" value="<?php if (isset($_GET['imgURL'])) { echo ($_GET['imgURL']); } else { echo null; } ?>">
    </div>
  </div>
  
  <!-- Website URL -->
  <div class="row mb-3">
    <label for="websiteURL" class="col-sm-2 col-form-label">Website URL</label>
    <div class="col-sm-10">
      <!-- Auto-refill user entry if field didn't contain error -->
      <input type="text" class="form-control" id="websiteURL" name="websiteURL" placeholder="Enter the restaurant's website URL" value="<?php if (isset($_GET['websiteURL'])) { echo ($_GET['websiteURL']); } else { echo null; } ?>">
    </div>
  </div>
  
  <div class="row mb-3">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" name="add-review-btn">Add Review</button>
    </div>
  </div>

</form>


</main>

<?php
  require 'footer.php';
?>