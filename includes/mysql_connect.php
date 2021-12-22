<?php

// Connect to DB: Since all files depend on this, this will be included in our header, which is then included in all files.
// $host = "localhost";
// $username = "jwang118";
// $password = "QbvBKGFnnNKQD5y";
// $dbName = "jwang118";

// $con = mysqli_connect($host, $username, $password, $dbName);

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$con = mysqli_connect($server, $username, $password, $db);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//This stops SQL Injection in POST vars
  foreach ($_POST as $key => $value) {
    $_POST[$key] = mysqli_real_escape_string($con, $value);
  }

  //This stops SQL Injection in GET vars
  foreach ($_GET as $key => $value) {
    $_GET[$key] = mysqli_real_escape_string($con, $value);
  }

// 	We use a constant (basically the same as a variable (stores a value)) to set the Base URL. We will use this to resolve all links as absolute URL's instead of relative URL's. If we do this correct, then we will not have any troubles pathing to all our files.
  // Make sure the path starts with http:// and ends with the trailing slash
  // If you copy/paste this script into other projects and fail to change this, then you may have links going back to the former project. Copy/Paste/FAIL !
  //define("BASE_URL", "http://jwang118.dmitstudent.ca/DMIT2025/suv-catalog/");
  define("BASE_URL", "https://suv-catalogue.herokuapp.com/");




  // Your App Name
  define("APP_NAME", "SUV Catalogue");
?>
