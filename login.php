<?php
require_once("includes/header.php");
require_once("includes/form.php");
require_once("includes/user.php");
?>

<div class="formStyle">
	<h1>Login</h1>
	<h2>Rate the lastest records today</h2>
</div>

<?php
$oForm = new form();

//session initializ

if(isset($_POST["submit"])){
	$oTestUser = new user();
	$bResult = $oTestUser->loadByEmail($_POST["email"]);
	if($bResult == false){ // if email does not exist in the db
		$oForm->raiseCustomErrors("email","* Email is incorrect");
	}else{ // if email exists
		if($oTestUser->password == $_POST["password"]){ // if passwords match
			
			$_SESSION['currentUser'] = $oTestUser->useID;

			// redirect
			header("Location:myDetails.php");
			exit;

		}else{
			$oForm->raiseCustomErrors("password","* Password is incorrect");
		}
	}
}

$oForm->makeInput("email","Email");
$oForm->makePasswordInput("password","Password");
$oForm->makeSubmit("submit","Login");

echo $oForm->html;
?>

<div class="formStyle">
	<p><a href="register.php">Not already a member? Register now</a></p>
</div>

<?php 
require_once("includes/footer.php");
?>

