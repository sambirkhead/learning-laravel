<?php

require_once("album.php");

class genre{
	private $iGenreID;
	private $sGenreName;
	private $aAlbums;

	public function __construct(){
		$this->iGenreID = 0;
		$this->sGenreName = "";
		$this->aAlbums = array();
	}	

	// this function will load a genre from database to php (precondtion: genre id must exist)
	public function load($iGenreID){
		$oDatabase = new Database();

		$sSQL = "SELECT genreID, genreName
				FROM genre
				WHERE genreID = ".$oDatabase->escape_value($iGenreID);

		$oResult = $oDatabase->query($sSQL);
		$aGenres = $oDatabase->fetch_array($oResult);

		// assign array values tp genres attributes 

		$this->iGenreID = $aGenres["genreID"];
		$this->sGenreName = $aGenres["genreName"];

		//load all albums under the genre

		$sSQL = "SELECT albumID
				FROM album
				WHERE genreID = ".$oDatabase->escape_value($iGenreID);

		$oResult = $oDatabase->query($sSQL);

		// for each albumID under the Genre, create a new album object
		while($aRow = $oDatabase->fetch_array($oResult)){
			$oAlbum = new album();
			$oAlbum->load($aRow["albumID"]);
			$this->aAlbums[] = $oAlbum; // add album object into array
		}
		$oDatabase->close();
	}

	public function __get($sProperty){
		switch($sProperty){
			case "genID":
				return $this->iGenreID;
				break;
			case "name":
				return $this->sGenreName;
				break;
			case "albums":
				return $this->aAlbums;
				break;
			default: 
				die($sProperty." cannot read from");
		}
	}
}

// --- TESTING --- //


/*$oGenre = new genre();

$oGenre->load(4);

echo "<pre>";
print_r($oGenre);
echo "</pre>";*/

?>
