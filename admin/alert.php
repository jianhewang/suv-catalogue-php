<?php
	include("../includes/header.php");

	session_start();

// 	if(isset($_SESSION['fXwxF4WQbfE9e7jo7Kjt'])) {
// 		header("Location:../index.php");
// 	}
// 	else {
// 		$txtMsg = "You need to login to enable admin functions.";
// 	}

	if(!isset($_SESSION['fXwxF4WQbfE9e7jo7Kjt'])) {
		$txtMsg = "You need to login to access admin functions.";
	}

?>

<div class="container-sm"> 
	<h1>Hello, Visitor</h1>

 	<div class="alert alert-warning"><?php echo $txtMsg;?></div>
	<a href="../index.php" class="btn btn-primary">Home</a>
	<a href="login.php" class="btn btn-info">Login</a>


</div>

<?php
	include("../includes/footer.php");
?>