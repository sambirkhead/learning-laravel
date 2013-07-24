<?php

class albumView{
	public function render($oAlbum){

		$sHTML = '';
		$aReviews = $oAlbum->reviews;
		
		if(count($aReviews) > 0){

			for($iCount=0;$iCount<count($aReviews);$iCount++){
				$oCurrentReview = $aReviews[$iCount];
				$iTotal += $oCurrentReview->rating;
			}

			$iTotal = $iTotal/count($aReviews);
			$iTotal = round($iTotal, 0);
		}

		//album section----------------------------------------------
		$oCurrentArtist = new artist();
		$oCurrentArtist->load($oAlbum->artID);
		$oCurrentGenre = new genre();
		$oCurrentGenre->load($oAlbum->genID);
		$sHTML .= '<div id="albumDetails">
					<img class="ratingPic" src="assets/images/ratingMeter'.$iTotal.'.png"/>
					<img class="albumImage2" src="assets/images/'.$oAlbum->picture.'"/>
					<h3 class="ContentTitle">'.$oCurrentArtist->name.'</h3>
					<p>'.$oAlbum->name.'<br>Released: '.$oAlbum->date.'<br>Genre: '.$oCurrentGenre->name.'</p>
					<hr>
					<p>Bio: '.$oAlbum->desc.'</p>
					</div>';


		//review section----------------------------------------------

	$sHTML .= '<div class="reviewName">REVIEWS</div>';


		$aReviews = $oAlbum->reviews;

		for($iCount=0;$iCount<count($aReviews);$iCount++){
			$oCurrentReview = $aReviews[$iCount];

			$oAuthor = new User();
			$oAuthor->load($oCurrentReview->useID);

		
			if ($iCount % 2 == 0) {
				$sClass = "reviewStyle";

			}else{
				$sClass = "reviewStyle2";
			}

			$sHTML .= '<div class="'.$sClass.'"><p class="raterName">'.$oAuthor->firstName.'</p>
						<p class="rating">('.$oCurrentReview->rating.'/5)</p>
						<p class="date">'.$oCurrentReview->date.'</p>
						<p class="text">'.$oCurrentReview->review.'</p>
						<a class="edit" href="deleteReview.php?reviewID='.$oCurrentReview->revID.'">delete</a><a class="edit" href="editReview.php?reviewID='.$oCurrentReview->revID.'">edit</a></div>';	

		}

		$sHTML .= '<a id="rateButton" href="addReview.php?albumID='.$oAlbum->albID.'">RATE THIS RECORD</a>';
		return $sHTML;
	}
}
	
?>