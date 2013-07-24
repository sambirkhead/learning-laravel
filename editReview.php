<?php

require_once("includes/header.php");
require_once("includes/form.php");
require_once("includes/review.php");
require_once("includes/album.php");
require_once("includes/user.php");

$oForm = new form();
$oReview = new review();
$oReview->load($_GET["reviewID"]);

$aData = array();
$aData["rating"] = $oReview->rating;
$aData["review"] = $oReview->review;

$oForm->data = $aData;




if(isset($_POST["submit"])){

	$oForm->checkNumerics("rating");
	$oForm->checkRequired("rating");
	$oForm->checkRequired("review");
	$oForm->checkReview("review");


	if($oForm->valid == true){

		$oReview->rating = $_POST["rating"];
		$oReview->review = $_POST["review"];

		// save review to album
		
		$oReview->save();
		echo "<pre>";
		print_r($oReview);
		echo "</pre>";

		// redirect
		//header("Location:browseAlbum.php?albumID=".$oReview->albID); // maybe redirect to album page that you just reviewed
		//exit;
	}

}

$oForm->makeInput("rating","Rating (1-5)");
$oForm->makeTextArea("review","Review (500 charatcers max)");
$oForm->makeSubmit("submit","Edit");

?>
<div class="formStyle">
	<h1>Edit Review</h1>
	<h2>What would you like to change?</h2>
</div>
<?php 
echo $oForm->html; 

require_once("includes/footer.php");

?>