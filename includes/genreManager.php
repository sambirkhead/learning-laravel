<?php
require_once("db.php");
require_once("album.php");
require_once("genre.php");

class genreManager{
	//no attriblutes

	//function to produce an array of all genres and albums

	public function getAllGenres(){
		$oDatabase = new Database();

		$sSQL = "SELECT genreID 
				FROM genre";
		$oResult = $oDatabase->query($sSQL);

		//create an array containing all product types
		$aAllGenres = array();

		while($aRow = $oDatabase->fetch_array($oResult)){
			$oGenre = new genre();
			$oGenre->load($aRow["genreID"]);
			$aAllGenres[] = $oGenre; // adds producttype objects (and product objects) to an array
		}
		$oDatabase->close();

		return $aAllGenres;
	}
}

// --- TESTING --- //

/*$oGM = new genreManager();

echo "<pre>";
print_r($oGM->getAllGenres());
echo "</pre>";
*/
?>