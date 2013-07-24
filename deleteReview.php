<?php

require_once("includes/header.php");
require_once("includes/form.php");
require_once("includes/review.php");
require_once("includes/album.php");
require_once("includes/user.php");

$oForm = new form();
$oUser = new user();
$oUser->load($_SESSION['currentUser']);



if(isset($_POST["submit"])){
	$oForm->data = $_POST;

	//check texarea for 500 characters
	$oForm->checkNumerics("rating");
	$oForm->checkRequired("rating");
	$oForm->checkRequired("review");
	$oForm->checkReview("review");



	if($oForm->valid == true){
		$oReview = new review();

		//$dReviewDate->date = time();

		$oReview->albID = $_GET["albumID"];
		$oReview->rating = $_POST["rating"];
		$oReview->date = date('Y-m-d');
		$oReview->review = $_POST["review"];
		$oReview->useID =$oUser->useID;
		$oReview->active = 1;

		// save review to album
		
		$oReview->save();

		// redirect
		header("Location:browseAlbum.php?albumID=".$_GET["albumID"]); // maybe redirect to album page that you just reviewed
		exit;
	}

}

$oForm->makeInput("rating","Rating (1-5)");
$oForm->makeTextArea("review","Review (500 charatcers max)");
$oForm->makeSubmit("submit","Create");

?>
<div class="formStyle">
	<h1>Review</h1>
	<h2>Enter in your rating</h2>
</div>
<?php 
echo $oForm->html; 

require_once("includes/footer.php");

?>