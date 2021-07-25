
<?php
	session_start();

	if(!isset($_SESSION['fXwxF4WQbfE9e7jo7Kjt'])) {
		header("Location:alert.php");
	}

	include("../includes/header.php");
	
	$vid = '';


	if (isset($_GET['vid'])) {
		$vid = $_GET['vid'];
	}
	
	if ($vid != "") {
		$suvSql = "SELECT * From jwa_suv_catalog WHERE vid = '$vid'";
		$results = mysqli_query($con, $suvSql);

		while($row = mysqli_fetch_array($results)){
			$vid = ($row['vid']);
			$brand = ($row['brand']);
			$model = ($row['model']);
			$year = ($row['year']);
			$price = ($row['price']);
			$engine = ($row['engine']);
			$transmission = ($row['transmission']);
			$drivetrain = $row['drivetrain'];
			$desc = nl2br($row['description']);
			$passenger = ($row['passenger']);
			$fuel = ($row['fuel']);
			$economy = ($row['economy']);
			$fileName = $row['image'];

			$_SESSION['file'] = $fileName;
		}		
	}
	
	

 include("validationEdit.php");

 $suvlist = mysqli_query($con, "SELECT * FROM jwa_suv_catalog order by model") or die(mysqli_error($con));
?>




<?php
if (isset($_POST['submit-udpate'])) {
	if (!empty($vidMsg)) {
		echo $vidMsg;
	}
}
?>



<div class="d-flex flex-column  flex-wrap">
	<h1>Edit SUV Information</h1>
<p class="text-muted pl-1">Please choose from the list to edit.</p>
	<div>
		<select class="custom-select mb-4" name="entryselect" id="entryselect" onchange="go()" >
			<option value="edit.php">- Select a SUV -</option>
			<?php foreach ($suvlist as $key => $post): ?>
					<?php if ($post['vid'] == $vid): ?>
						<option value="edit.php?vid=<?php echo $post['vid'] ?>" selected><?php echo $post['model'] ?></option>
					<?php else: ?>
						<option value="edit.php?vid=<?php echo $post['vid'] ?>"><?php echo $post['model'] ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
		</select>
	</div>

	<form name="myForm" class="my-4 flex-grow-1 px-0" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
		<p class="h4">
			Information Details
		</p>
		<input type="hidden" name="vid" value="<?php echo $vid; ?>" >
		<div class="form-row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="brand">Make</label>
            <select class="form-control" name="brand" id="brand">
              <?php
                if ($brand) {
                    echo "<option selected=\"selected\">$brand</option>";
                }
              ?>
              <option value="">-Please select a Make-</option>
              <option>Acura</option>
              <option>Audi</option>
              <option>Alfa Romeo</option>
              <option>BMW</option>
							<option>Buick</option>
							<option>Cadillac</option>
							<option>Chevrolet</option>
							<option>Ford</option>
							<option>GMC</option>
							<option>Honda</option>
							<option>Hyundai</option>
							<option>Infiniti</option>
							<option>Jaguar</option>
							<option>Jeep</option>
							<option>Kia</option>
							<option>Land Rover</option>
							<option>Lexus</option>
							<option>Lincoln</option>
							<option>Mazda</option>
							<option>Mercedes-Benz</option>
							<option>Nissan</option>
							<option>Porsche</option>
							<option>Toyota</option>
							<option>Volkswagen</option>
							<option>Volvo</option>
            </select>
						<?php if (isset($brandMsg)): ?>
              <div class="alert alert-info">
                <?php echo $brandMsg; ?>
              </div>
            <?php endif; ?>
				</div>
				<div class="form-group">
					<label for="model">Model</label>
            <input type="text" class="form-control" name="model" id="model" value="<?php echo $model; ?>">
            <?php if (isset($modelMsg)): ?>
              <div class="alert alert-info">
                <?php echo $modelMsg; ?>
              </div>
            <?php endif; ?>
				</div>
				
				<div class="form-group">
					<label for="year">Year</label>
            <select class="form-control" name="year" id="year">
              <?php
                if ($year) {
                    echo "<option selected=\"selected\">$year</option>";
                }
              ?>
              <option value="">-Please select a year-</option>
              <option>2022</option>
              <option>2021</option>
              <option>2020</option>
              <option>2019</option>
            </select>
						<?php if (isset($yearMsg)): ?>
              <div class="alert alert-info">
                <?php echo $yearMsg; ?>
              </div>
            <?php endif; ?>
				</div>
				<div class="form-group">
					<label for="price">Base Price (CAD$)</label>
            <input type="text" class="form-control" name="price" id="price" value="<?php echo $price; ?>">
            <?php if (isset($priceMsg)): ?>
              <div class="alert alert-info">
                <?php echo $priceMsg; ?>
              </div>
            <?php endif; ?>
				</div>
				<div class="form-group">
					<label for="passenger">Maximum Passenger</label>
            <input type="text" class="form-control" name="passenger" id="passenger" value="<?php echo $passenger; ?>">
            <?php if (isset($passengerMsg)): ?>
              <div class="alert alert-info">
                <?php echo $passengerMsg; ?>
              </div>
            <?php endif; ?>
				</div>
				
				<div class="form-group">
					<div>Fuel Type</div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="fuel" id="gas" value="g" <?php if($fuel == "g") {echo "checked";} ?>>
            <label class="form-check-label" for="gas">
              Gasoline
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="fuel" id="diesel" value="d" <?php if($fuel== "d") {echo "checked";} ?>>
            <label class="form-check-label" for="diesel">
              Diesel
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="fuel" id="electric" value="e" <?php if($fuel== "e") {echo "checked";} ?>>
            <label class="form-check-label" for="electric">
              Electricity
            </label>
          </div>
					<?php if (isset($fuelMsg)): ?>
              <div class="alert alert-info">
                <?php echo $fuelMsg; ?>
              </div>
            <?php endif; ?>
				</div>
				<div class="form-group">
					<label for="economy">Fuel Economy (L/Km)</label>
            <input type="text" class="form-control" name="economy" id="economy" value="<?php echo $economy; ?>">
            <?php if (isset($economyMsg)): ?>
              <div class="alert alert-info">
                <?php echo $economyMsg; ?>
              </div>
            <?php endif; ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="engine">Engine Information</label>
            <input type="text" class="form-control" name="engine" id="engine" value="<?php echo $engine; ?>">
            <?php if (isset($engineMsg)): ?>
              <div class="alert alert-info">
                <?php echo $engineMsg; ?>
              </div>
            <?php endif; ?>
				</div>
				<div class="form-group">
					<label for="transmission">Transmission Information</label>
            <input type="text" class="form-control" name="transmission" id="transmission" value="<?php echo $transmission; ?>">
            <?php if (isset($transmissionMsg)): ?>
              <div class="alert alert-info">
                <?php echo $transmissionMsg; ?>
              </div>
            <?php endif; ?>
				</div>
				<div class="form-group">
					<label for="drivetrain">Drivetrain</label>
            <select class="form-control" name="drivetrain" id="drivetrain">
              <?php
                if ($drivetrain) {
                    echo "<option selected=\"selected\">$drivetrain</option>";
                }
              ?>
              <option value="">-Please select a drivetrain-</option>
              <option>FWD</option>
              <option>RWD</option>
              <option>AWD</option>
              <option>4WD</option>
            </select>
						<?php if (isset($drivetrainMsg)): ?>
              <div class="alert alert-info">
                <?php echo $drivetrainMsg; ?>
              </div>
            <?php endif; ?>
				</div>
				<div class="form-group">
					
				</div>
				<div class="form-group">
					<label for="desc">Description: </label>
					<textarea class="form-control edit" name="desc" id="desc" placeholder="Max 500 characters..."><?php echo $desc; ?></textarea>
					<?php if (isset($descMsg)): ?>
						<div class="alert alert-info">
							<?php echo $descMsg; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="file" class="form-group">Image File: </label>
			<br/>
			<?php if (!empty($vid)): ?>
			<figure>
				<?php if ($updated == 1): ?>
				<img src="../thumbsmalls/<?php echo $fileName;?>" alt="<?php echo $title?>">
				<?php else:?>
				<img src="../thumbsmalls/<?php echo (isset($_SESSION["file"]))?$_SESSION["file"]:$fileName;?>" alt="<?php echo $title?>">
				<?php endif;?>
				<figcaption>(Quick View: Current Image)</figcaption>
			</figure>
			<?php endif;?>
			<input type="file" name="file" id="file"/>
			<?php if (isset($strValidationMessage)): ?>
				<div class="alert alert-info">
					<?php echo $strValidationMessage; ?>
				</div>
			<?php endif; ?>
		</div>
		
		<a href="<?php echo BASE_URL ?>display.php?vid=<?php echo $vid?>" class="btn btn-info">Cancel</a>
		<button type="submit" class="btn btn-primary my-3" name="submit-update">Update</button>
		<button type="submit" class="btn btn-danger my-3" name="submit-delete" onclick="return confirm('Do you want to delete <?php echo $model; ?>?')">Delete</button>
	</form>
	
</div>
	




<div class="container-sm d-flex justify-content-center px-0"> 
<?php echo $successMsg;?>
</div>

<?php
	include("../includes/footer.php");
?>

