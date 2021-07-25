<?php
include ("includes/header.php");

$getcount = mysqli_query($con,"SELECT COUNT(*) FROM jwa_suv_catalog"); 

$postnum = mysqli_result($getcount,0);


$limit = 5; 
if($postnum > $limit){ 
	$tagend = round($postnum % $limit,0); 
	$splits = round(($postnum - $tagend)/$limit,0); 
	
	
	if($tagend == 0){ 
		$num_pages = $splits; 
	} else{ 
		$num_pages = $splits + 1; 
	}
	
	if(isset($_GET['pg'])){ 
		$pg = $_GET['pg']; 
	} else{ 
		$pg = 1; }
	
	$startpos = ($pg*$limit)-$limit; 
	$limstring = "LIMIT $startpos,$limit"; 
	
} else{ 
	$limstring = "LIMIT 0,$limit";
}


function mysqli_result($res, $row, $field=0) { 
	$res->data_seek($row); 
	$datarow = $res->fetch_array(); 
	return $datarow[$field]; 
}
$displayPageNo = 1;
// DEFAULT QUERY: RETRIEVE EVERYTHING
$result = mysqli_query($con, "SELECT * FROM jwa_suv_catalog order by vid desc $limstring") or die(mysql_error());

?>

<div class="jumbotron">
	<h1>
		Welcome, SUV fans.
	</h1>
	<p class="lead">
		Here, you can all the latest SUV models from all the popular brand names you have ever heard about.  
	</p>
	<p class="lead pt-3">
		<a href="<?php echo BASE_URL?>main.php" class="btn btn-info">Explore Our Collections</a>
	</p>
</div>

	
	
<div class="main-content">
	
	<div class="contents">
		
		<section class="p-3">
			<h2 class="text-success">
				About Us
			</h2>
			<p>
					We collect all the latest SUV models for all popular brands in the current North American market. We aim to create a one-stop convenient and informative website with all essential information, for either potential SUV shoppers or simply SUV fans like us. 
			</p>
			
		</section>
		<section class="p-3">
			<h2 class="text-primary">
				Features
			</h2>
			<p>
					Our website will not only throw you all the SUVs but also allow you to select a predefined filter search function to view categorized information. With the help of our awesome filters, you can easily narrow down the search and accurately nail the vehicle.  
			</p>
			<p>
				It's time to check it out. Enjoy!.
			</p>
		</section>
	</div>
	<!-- End of thumbnails	 -->
	
	<!-- widget -->
	<div class="widget py-1 widget align-self-start">

			
<?php include ("includes/widget.php")?>
	
</div>





<?php
include ("includes/footer.php");
?>
