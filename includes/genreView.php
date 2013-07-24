<?php

class genreView{
	public function render($oGenre){
		$sHTML = '';

		$sHTML .= '<div class="genreName">'.$oGenre->name.'</div>';

		$sHTML .= '<ul id="genreContents">';

		for($iCount=0;$iCount<count($oGenre->albums);$iCount++){
			$oCurrentAlbum = $oGenre->albums[$iCount];
			$oCurrentArtist = new artist();
			$oCurrentArtist->load($oCurrentAlbum->artID);
			$sName = (strlen($oCurrentArtist->name) > 18) ? substr($oCurrentArtist->name, 0, 18) . '...' : $oCurrentArtist->name;
			$sHTML .= '<li>
			<a href="browseAlbum.php?albumID='.$oCurrentAlbum->albID.'">
				<img class="albumImage" src="assets/images/'.$oCurrentAlbum->picture.'"/>
				<div class="Contentstyle">
				<h3 class="ContentTitle">'.$sName.'</h3>
			</a><p>'.$oCurrentAlbum->name.'</p></div>
			</li>';
		}

		$sHTML .= '</ul>';
		return $sHTML;

	}

}
?>

