<?php
require_once("includes/header.php");
require_once("includes/form.php");
require_once("includes/user.php");
?>

<div class="formStyle">
	<h1>Register</h1>
	<h2>Become a Record Rater for free</h2>
</div>
   
<?php
$oForm = new form();

	if(isset($_POST["submit"])){
		$oForm->data = $_POST;
		$oForm->checkRequired("firstName");
		$oForm->checkRequired("lastName");
		$oForm->checkRequired("password");
		$oForm->checkEmail("email");
		$oForm->checkConfirmPassword("password","confirmPassword");
		$oForm->checkName("firstName");
		$oForm->checkName("lastName");

		// check email is unique
		$oTestUser = new user(); // create a temporary customer that has that email, checks against
		$bResult = $oTestUser->loadByEmail($_POST["email"]); // customer exists = true, customer doesnt = false
		if($bResult == true){ // if customer exists 
			$oForm->raiseCustomErrors("email","* Email already taken"); // raise an error for that control
		}

		if($oForm->valid == true){ // if theres no errors
			$oUser = new user(); // create new customer

			$oUser->firstName = $_POST["firstName"];
			$oUser->lastName = $_POST["lastName"];
			$oUser->email = $_POST["email"];
			$oUser->password = $_POST["password"];
			$oUser->save();

			// redirect
			header("Location:login.php"); // tweak the output_buffering in php.ini
			exit;
		}

	}

//session to be added!
$oForm->makeInput("firstName","First Name");
$oForm->makeInput("lastName","Last Name");
$oForm->makeInput("email","Email");
$oForm->makePasswordInput("password","Password");
$oForm->makeConfirmPasswordInput("confirmPassword","Confirm Password");
$oForm->makeSubmit("submit","Register");

echo $oForm->html;
?>

<div class="formStyle">
	<p><a href="login.php">Already a member? Login now</a></p>
</div>

<?php
require_once("includes/footer.php");
?>

