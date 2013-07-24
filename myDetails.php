<?php
require_once("includes/header.php");
require_once("includes/UserView.php");
require_once("includes/user.php");

// if user isn't logged on
if(!isset($_SESSION['currentUser'])){
	// redirect
	header("Location:login.php");
	exit;
}

$oUV = new userView();
$oUser = new user();
$oUser->load($_SESSION['currentUser']);
?>

<div class="formStyle">
	<h1>My Details</h1>
	<h2>Your own Record Rater bio page </h2>
</div>

<?php echo $oUV->render($oUser); ?>

<div class="formStyle">
	<p><a class="rateButton" href="editDetails.php">Edit my details</a></p>
</div>

<?php
require_once("includes/footer.php");
?>