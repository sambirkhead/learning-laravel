<?php
require_once("includes/header.php");
require_once("includes/form.php");
require_once("includes/user.php");

$oForm = new form();
$oUser = new user();
$oUser->load($_SESSION['currentUser']);

$aData = array();
$aData["firstName"] = $oUser->firstName;
$aData["lastName"] = $oUser->lastName;
$aData["email"] = $oUser->email;

$oForm->data = $aData;

if(isset($_POST["submit"])){
	// update
	$oForm->checkEmail("email");
	$oForm->checkName("firstName");
	$oForm->checkName("lastName");

	if($oForm->valid == true){

		$oUser->firstName = $_POST["firstName"];
		$oUser->lastName = $_POST["lastName"];
		$oUser->email = $_POST["email"];
		

		$oUser->save();

		//redirect
		header("Location:myDetails.php"); // tweak the output_buffering in php.ini
		exit;
	}
}

$oForm->makeInput("firstName","First Name");
$oForm->makeInput("lastName","Last Name");
$oForm->makeInput("email","Email");
$oForm->makeSubmit("submit","Update");

?>
<div class="formStyle">
	<h1>Edit My Details</h1>
	<h2>Change Your record rater info here</h2>
</div>
<?php 
echo $oForm->html; 

require_once("includes/footer.php");
?>