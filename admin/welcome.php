<?php
	include("../includes/header.php");

	session_start();

	if(isset($_SESSION['fXwxF4WQbfE9e7jo7Kjt'])) {
		$txtMsg = "You are now logged in."; 
	}else {
		header("Location:login.php");
	}
?>

<div class="container-sm"> 
	<h2>Welcome, Admin</h2>

 	<div class="alert alert-success"><?php echo $txtMsg;?></div>
	<a href="../index.php" class="btn btn-primary">Home</a>
	<a href="insert.php" class="btn btn-info">Add</a>
	<a href="edit.php" class="btn btn-secondary">Edit</a>

</div>

<?php
	include("../includes/footer.php");
?>