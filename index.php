<!-- Access the header of the page -->
<?php
  require "header.php"
?>

  <main class="container p-3 review-body mb-5" style="width:1000px">
  
    <?php
      if (isset($_SESSION['userID'])) {
        echo '
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>You are logged in!</div>
          </div>
        ';
      } else if (isset($_GET['signup']) == 'success') {
        echo '
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>Signup successful!  Welcome to bbqRestaurant Review!</div>
          </div>
        ';
      } else {
        echo '
        <div class="alert alert-primary d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
          <div>You are not currently logged in.</div>
        </div>
      ';
      }
    ?>
  
      <h3 class="display-6">Welcome<?php if (isset($_SESSION['firstName'])) { echo ' back ' . ($_SESSION['firstName']) . '!'; } else { echo '!';} ?></h3>
      <img src="./site-images/welcome-img.jpg" alt="Man cutting smoked beef ribs" class="welcome-img">
      <p>You've come to the right place for all things BBQ.  View the reviews of BBQ restaurants left by people just like you, who have a passion for the cue.</p>
      <hr>
      <p class="mb-0">Been somewhere tasty recently?  You can also sign up and leave your own review.  Just click "Join" above to get started!</p>

  </main>

<!-- Access the footer of the page -->
<?php
  require "footer.php"
?>
