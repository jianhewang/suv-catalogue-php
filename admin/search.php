<?php
	include("../includes/header.php");

  $searchTitle = "Search Page";
	$hasResult = 0;
  if (isset($_POST['submit-search'])) {
    $searchTerm = $_POST['search'];

    $searchTitle = "Search results for '" . $searchTerm . "'";
		
		$searchSql = "Select * From jwa_suv_catalog
            Where model like '%$searchTerm%' or 
						year like '%$searchTerm%' or 
						price like '%$searchTerm%' or 
						brand like '%$searchTerm%' or 
						engine like '%$searchTerm%' or 
						transmission like '%$searchTerm%' or 
						drivetrain like '%$searchTerm%' or 
						passenger like '%$searchTerm%' or 
						fuel like '%$searchTerm%' or 
						economy like '%$searchTerm%' or 
						description like '%$searchTerm%'";

    $searchResult = mysqli_query($con, $searchSql) or die(mysqli_error($con));
 		$hasResult = mysqli_num_rows($searchResult);
  }

setlocale(LC_MONETARY, "en_US");
?>

<h2 class="mb-4"><?php echo $searchTitle; ?></h2>


<div class="main-content">
	
	<div class="contents">
		
	

<?php if ($hasResult > 0):?>
	<?php while ($row = mysqli_fetch_array($searchResult)): ?>
	<?php
		$model = $row['model'];
		$price = $row['price'];
		$year = $row['year'];
		$brand = $row['brand'];
		$vid = $row['vid'];
		$fileName = $row['image']
	?>
	


	<section class="border border-3 rounded p-3 display my-4">
			<div class="display-img">
				<img src="<?php echo empty($fileName)? "" : BASE_URL . "thumbs/" . $fileName; ?>" alt="<?php echo $model;?>">
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
				<div  class="suv-button">
					<a href="<?php echo BASE_URL ?>display.php?vid=<?php echo $vid?>" class="suv-button-link">View</a>	
					<a href="<?php echo BASE_URL ?>admin/edit.php?vid=<?php echo $vid?>" class="suv-edit-link">Edit</a>
				</div>
				
				
			</div>
		</section>
	<?php endwhile;?>
<?php else:?>
	<?php if (isset($_POST['submit-search'])): ?>
	<p>No Records found. Please Try agian. </p>
	<?php else:?>
	<p>Please enter an search term to start. </p>
	<?php endif;?>
	<a href="<?php echo BASE_URL ?>index.php" class="btn btn-primary">Home Page</a>
	<a href="<?php echo BASE_URL ?>main.php" class="btn btn-info">SUV Lists</a>
	
<?php endif;?>
	</div>
	
	<div class="widget py-1 widget align-self-start">
		<div>
<form class="d-flex border border-2 rounded" action="<?php echo BASE_URL ?>admin/search.php" method="post">
				<label class="sr-only" for="search">Search</label>
				<input type="search" name="search" placeholder="Search SUVs" class="search-term">
				<button type="submit" name="submit-search" class="search-btn">
					<svg viewBox="0 0 32 32"><path d="M6,13.5A7.5,7.5,0,1,1,13.5,21,7.5,7.5,0,0,1,6,13.5ZM27.72,26.39,21,19.62A9.57,9.57,0,1,0,19.62,21l6.77,6.77a.94.94,0,0,0,.67.28.9.9,0,0,0,.66-.28A.94.94,0,0,0,27.72,26.39Z"></path></svg>
				</button>
			</form>
		<div class="mt-2">
			<a href="<?php echo BASE_URL ?>main.php">Reset All Searches</a>
		</div>	
</div>



<div>

<?php
$titleNew = "";
$genreNew = "";

$newSql = "SELECT * FROM jwa_suv_catalog order by vid desc limit 1";

$newResult = mysqli_query($con, $newSql);
?>
	<p class="h5 mt-3">
		Latest Model
		</p>
<?php while ($new = mysqli_fetch_array($newResult)): ?>
<?php
    $modelNew = $new['model'];
    $yearNew = $new['year'];
    $vidNew = $new['vid'];
    $imgNew = $new['image'];
?>
		<div>
			
      <a href="<?php echo BASE_URL ?>display.php?vid=<?php echo $vidNew ?>" class="d-block mb-4 h-100">
            <img style="height:150px;" class="img-fluid img-thumbnail" src="<?php echo BASE_URL?>thumbsmalls/<?php echo $imgNew ?>" alt="<?php echo $modelNew; ?>">
				<p class="pt-1"><?php echo $modelNew . " " . $yearNew ?></p>
          </a>
</div>
<?php
endwhile; ?>

</div>
					

		
	</div>
	
	


<?php
	include("../includes/footer.php");
?>
