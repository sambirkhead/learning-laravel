<?php
ob_start();
require_once("menuView.php");
require_once("genreManager.php");
session_start();
require_once("user.php");

$oMV = new menuView();
$oGM = new genreManager();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Record Rater</title>
      <link href="assets/styles.css" rel="stylesheet" type="text/css" />
  </head>

  <body>

<div id="container">


	<div id="header">
		<div id="centreheader">

		<h2 id="logoName"></h2>
		<div id="logo"></div>
		<div id="speech">
		<?php

		if(isset($_SESSION['currentUser'])){
			
			$oUser = new user();
			$oUser->load($_SESSION['currentUser']);
			echo '<h1>"Welcome '.$oUser->firstName.'! to begin rating simply click a genre of music you like..."<h1>';
			}else{
				echo '<h1>"Discuss the newest records socially around the world with RECORD RATER!"</h1>';
			}
		
		?>

		</div>

		<ul id="userNav" class="alignright">
		<?php

		if(isset($_SESSION['currentUser'])){
			
			$oUser = new user();
			$oUser->load($_SESSION['currentUser']);
			echo '<a href="logout.php">(LOG OUT)</a>';
			}else{
				echo '<li id="login"><a href="login.php">LOGIN</a></li>';
			}
		
		?>

			<li id="register">
				<a href="register.php">/ JOIN</a>
			</li>

		</ul>
		

		</div>


	</div>


	<div id="content">
	<div id="mainNav">

	<?php echo $oMV->render($oGM->getAllGenres()); ?>
	
	<ul id="menuNav">

		<li >
			<a href="home.php">Home</a>
		</li>

		<li >
			<a href="myDetails.php">My&nbsp;Details</a>
		</li>

		<li >
			<a href="#">About&nbsp;Us</a>
		</li>
		<li >
			<a href="#">Feedback</a>
		</li>
		<li >
			<a href="#">FAQ</a>
		</li>

	</ul>
	</div>
	<div id="sandBox">