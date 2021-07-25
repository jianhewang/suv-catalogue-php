<?php
include("mysql_connect.php");// here we include the connection script; since this file(header.php) is included at the top of every page we make, the connection will then also be included. Also, config options like BASE_URL are also available to us.
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<?php header("Content-Type: text/html; charset=ISO-8859-1");?>
  <head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--  This CONSTANT is defined in your mysql_connect.php file. -->
    <title><?php echo APP_NAME; ?></title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<!-- Google Icons: https://material.io/tools/icons/
  also, check out Font Awesome or Glyphicons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- 	custom script	 -->
<script type="text/javascript"> 
	function go() { box = document.getElementById('entryselect'); 
		destination = box.options[box.selectedIndex].value; 
	  if (destination) location.href = destination; 
	} 
</script>

 <!-- Your Custom styles for this project -->
 <!--  Note how we can use BASE_URL constant to resolve all links no matter where the file resides. -->

<link href="<?php echo BASE_URL ?>css/main.css" rel="stylesheet">



</head>

  <body>
		<header class="bg-dark">

			
			
    <nav class="navbar main-container navbar-expand-md navbar-dark bg-dark mb-4 fixed-top">
			
      <a class="navbar-brand" href="<?php echo BASE_URL ?>index.php"><i class="material-icons-outlined" style="font-size:28px">SUV Garage</i></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo BASE_URL ?>index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo BASE_URL ?>main.php">All SUVs</a>
          </li>
					<?php if(!isset($_SESSION['username'])): ?>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo BASE_URL ?>admin/login.php">Log In</a>
          </li>
					<?php else: ?>
					<li class="nav-item active dropdown">
						
            <a class="nav-link dropdown-toggle text-warning" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hello, <?php echo $_SESSION['username'];?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?php echo BASE_URL ?>admin/insert.php">Insert</a>
              <a class="dropdown-item" href="<?php echo BASE_URL ?>admin/edit.php">Edit</a>
							<a class="dropdown-item" href="<?php echo BASE_URL ?>admin/logout.php">Logout</a>
            </div>
						
          </li>
					<?php endif;?>
        </ul>
      </div>
			
    </nav>
			
  </header>



    <main class="bg-light">
			<div class="main-container pb-4 bg-white">
				
			
