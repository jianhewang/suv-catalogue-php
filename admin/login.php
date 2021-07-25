<?php
	session_start();

	include("../includes/header.php");

	include("/home/jwang118/data/data.php");

	
	if(isset($_SESSION['fXwxF4WQbfE9e7jo7Kjt'])) {
		header("Location:welcome.php");
	}

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(isset($_POST['login'])){
		if (($username == $username_good) && (password_verify($password, $pw_enc))){

			session_start(); 
			$_SESSION['fXwxF4WQbfE9e7jo7Kjt'] = session_id();
			$_SESSION['username'] = $username_good;
			header("Location:welcome.php"); 
		}
		else {
			if($username != "" && $password !=""){
				$msg = "Invalid username or password. Please try again"; 
			}else{
				$msg = "Username and Password are required.";
			}
		}
	}
?>

<div class="d-flex justify-content-center"> 
	
	<form class="login-form px-0" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<h1 class="mb-4">Log In</h1>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" name="username" id="username" value="<?php echo $username;?>">
		</div>
		
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" name="password" id="password">
		</div>
		

		<input type="submit" class="btn btn-primary" name="login" value="Log in">
	</form>
	  

</div>
<div class="container-sm d-flex justify-content-center"> 
<?php 
	if($msg){
		echo "<div class=\"alert alert-warning col-6 my-4\">$msg</div>";
	}
?>
</div>

<?php
	include("../includes/footer.php");
?>