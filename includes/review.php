<?php

require_once("db.php");

class review{
	private $iReviewID;
	private $iUserID;
	private $sReview;
	private $dReviewDate;
	private $iRating;
	private $iAlbumID;
	private $iActive;

	public function __construct(){
		$this->iReviewID = 0;
		$this->iUserID = 0;
		$this->sReview = "";
		$this->dReviewDate = "2013-01-01";
		$this->iRating = 0;
		$this->iAlbumID = 0;
		$this->iActive = 0;
	}

	// this function will load a review from he database to php (precon: review id must exist)

	public function load($iReviewID){
		$oDatabase = new Database();

		$sSQL = "SELECT reviewID, userID, review, reviewDate, rating, albumID, active
				FROM review
				WHERE reviewID =".$oDatabase->escape_value($iReviewID);

		$oResult = $oDatabase->query($sSQL);
		$aReviews = $oDatabase->fetch_array($oResult);

		//assign array results to the review attributes
		$this->iReviewID = $aReviews["reviewID"];
		$this->iUserID = $aReviews["userID"];
		$this->sReview = $aReviews["review"];
		$this->dReviewDate = $aReviews["reviewDate"];
		$this->iRating = $aReviews["rating"];
		$this->iAlbumID = $aReviews["albumID"];
		$this->iActive = $aReviews["active"];

		$oDatabase->close();
	}

	public function save(){
		$oDatabase = new Database();

	if($this->iReviewID == 0){

		$sSQL = "INSERT INTO review (albumID, rating, reviewDate, userID, review, active)
				VALUES ('".$oDatabase->escape_value($this->iAlbumID)."',
					'".$oDatabase->escape_value($this->iRating)."',
					'".$oDatabase->escape_value($this->dReviewDate)."',
					'".$oDatabase->escape_value($this->iUserID)."',
					'".$oDatabase->escape_value($this->iActive)."',
					'".$oDatabase->escape_value($this->sReview)."'
					)";
		$bResult = $oDatabase->query($sSQL);
		if($bResult == true){
			$this->iReviewID = $oDatabase->get_insert_id();
		}else{
			die($sSQL." has failed");
		}
		$oDatabase->close();
	}else{
		// //update
		// 		$sSQL = "UPDATE user
		// 			SET firstName = '".$oDatabase->escape_value($this->sFirstName)."',
		// 				lastName = '".$oDatabase->escape_value($this->sLastName)."',
		// 				email = '".$oDatabase->escape_value($this->sEmail)."'
		// 			WHERE userID = ".$oDatabase->escape_value($this->iUserID);

		// 			$bResult = $oDatabase->query($sSQL);
		// 			if($bResult == false){
		// 				die($sSQL." has failed");
		// 			}
	}

	public function __get($sProperty){
		switch($sProperty){
			case "revID":
				return $this->iReviewID;
				break;
			case "useID":
				return $this->iUserID;
				break;
			case "review":
				return $this->sReview;
				break;
			case "date":
				return $this->dReviewDate;
				break;
			case "rating":
				return $this->iRating;
				break;
			case "albID":
				return $this->iAlbumID;
				break;
			case "active":
				return $this->iActive;
				break;
			default: 
				die($sProperty." cannot read from");
		}
	}

	public function __set($sProperty,$value){
		switch($sProperty){
			case "albID":
				$this->iAlbumID = $value;
				break;
			case "rating":
				$this->iRating = $value;
				break;
			case "date":
				$this->dReviewDate = $value;
				break;
			case "review":
				$this->sReview = $value;
				break;
			case "useID":
				$this->iUserID = $value;
				break;
			case "active":
				$this->iActive = $value;
				break;
			default:
				die($sProperty." is not allowed to write to");	
		}
	}
}


// --- TESTING --- //


/*$oReview = new review();

$oReview->load(4);

echo "<pre>";
print_r($oReview);
echo "</pre>";
*/
?>