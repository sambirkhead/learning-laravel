<?php
	require_once("includes/header.php");
	require_once("includes/albumView.php");
	require_once("includes/album.php");
	require_once("includes/user.php");
	require_once("includes/genre.php");
	require_once("includes/artist.php");


	$oAV = new albumView();
	$iCurrentAlbumID = 3;

	if(isset($_GET["albumID"])){
		$iCurrentAlbumID = $_GET["albumID"];	
	}
	$oAlbum = new album();
	$oAlbum->load($iCurrentAlbumID);
	echo $oAV->render($oAlbum);


	//create album object
	//create album view

	//user album view to render album ojbect
	require_once("includes/footer.php");
?> 