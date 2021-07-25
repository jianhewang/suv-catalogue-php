<?php

include ("includes/header.php");
include ("admin/_functions.php");

$getcount = mysqli_query($con,"SELECT COUNT(*) FROM jwa_blog"); 

$postnum = mysqli_result($getcount,0);

//echo $getcount. " post number ". $postnum;

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

$results = mysqli_query($con, "SELECT bid, jwa_title, jwa_content, jwa_timedate FROM jwa_blog order by jwa_timedate desc $limstring") or die(mysqli_error($con));
?>

  <div class="jumbotron clearfix">
    <h1><?php echo APP_NAME ?></h1>
		<p class="lead pl-1">By Jianhe Wang</p>
  </div>


<?php while($row = mysqli_fetch_array($results)): ?>
<?php 
$title = $row['jwa_title'];
$content = htmlspecialchars($row['jwa_content']);
$time = strtotime($row['jwa_timedate']); 
$bid = $row['bid'];

$content = addEmoticons(makeClickableLinks($content));
$time = date("F j, Y g:i a",$time); 
?>
<div class="bg-light text-dark border border-light rounded px-4 py-3 my-3 d-flex flex-column">
	<p class="align-self-end m-0 text-muted"><?php echo $time?></p>
	<h2><?php echo $title?></h2>
	<p><?php echo nl2br($content)?><p>
</div>	
<?php endwhile;?>

<ul class="pagination">
<?php 
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
?>
</ul>

<?php
include ("includes/footer.php");
?>
