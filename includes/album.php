<?php

require_once("db.php");
require_once("review.php");


class album{
	private $iAlbumID;
	private $iGenreID;
	private $iArtistID;
	private $sAlbumName;
	private $dReleaseDate;
	private $sDescription;
	private $sPicture;
	private $aReviews;

	public function __construct(){
		$this->iAlbumID = 0;
		$this->iGenreID = 0;
		$this->iArtistID = 0;
		$this->sAlbumName = "";
		$this->dReleaseDate = "2013-01-01";
		$this->sDescription = "";
		$this->sPicture = "";
		$this->aReviews = array();
	}

	//this function will load a album from the database to php (precon: album id must exist)

	public function load($iAlbumID){
		$oDatabase = new Database();

		$sSQL = "SELECT albumID, genreID, artistID, albumName, releaseDate, description, picture
				FROM album
				WHERE albumID = ".$oDatabase->escape_value($iAlbumID);

		$oResult = $oDatabase->query($sSQL);
		$aAlbums = $oDatabase->fetch_array($oResult);

		// assign array result to the album attributes
		$this->iAlbumID = $aAlbums["albumID"];
		$this->iGenreID = $aAlbums["genreID"];
		$this->iArtistID = $aAlbums["artistID"];
		$this->sAlbumName = $aAlbums["albumName"];
		$this->dReleaseDate = $aAlbums["releaseDate"];
		$this->sDescription = $aAlbums["description"];
		$this->sPicture = $aAlbums["picture"];

		//load all reviews under album
		$sSQL = "SELECT reviewID, active
				FROM review
				WHERE active = 1 AND albumID = ".$oDatabase->escape_value($iAlbumID);
				//active = 1 AND insert into where sql statment
		$oResult = $oDatabase->query($sSQL);

		//for each review id under the album, create a new review object
		while($aRow = $oDatabase->fetch_array($oResult)){
			$oReview = new review();
			$oReview->load($aRow["reviewID"]);
			$this->aReviews[] = $oReview; // add review object into array
		}

		$oDatabase->close();
	}

	public function __get($sProperty){
		switch($sProperty){
			case "albID":
				return $this->iAlbumID;
				break;
			case "genID":
				return $this->iGenreID;
				break;
			case "artID":
				return $this->iArtistID;
				break;
			case "name":
				return $this->sAlbumName;
				break;
			case "date":
				return $this->dReleaseDate;
				break;
			case "desc":
				return $this->sDescription;
				break;
			case "picture":
				return $this->sPicture;
				break;
			case "reviews":
				return $this->aReviews;
				break;
			default: 
				die($sProperty." cannot read from");
		}
	}

}


// --- TESTING --- //

/*$oAlbum = new album();

$oAlbum->load(8);

echo "<pre>";
print_r($oAlbum);
echo "</pre>";
*/
?>