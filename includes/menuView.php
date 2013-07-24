<?php
class menuView{
	public function render($aAllGenres){
		$sHTML = '';
		$sHTML .= '<ul id="genreNav">';

		for($iCount=0;$iCount<count($aAllGenres);$iCount++){
			$oCurrentGenre = $aAllGenres[$iCount];

			$sHTML .= '<li>
			<a href="browseGenre.php?genreID='.$oCurrentGenre->genID.'">'.$oCurrentGenre->name.'</a>
			</li>';
		}

		$sHTML .= '</ul>';

		return $sHTML;
	}
}

?>