
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
			
      <a href="display.php?vid=<?php echo $vidNew ?>" class="d-block mb-4 h-100">
            <img style="height:150px;" class="img-fluid img-thumbnail" src="thumbsmalls/<?php echo $imgNew ?>" alt="<?php echo $modelNew; ?>">
				<p class="pt-1"><?php echo $modelNew . " " . $yearNew ?></p>
          </a>
</div>
<?php
endwhile; ?>

</div>
					
<div>
			<?php
$titleRnd = "";
$genreRnd = "";

$rndSql = "SELECT * FROM jwa_suv_catalog order by rand() limit 1";

?>
	<p class="h5 mt-3">Quick Browse</p>
	<?php
$rndResult = mysqli_query($con, $rndSql);

while ($rnd = mysqli_fetch_array($rndResult))
{
    $modelRnd = $rnd['model'];
    $yearRnd = $rnd['year'];

    echo "<a href=\"main.php?displayby=model&displayvalue=" . urlencode($modelRnd) . "\">$modelRnd $yearRnd</a>";
}
?>

</div>			

		


	

	
	
	<div class="mt-3">
		<p class="h5">Make</p>
	
<?php
$brandSql = "SELECT * FROM jwa_suv_catalog group by brand";

$brandResult = mysqli_query($con, $brandSql);

?>
			
	<select class="custom-select" name="entryselect" id="entryselect" onchange="go()" >
			<option value="main.php">- Select a Make -</option>
			<?php while ($record = mysqli_fetch_array($brandResult)): ?>
					<?php
    $brandDisplay = $record['brand'];

?>
					<?php if ($_GET['displayvalue'] == $brandDisplay): ?>
						<option value="main.php?displayby=brand&displayvalue=<?php echo urlencode($brandDisplay); ?>" selected><?php echo $brandDisplay; ?></option>
					<?php
    else: ?>
						<option value="main.php?displayby=brand&displayvalue=<?php echo urlencode($brandDisplay); ?>"><?php echo $brandDisplay; ?></option>
					<?php
    endif; ?>
				<?php
endwhile; ?>	
		</select>
		
	</div>
	
	<div class="my-3">
		
		<p class="h5">Price Range</p>
	<ul class="price">
		<li><a href="main.php?displayby=price&minvalue=1&maxvalue=20000">Under $20,000</a></li>
		<li><a href="main.php?displayby=price&minvalue=20000&maxvalue=30000">$20,000 - $30,000</a></li>
		<li><a href="main.php?displayby=price&minvalue=30000&maxvalue=40000">$30,000 - $40,000</a></li>
		<li><a href="main.php?displayby=price&minvalue=40000&maxvalue=50000">$40,000 - $50,000</a></li>
		<li><a href="main.php?displayby=price&minvalue=50000&maxvalue=60000">$50,000 - $60,000</a></li>
		<li><a href="main.php?displayby=price&minvalue=60000&maxvalue=80000">$60,000 - $80,000</a></li>
		<li><a href="main.php?displayby=price&minvalue=80000&maxvalue=100000">$80,000 - $100,000</a></li>
		<li><a href="main.php?displayby=price&minvalue=100000&maxvalue=300000000">$100,000 or higher</a></li>
	</ul>
		
		
	</div>
			
			

	
		
	</div>
	<!-- End of widget	 -->
