<?php
include ("_functions.php");
define('KB', 1024);
define('MB', 1048576);


if (isset($_POST['submit']))
{

    $originalsFolder = "../originals/"; // directory in which we will move uploaded files to
    $thumbsFolder = "../thumbs/"; // directory in which we store created thumbnail images
		$thumbSmallsFolder = "../thumbsmalls/";
    $displayFolder = "../display/"; // directory in which we store created display size images
    $boolValidateOK = 1;

    
		$model = trim($_POST['model']);
		$year = trim($_POST['year']);
		$price = trim($_POST['price']);
		$brand = trim($_POST['brand']);
		$engine = trim($_POST['engine']);
		$transmission = trim($_POST['transmission']);
		$drivetrain = trim($_POST['drivetrain']);
		$passenger = trim($_POST['passenger']);
		$fuel = trim($_POST['fuel']);
		$economy = trim($_POST['economy']);
    $desc = trim($_POST['desc']);

		// brand
		if (empty($brand)) 
		{
			$brandMsg = "Make is required.";
			$boolValidateOK = 0;
		}
		
		// model
    if (empty($model))
    {
        $modelMsg = "Model is required.";
        $boolValidateOK = 0;
    }
    elseif (strlen($model) < 3 || strlen($model) > 80)
    {
        $modelMsg = "Model value must be between 3 and 80 characters.";
        $boolValidateOK = 0;
    }
		
		// year
		if (empty($year)) 
		{
			$yearMsg = "Year is required.";
			$boolValidateOK = 0;
		}
		
		// price
		if (empty($price)) 
		{
			$priceMsg = "Price is required.";
			$boolValidateOK = 0;
		}
		elseif ($price <= 0)
		{
			$priceMsg = "Price must be greater than 0.";
			$boolValidateOK = 0;
		}
		elseif ($price > 9999999) {
			$priceMsg = "Price value is too large.";
			$boolValidateOK = 0;
		}
		
		// engine
		if (empty($engine))
    {
        $engineMsg = "Engine is required.";
        $boolValidateOK = 0;
    }
    elseif (strlen($engine) < 3 || strlen($engine) > 80)
    {
        $engineMsg = "Engine value must be between 3 and 80 characters.";
        $boolValidateOK = 0;
    }
		
		// transmission
		if (empty($transmission))
    {
        $transmissionMsg = "Transmission is required.";
        $boolValidateOK = 0;
    }
    elseif (strlen($transmission) < 3 || strlen($transmission) > 80)
    {
        $transmissionMsg = "Transmission value must be between 3 and 80 characters.";
        $boolValidateOK = 0;
    }
		
		// passenger 
		if (empty($passenger))
		{
			$passengerMsg = "Passenger number is required";
		}
		elseif ($passenger <= 0)
		{
			$passengerMsg = "Passenger number must be greater than 0.";
			$boolValidateOK = 0;
		}
		elseif ($passenger > 20) {
			$passengerMsg = "Passenger number is too large.";
			$boolValidateOK = 0;
		}
	
		// drivetrain
		if (empty($drivetrain)) 
		{
			$drivetrainMsg = "Year is required.";
			$boolValidateOK = 0;
		}
	
		// fuel
		if (empty($fuel)) 
		{
			$fuelMsg = "Fuel Type is required.";	
			$boolValidateOK = 0;
		}
	
		// fuel economy
		if (empty($economy) && $economy != 0) 
		{
			$economyMsg = "Fuel Economy is required.";
			$boolValidateOK = 0;
		}
		elseif ($economy < 0)
		{
			$economyMsg = "Fuel Economy cannot be negative.";
			$boolValidateOK = 0;
		}
		elseif ($economy > 200) {
			$economyMsg = "Fuel Economy value is too large.";
			$boolValidateOK = 0;
		}
	
		//description
    if (empty($desc))
    {
        $descMsg = "Description is required.";
        $boolValidateOK = 0;
    }
    else
    {
        if (strlen($desc) < 5 || strlen($desc) > 500)
        {
            $descMsg = "Description must be between 5 and 500 characters.";
            $boolValidateOK = 0;
        }
    }

    if (($_FILES["file"]["name"] == ""))
    {
        $strValidationMessage .= "Image file is required. <br />";
    }
    else
    {
        if (($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/png"))
        {

        }
        else
        {
            $strValidationMessage .= "Invalid file type. Please upload .jpg or .png image.<br />";

            $boolValidateOK = 0;
        }
    }

    if (($_FILES["file"]["size"] > 4048576))
    {
        
			  $strValidationMessage .= "File cannot be larger than 4 mb. <br />";
        $boolValidateOK = 0;
    }

    if ($_FILES["file"]["error"] > 0)
    {
        //$strValidationMessage .= "An error of type" . $_FILES["file"]["error"] . "occured<br />";
        $boolValidateOK = 0;
    }

    if ($boolValidateOK == 1)
    {
        // create a unique name for each image by uniqueid()
        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = uniqid() . '.' . end($temp);

        move_uploaded_file($_FILES["file"]["tmp_name"], $originalsFolder . $newfilename);

        $thisFile = $originalsFolder . basename($newfilename);
        //createThumbnail( originalFile, destFolder);
        if (($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg"))
        {
            createJPGThumbnail($thisFile, $thumbsFolder, $newfilename, 500);
						createJPGThumbnail($thisFile, $thumbSmallsFolder, $newfilename, 300);
            createJPGThumbnail($thisFile, $displayFolder, $newfilename, 800);

        }
        else if (($_FILES["file"]["type"] == "image/png"))
        {
            createPNGThumbnail($thisFile, $thumbsFolder, $newfilename, 500);
						createPNGThumbnail($thisFile, $thumbSmallsFolder, $newfilename, 300);
            createPNGThumbnail($thisFile, $displayFolder, $newfilename, 800);
        }

        // as well as uploading and creating thumbs, lets put filename in a DB
        // 	 include("../includes/mysql_connect.php");
        $fileName = basename($newfilename);

        mysqli_query($con, "INSERT INTO jwa_suv_catalog (model, year, price, brand, engine, transmission, drivetrain, passenger, fuel, economy, description, image) 
														VALUES ('$model', '$year', '$price', '$brand', '$engine', '$transmission', '$drivetrain', '$passenger', '$fuel', '$economy', '$desc', '$fileName')");

        if (mysqli_error($con))
        {
            $successMsg = "<div class=\"container alert alert-danger col-6 my-4\">";
            $successMsg .= "Upload failed. " . mysqli_error($con);
            $successMsg .= "</div>";
        }
        else
        {
            $successMsg = "<div class=\"container alert alert-success col-6 my-4\">";
            $successMsg .= "New SUV information uploaded successfully. Thank you.";
            $successMsg .= "</div>";
        }

    }

} //end if submit

if (isset($_POST['reset'])) {
	header('Location: '.$_SERVER['PHP_SELF']);  
}


?>
