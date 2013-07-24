<?php

require_once("review.php");

class user{

	private $iUserID;
	private $sFirstName;
	private $sLastName;
	private $sEmail;
	private $sPassword;
	private $iAdminStatus;
	private $aReviews;

	public function __construct(){
		$this->iUserID = 0;
		$this->sFirstName = "";
		$this->sLastName = "";
		$this->sEmail = "";
		$this->sPassword = "";
		$this->iAdminStatus = 0;
		$this->aReviews = array();
	}

	//this function will load a user from the database (precondition: user must  exist)
	public function load($iUserID){
		$oDatabase = new Database();

		$sSQL = "SELECT userID, firstName, lastName, email, password, adminStatus
				FROM user
				WHERE userID =".$oDatabase->escape_value($iUserID);

		$oResult = $oDatabase->query($sSQL);
		$aUsers = $oDatabase->fetch_array($oResult);

		//assign array values to user attributes
		$this->iUserID = $aUsers["userID"];
		$this->sFirstName = $aUsers["firstName"];
		$this->sLastName = $aUsers["lastName"];
		$this->sEmail = $aUsers["email"];
		$this->sPassword = $aUsers["password"];
		$this->iAdminStatus = $aUsers["adminStatus"];

		//load all reviews under user
		$sSQL = "SELECT reviewID
				FROM review
				WHERE userID = ".$oDatabase->escape_value($iUserID);

		$oResult = $oDatabase->query($sSQL);

		//for each reviewid under the user, create a new review object
		while($aRow = $oDatabase->fetch_array($oResult)){
			$oReview = new review();
			$oReview->load($aRow["reviewID"]);
			$this->aReviews[] = $oReview; // add review object into array
		}

		$oDatabase->close();
	}

	public function loadByEmail($sEmail){
			$oDatabase = new Database();
			$sSQL = "SELECT userID, email
					FROM user
					WHERE email = '".$oDatabase->escape_value($sEmail)."'";
			$bResult = $oDatabase->query($sSQL);
			$aArray = $oDatabase->fetch_array($bResult);
			$oDatabase->close();

			if($aArray == false){
				return false;
			}else{
				$this->load($aArray["userID"]);
				return true;
			}		
	}
	public function save(){
		$oDatabase = new Database();

		if($this->iUserID == 0){

			$sSQL = "INSERT INTO user (firstName, lastName, email, password)
			VALUES ('".$oDatabase->escape_value($this->sFirstName)."',
				'".$oDatabase->escape_value($this->sLastName)."',
				'".$oDatabase->escape_value($this->sEmail)."',
				'".$oDatabase->escape_value($this->sPassword)."')";
		
			// check if data is accepted into database
			$bResult = $oDatabase->query($sSQL);
			if($bResult == true){
				$this->iUserID = $oDatabase->get_insert_id(); // insert ID from db into object
			}else{
				die($sSQL." has failed");
			}

		}else{
			//update
				$sSQL = "UPDATE user
					SET firstName = '".$oDatabase->escape_value($this->sFirstName)."',
						lastName = '".$oDatabase->escape_value($this->sLastName)."',
						email = '".$oDatabase->escape_value($this->sEmail)."'
					WHERE userID = ".$oDatabase->escape_value($this->iUserID);

					$bResult = $oDatabase->query($sSQL);
					if($bResult == false){
						die($sSQL." has failed");
					}
		}

		$oDatabase->close();

	}

	public function __get($sProperty){
		switch($sProperty){
			case "useID":
				return $this->iUserID;
				break;
			case "firstName":
				return $this->sFirstName;
				break;
			case "lastName":
				return $this->sLastName;
				break;
			case "email":
				return $this->sEmail;
				break;
			case "password":
				return $this->sPassword;
				break;
			case "reviews":
				return $this->aReviews;
				break;
			case "admin":
				return $this->iAdminStatus;
				break;
			default: 
				die($sProperty." cannot read from");
		}
	}
	public function __set($sProperty,$value){

		switch($sProperty){
			case "firstName":
				$this->sFirstName = $value;
				break;
			case "lastName":
				$this->sLastName = $value;
				break;
			case "email":
				$this->sEmail = $value;
				break;
			case "password":
				$this->sPassword = $value;
				break;
			default:
				die($sProperty." is not allowed to write to");
		}

	}

}


// --- TESTING --- //

/*$oUser = new user();

$oUser->load(2);

echo "<pre>";
print_r($oUser);
echo "</pre>";
*/

// $oCustomer = new user();
// $oCustomer->firstName = "jack";
// $oCustomer->lastName = "asd";
// $oCustomer->email = "jack@gmail.com";
// $oCustomer->password = "12345";

// $oCustomer->save();

// echo "<pre>";
// print_r($oCustomer);
// echo "</pre>";

?>
