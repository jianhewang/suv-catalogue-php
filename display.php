<?php
include ("includes/header.php");

$vid = $_GET['vid'];
$sql = "Select * from jwa_suv_catalog where vid = $vid";

$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result)) {
	$vid = ($row['vid']);
	$brand = ($row['brand']);
	$model = ($row['model']);
	$year = ($row['year']);
	$price = ($row['price']);
	$engine = ($row['engine']);
	$transmission = ($row['transmission']);
	$drivetrain = $row['drivetrain'];
	$description = nl2br($row['description']);
	$passenger = ($row['passenger']);
	$fuel = ($row['fuel']);
	$economy = ($row['economy']);
	$fileName = $row['image'];
}


if ($fuel == 'g') {
	$fuelDisplay = "Gasoline";	
}
else if ($fuel == 'd'){
	$fuelDisplay = "Diesel";
}
else if ($fuel == 'e') {
	$fuelDisplay = "Electric";
}

if ($fuel == 'e') {
	$economyDisplay = "N/A";
}
else {
	$economyDisplay = $economy . " L/Km";
}

setlocale(LC_MONETARY, "en_US");
?>

<div>
	<h1><?php echo $model?></h1>
</div>

<div class="detail-image">
	<img src="display/<?php echo $fileName?>" alt="<?php echo $model?>">
	<p>
		<?php echo $description?>
	</p>
</div>

<p class="h4 mt-4">Specifications</p>
<div class="detail-info">
	<ul class="list-group list-group-flush">
		<li class="list-group-item"><b>Model:</b> <?php echo $model?></li>
		<li class="list-group-item"><b>Price:</b> <?php echo money_format("%n", $price)?></li>
		<li class="list-group-item"><b>Year:</b> <?php echo $year?></li>
		<li class="list-group-item"><b>Brand:</b> <?php echo $brand?></li>
		<li class="list-group-item"><b>Passenger:</b> <?php echo $passenger?></li>
	</ul>
	<ul class="list-group list-group-flush">
		<li class="list-group-item"><b>Engine:</b> <?php echo $engine?></li>
		<li class="list-group-item"><b>Transmission:</b> <?php echo $transmission?></li>
		<li class="list-group-item"><b>Drivetrain:</b> <?php echo $drivetrain?></li>
		<li class="list-group-item"><b>Fuel Type:</b> <?php echo $fuelDisplay?></li>
		<li class="list-group-item"><b>Fuel Economy:</b> <?php echo $economyDisplay?></li>
	</ul>
</div>
<div class="mt-5 detail-button">
	<div>
		<a href="<?php echo BASE_URL ?>index.php" class="btn btn-primary">Back to Home</a>
	</div>
	<div>
		<a href="<?php echo BASE_URL ?>main.php" class="btn btn-info">See All SUVs</a>
	</div>
	<div>
		<a href="<?php echo BASE_URL ?>admin/edit.php?vid=<?php echo $vid?>" class="btn btn-secondary">Edit Details</a>
	</div>
</div>
<?php
include ("includes/footer.php");
?>