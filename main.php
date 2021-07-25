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
$result = mysqli_query($con, "SELECT * FROM jwa_suv_catalog order by vid asc $limstring") or die(mysql_error());

setlocale(LC_MONETARY, "en_US");
?>

<div class="jumbotron">
	<h1>
		All You Can Find
	</h1>
	<p class="lead">
		Enjoy the exploration on your favorite models.
	</p>
	<p class="lead">
		
	</p>
</div>

	
<div class="main-content">
	
	<div class="contents">


		<?php
		

		// FILTERING YOUR DB
		$displayby = $_GET['displayby'];
		$displayvalue = $_GET['displayvalue'];
		$minValue = $_GET[('minvalue') ];
		$maxValue = $_GET[('maxvalue') ];

		if (isset($displayby) && isset($displayvalue))
		{
				// HERE IS THE MAGIC: WE TELL OUR DB WHICH COLUMN TO LOOK IN, AND THEN WHICH VALUE FROM THAT COLUMN WE'RE LOOKING FOR
				$result = mysqli_query($con, "SELECT * FROM jwa_suv_catalog WHERE $displayby LIKE '$displayvalue'") or die(mysql_error());
				$displayPageNo = 0;

		}

		if (isset($displayby) && isset($minValue) && isset($maxValue))
		{
				
			$result = mysqli_query($con, "Select * From jwa_suv_catalog Where $displayby between '$minValue' and '$maxValue'");
				if (mysqli_fetch_array($result) == null)
				{
						$noresult = true;
					
				}
			
			
			$displayPageNo = 0;
		}

		/************************** ECHO OUT YOUR RESULTS ***********************/
		if ($noresult)
		{
				echo "<br />";
				echo "<p>No results found. Please try a different search.</p>";

		}
		?>
		<?php 
		
			while ($row = mysqli_fetch_array($result)):
		?>
		<?php 
			$vid = ($row['vid']);
			$model = ($row['model']);
			$price = ($row['price']);
			$year = ($row['year']);
			$brand = ($row['brand']);
			$fileName = $row['image'];
		
		
		?>
				
		<section class="border border-3 rounded p-3 display my-4">
			<div class="display-img">
				<img src="<?php echo empty($fileName)? "" : "thumbs/" . $fileName; ?>" alt="<?php echo $model;?>">
			</div>
			<div class="suv-info">
				<h3>
					<?php echo $model?>
				</h3>
				<p>
					<b>Brand:</b> <?php echo $brand?>
				</p>
				<p><b>Year:</b> <?php echo $year?></p>
				<p>
					<b>Base Prices:</b> <?php echo money_format("%n", $price)?>
				</p>
				<div class="suv-button">
					<a href="display.php?vid=<?php echo $vid?>" class="suv-button-link">View Details</a>
				</div>
				
			</div>
		</section>

	<?php endwhile;?>
		
<!-- 	Pagenation	 -->
		<ul class="pagination">
			<?php
			if ($displayPageNo != 0){
				if($postnum > $limit){ 
				$n = $pg + 1; 
				$p = $pg - 1; 
				$thisroot = $_SERVER['PHP_SELF']; 
				if($pg > 1){ 
					echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot?pg=$p\"><</a></li>"; 
				} 
				for($i=1; $i<=$num_pages; $i++){ 
					if($i!= $pg){ 
						echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot?pg=$i\">$i</a></li>"; 
					}else{ 
						echo "<li class=\"page-item\"><a class=\"page-link\">$i</a></li>"; 
					} 
				} 
				if($pg < $num_pages){ 
					echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot?pg=$n\">></a></li>"; 
				} 
				echo "&nbsp;&nbsp;"; 
			}
			}
			 
			?>
		</ul>
<!-- 	pagination end	 -->
	</div>
	<!-- End of thumbnails	 -->
	
	
	
	
	<!-- widget -->
	<div class="widget py-1 widget align-self-start">

			
<?php include ("includes/widget.php")?>
	
</div>





<?php
include ("includes/footer.php");
?>
