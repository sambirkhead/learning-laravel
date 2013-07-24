<?php

require_once("album.php");

class artist{

	private $iArtistID;
	private $sArtistName;
	private $sArtistBio;
	private $aAlbums;

	public function __construct(){
		$this->iArtistID = 0;
		$this->sArtistName = "";
		$this->sArtistBio = "";
		$this->aAlbums = array();

	}

	//this function will load a artist from the database (precondition: artist must exist)
	public function load($iArtistID){
		$oDatabase = new Database();

		$sSQL = "SELECT artistID, artistName, artistBio
				FROM artist
				WHERE artistID = ".$oDatabase->escape_value($iArtistID);

		$oResult = $oDatabase->query($sSQL);
		$aArtists = $oDatabase->fetch_array($oResult);

		//assign array values to artist attributes
		$this->iArtistID = $aArtists["artistID"];
		$this->sArtistName = $aArtists["artistName"];
		$this->sArtistBio = $aArtists["artistBio"];

		//load all albums under artist

		$sSQL = "SELECT albumID
				FROM album
				WHERE artistID = ".$oDatabase->escape_value($iArtistID);

		$oResult = $oDatabase->query($sSQL);

		//for each albumID under the artist, create a new album object
		while($aRow = $oDatabase->fetch_array($oResult)){
			$oAlbum = new album();
			$oAlbum->load($aRow["albumID"]);
			$this->aAlbums[] = $oAlbum; // add album object into array
		}
		$oDatabase->close();
	}
	public function __get($sProperty){
		switch($sProperty){
			case "artID":
				return $this->iArtistID;
				break;
			case "name":
				return $this->sArtistName;
				break;
			case "bio":
				return $this->sArtistBio;
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


/*$oArtist = new artist();

$oArtist->load(4);

echo "<pre>";
print_r($oArtist);
echo "</pre>";
*/
?>
