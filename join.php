<!-- Access the header of the page -->
<?php
  require "header.php"
?>

  <main class="container bg-white mt-3 p-4 mb-5" style="width:1000px">

    <!-- Includes file 'join.inc.php' will process the following form data -->
    <form action="includes/join.inc.php" method="POST">
      <h1 class="display-4 text-center">Join Our Site</h1>
      
      <!-- Error message handling for site registration form fields -->
      <?php
        // Check $_GET superglobal for error messages
        if (isset($_GET['error'])) {
          
          // Error #1: One or more form fields has been left empty
          if ($_GET['error'] == "emptyfields") {
            $errorAlert = "Please complete all form fields";

            // Error #2: Name, Username & Email entries are all invalid
          } else if ($_GET['error'] == "allfieldsinvalid") {
            $errorAlert = "Name, Username & Email fields contain invalid characters, please re-enter.";

            // Error #3: Name entry is invalid
          } else if ($_GET['error'] == "invalidfname") {
            $errorAlert = "Name entered contains invalid characters, please re-enter.";

            // Error #4: Username entry is invalid
          } else if ($_GET['error'] == "invalidusername") {
            $errorAlert = "Username entered contains invalid characters, please re-enter.";
        
            // Error #5: Email entry is invalid
          } else if ($_GET['error'] == "invalidemail") {
            $errorAlert = "Email entered contains invalid characters or formatting, please re-enter.";
            
            // Error #5: Password entry fields do not match
          } else if ($_GET['error'] == "passwordmatch") {
            $errorAlert = "Password fields do not match, please re-enter.";
            
            // Error #6: SQL connection error
          } else if ($_GET['error'] == "sqlerror") {
            $errorAlert = "Internal server error occurred, please try again later.";
            
            // Error #7: Username is already taken
          } else if ($_GET['error'] == "usernametaken") {
            $errorAlert = "Username already exists, please re-enter something different.";
            
            // Display applicable error message on screen
          }
          echo '
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>' . $errorAlert . '</div>
            </div>
          ';
        }
      ?>

      <!-- Name entry field -->
      <div class="mb-3">
        <label for="fname" class="form-label">Enter first name</label>
        <!-- Auto-refill user entry if field didn't contain error -->
        <input type="text" class="form-control" id="fname" name="fname" placeholder="Name" value="<?php if (isset($_GET['fname'])) { echo ($_GET['fname']); } else { echo null; } ?>">
      </div>
      
      <!-- Username entry field -->
      <div class="mb-3">
        <label for="username" class="form-label">Create a username</label>
        <!-- Auto-refill user entry if field didn't contain error -->
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php if (isset($_GET['username'])) { echo ($_GET['username']); } else { echo null; } ?>">
      </div>

      <!-- Email entry field -->
      <div class="mb-3">
        <label for="email" class="form-label">Enter valid email address</label>
        <!-- Auto-refill user entry if field didn't contain error -->
        <input type="text" class="form-control" id="email" name="email" placeholder="someone@somewhere.com" value="<?php if (isset($_GET['email'])) { echo ($_GET['email']); } else { echo null; } ?>">
      </div>

      <!-- Password entry field -->
      <div class="mb-3">
        <label for="password" class="form-label">Create a secure password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
      </div>

      <!-- Password re-entry field -->
      <div class="mb-3">
        <label for="password" class="form-label">Re-enter secure password</label>
        <input type="password" class="form-control" id="password-repeat" name="password-repeat" placeholder="Enter password">
      </div>

      <!-- Submit button -->
      <div class="d-grid col-6 mx-auto">
        <button class="btn btn-info" type="submit" name="register-button">Submit</button>
      </div>
    </form>
  </main>

<!-- Access the footer of the page -->
<?php
  require "footer.php"
?>