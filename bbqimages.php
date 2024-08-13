<?php
  require 'header.php';
?>

<main class="container p-3 review-body pb-5 mb-5" style="width:1000px">
  <h1 class="display-4 text-center mb-5">Share your BBQ Images!</h1>

  <?php
    // Declare variables initial states
    $directory = "images";
    $uploadOk = 1;
    $msgAlert = '';
    $msgAlertExt = '';

    // Declare PHP Upload Error Scenarios - Errors found in $_FILES
    $phpFileUploadErrors = array(
      0 => 'There is no error, the file uploaded with success',
      1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
      2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
      3 => 'The uploaded file was only partially uploaded',
      4 => 'No file was uploaded',
      6 => 'Missing a temporary folder',
      7 => 'Failed to write file to disk.',
      8 => 'A PHP extension stopped the file upload.',
    );

    // Save upload data to variables
    if (isset($_POST['submit'])) {
      $temp_name = $_FILES['fileToUpload']['tmp_name'];
      $target_file = $_FILES['fileToUpload']['name'];
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      $imgURL = $directory . DIRECTORY_SEPARATOR . $target_file;


      // Assign PHP error event to variable
      $error = $_FILES['fileToUpload']['error'];
      if ($_FILES['fileToUpload']['error'] != 0) {
        $msgAlertExt = $phpFileUploadErrors[$error];
        $uploadOk = 0;
      }

      // Set Custom Error Alerts

      // Error Alert if file already exists
      if ($msgAlertExt == "" && file_exists($imgURL)) {
        $msgAlertExt = "Filename already exists.";
        $uploadOk = 0;
      }

      // Error Alert if file extension doesn't match defined image extensions allowed
      if ($msgAlertExt == "" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        $msgAlertExt = "Invalid file upload, please upload jpg, jpeg, png or gif file extensions only!";
        $uploadOk = 0;
      }

      // 
      if ($uploadOk == 0) {
        $msgAlert = "<p>Sorry, file could not be uploaded.</p>" . "Error: " . $msgAlertExt;
      } else {
        if (move_uploaded_file($temp_name, $directory . "/" . $target_file)) {
          $msgAlert = "File upload successful!";
        }
      }
    }
  ?>

  <!-- Bootstrap form input for Image Uploader -->
  <form action="bbqimages.php" method="POST" enctype="multipart/form-data" class="mb-5">
    <p class="lead text-center">Select image to upload:</p>

    <div class="input-group mb-3">     
      <!-- File Input -->
      <input type="file" class="form-control" id="inputGroupFile" name="fileToUpload">
      <!-- Submit Button -->
      <input type="submit" value="Upload" name="submit" class="btn btn-primary input-group-text">
    </div>

  </form>

  <!-- Display dynamic alert message to user -->
  <?php
    if ($msgAlert == "") {
      echo null;
    } else if ($uploadOk == 0) {
      echo '
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>' . $msgAlert . '</div>
        </div>
      ';
    } else {
      echo '
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>' . $msgAlert . '</div>
        </div>
      ';
    }


  ?>
  
  
  <h3 class="display-6 text-center mb-4">User Shared Photo Uploads:</h3>
  
  <div class="row">
    <!-- Dynamically display uploaded images -->
    <?php
      $imgLocation = "." . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR;
      $images = glob($imgLocation . "*.jpg");
      
      foreach ($images as $image) {
        echo '
          <div class="col-sm-3 mb-4">
            <div class="card">
              <div class = "card-body">
                <a href="' . $image . '" target="_blank">
                  <img src="' . $image . '" class="bbq-img" alt="User uploaded BBQ Image">
                </a>        
              </div>
            </div>
          </div>
        ';
      }
    ?>
  </div>

</main>

<?php
  require 'footer.php';
?>