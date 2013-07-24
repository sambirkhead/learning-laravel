<?php
	require_once("includes/header.php");
	require_once("includes/genreView.php");
	require_once("includes/genre.php");
	require_once("includes/artist.php");

	$oGV = new genreView();
	$iCurrentGenreID = 0;
	if(isset($_GET["genreID"])){
		$iCurrentGenreID = $_GET["genreID"];
	}
	$oG = new genre();
	$oG->load($iCurrentGenreID);
	///render out genre contents(albums)
	echo $oGV->render($oG);



	require_once("includes/footer.php");
?>