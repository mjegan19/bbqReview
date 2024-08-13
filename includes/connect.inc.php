<?php

// Declare variables for Database Configuration
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bbqDB";

// Create a variable to store connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Establish connection to Database & return success/failure alert
if ($connection->connect_error) {
  die('<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Connection to Database failed.' . $connection->connect_error . '</div></div>');
} else {
  echo('<div class="alert alert-success d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg><div>Connection successful</div></div>');
}

?>