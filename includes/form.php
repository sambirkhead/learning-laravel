<?php 

class form{
	private $sHTML;
	private $aData;
	private $aErrors;
	private $aFiles;

	public function __construct(){
		$this->sHTML = '<form class="formStyle" enctype="multipart/form-data" action="" method="post"><fieldset>';
		$this->aData = array();
		$this->aErrors = array();
		$this->aFiles = array();
	}

	public function makeInput($sControlName,$sLabel){

		$sData = "";
		// if data exists, put it into sData and use it for the value
		if(isset($this->aData[$sControlName])){
			$sData = trim($this->aData[$sControlName]);
		}

		$sErrors = "";
		// if there is an error under this controlname
		if(isset($this->aErrors[$sControlName])){
			$sErrors = $this->aErrors[$sControlName];
		}

		$this->sHTML .= '<label><span>'.$sLabel.'</span><input type="text" name="'.$sControlName.'" value="'.$sData.'" />
			<div class="error">'.$sErrors.'</div></label>';
	}

	public function makePasswordInput($sControlName,$sLabel){

		$sData = "";
		// if data exists, put it into sData and use it for the value
		if(isset($this->aData[$sControlName])){
			$sData = trim($this->aData[$sControlName]);
		}

		$sErrors = "";
		// if there is an error under this controlname
		if(isset($this->aErrors[$sControlName])){
			$sErrors = $this->aErrors[$sControlName];
		}

		$this->sHTML .= '<label for="'.$sControlName.'"><span>'.$sLabel.'</span><input type="password" name="'.$sControlName.'" value="'.$sData.'" />
			<div class="error">'.$sErrors.'</div></label>';
	}

	public function makeConfirmPasswordInput($sControlName,$sLabel){

		$sErrors = "";
		// if there is an error under this controlname
		if(isset($this->aErrors[$sControlName])){
			$sErrors = $this->aErrors[$sControlName];
		}

		$this->sHTML .= '<label for="'.$sControlName.'"><span>'.$sLabel.'</span><input type="password" name="'.$sControlName.'" value="'.$sData.'" />
			<div class="error">'.$sErrors.'</div></label>';
	}

	public function makeTextArea($sControlName,$sLabel){
		$sData = "";
		// if data exists, put it into sData and use it for the value
		if(isset($this->aData[$sControlName])){
			$sData = trim($this->aData[$sControlName]);
		}

		$sErrors = "";
		// if there is an error under this controlname
		if(isset($this->aErrors[$sControlName])){
			$sErrors = $this->aErrors[$sControlName];
		}

		$this->sHTML .= '<label for="'.$sControlName.'">'.$sLabel.'</label>
		<textarea type="text" name="'.$sControlName.'" col="10" rows="20">'.$sData.'</textarea>
		<div class="error">'.$sErrors.'</div>';
	}

	public function makeSubmit($sControlName,$sLabel){
		$this->sHTML .= '<input class="rateButton" type="submit" name="'.$sControlName.'" value="'.$sLabel.'" />';
	}

	public function checkRequired($sControlName){
		$sData = "";

		// if data has this controlname, trim it
		if(isset($this->aData[$sControlName])){
			$sData = trim($this->aData[$sControlName]);
		}

		// if the trimmed string length is 0, create a new row in the errors array
		if(strlen($sData)==0){
			$this->aErrors[$sControlName] = "* Required";
		}else{
			return true;
		}
	}

	public function checkNumerics($sControlName){
		if($this->checkRequired($sControlName) == true){
			$inputValue = "";

			// trim data
			if(isset($this->aData[$sControlName])){
				$inputValue = trim($this->aData[$sControlName]);
			}

			// check numerics
			if(preg_match("/[^1-5.]/", $inputValue)) { 
				$this->aErrors[$sControlName] = "* Ratings are 1-5 only";
			}
			if(strlen($inputValue) > 1){
   			$this->aErrors[$sControlName] = "* Ratings are 1-5 only";
			}
			

		}
	}

	public function checkReview($sControlName){
		if($this->checkRequired($sControlName) == true){
			$inputValue = "";

			// trim data
			if(isset($this->aData[$sControlName])){
				$inputValue = trim($this->aData[$sControlName]);
			}
		
		}if(strlen($inputValue) > 500){
   			$this->aErrors[$sControlName] = "* Reviews must be 500 characters or less";
		}
	}

	public function checkEmail($sControlName){
		if($this->checkRequired($sControlName) == true){



			$email = "";

			// trim data
			if(isset($this->aData[$sControlName])){
				$email = trim($this->aData[$sControlName]);
			}


			// CHECK EMAIL VALIDATION from http://www.linuxjournal.com/article/9585?page=0,3

			$isValid = true;
			$atIndex = strrpos($email, "@");
			if (is_bool($atIndex) && !$atIndex){
				$isValid = false;
			}else{
				$domain = substr($email, $atIndex+1);
				$local = substr($email, 0, $atIndex);
				$localLen = strlen($local);
				$domainLen = strlen($domain);
				if ($localLen < 1 || $localLen > 64){
					// local part length exceeded
					$isValid = false;
				}else if ($domainLen < 1 || $domainLen > 255){
					// domain part length exceeded
					$isValid = false;
				}else if ($local[0] == '.' || $local[$localLen-1] == '.'){
					// local part starts or ends with '.'
					$isValid = false;
				}else if (preg_match('/\\.\\./', $local)){
					// local part has two consecutive dots
					$isValid = false;
				}else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)){
					// character not valid in domain part
					$isValid = false;
				}else if (preg_match('/\\.\\./', $domain)){
					// domain part has two consecutive dots
					$isValid = false;
				}else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))){
					// character not valid in local part unless 
					// local part is quoted
					if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))){
						$isValid = false;
					}
				}
				if ($isValid && !(checkdnsrr($domain,"MX"))){ // changed from if ($isValid && !(checkdnsrr($domain,"MX") || ↪checkdnsrr($domain,"A"))){
					// domain not found in DNS
					$isValid = false;
				}
			}

			// return $isValid; if you want to return the value

			if($isValid == false){
				$this->aErrors[$sControlName] = "* Please use valid email";
			}



		}
	}

	public function checkConfirmPassword($sControlName1,$sControlName2){
		if($this->checkRequired($sControlName1) == true){
			$sPassword1 = "";
			$sPassword2 = "";

			// trim data
			if(isset($this->aData[$sControlName1])){
				$sPassword1 = trim($this->aData[$sControlName1]);
			}
			// trim data
			if(isset($this->aData[$sControlName2])){
				$sPassword2 = trim($this->aData[$sControlName2]);
			}

			if($sPassword1 !== $sPassword2){
				$this->aErrors[$sControlName2] = "* Passwords do not match";
			}
		}

	}

	public function checkName($sControlName){

		if($this->checkRequired($sControlName) == true){
			$sName = "";
			// trim data
			if(isset($this->aData[$sControlName])){
				$sName = trim($this->aData[$sControlName]);
			}

			if(!preg_match("/^[\p{L}\p{P}\p{Zs}]+$/", $sName)) { 
				$this->aErrors[$sControlName] = "* Please use alphabetics";
			}

		}

	}

	public function raiseCustomErrors($sControlName,$sErrorMessage){
		// put error into array if there is an error
		$this->aErrors[$sControlName] = $sErrorMessage;
	}

	// --- FILE UPLOAD STUFF --- //

	public function makeFileUpload($sControlName,$sLabel){
		$sErrors = "";
		// if there is an error under this controlname
		if(isset($this->aErrors[$sControlName])){
			$sErrors = $this->aErrors[$sControlName];
		}

		$this->sHTML .= '<label for"'.$sLabel.'">'.$sLabel.'</label>
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<input name="'.$sControlName.'" type="file" />
			<div class="error">'.$sErrors.'</div>';
	}

	public function checkImageUpload($sControlName){
		$sError = "";

		$aFile = $this->aFiles[$sControlName]; // initialise a row in the $this->aFiles array for this file

		if((!empty($aFile)) && ($aFile['error'] == 0)){
		  //Check if the file is JPEG image and it's size is less than 350Kb
		  $sFileName = basename($aFile['name']);
		  $ext = substr($sFileName, strrpos($sFileName, '.') + 1);
		  if (($ext == "jpg") && ($aFile["type"] == "image/jpeg") && 
			($aFile["size"] < 35000000)) {
		    // if thats fine then do nothing/carry on
		  } else {
		     $sError = "Error: Only .jpg images under 350Kb are accepted for upload";
		  }
		} else {
		 $sError = "Error: No file uploaded";
		}

		if($sError != ""){
			$this->aErrors[$sControlName] = $sError;
		}

	}

	public function moveFile($sControlName,$sNewName){

		$aFile = $this->aFiles[$sControlName];
		//Determine the path to which we want to save this file
		$sNewName = dirname(__FILE__).'/../assets/images/'.$sNewName;
		//Move the uploaded file to it's new place
		move_uploaded_file($aFile['tmp_name'],$sNewName);
	}

	public function getPhotoName($sControlName){
		$aFile = $this->aFiles[$sControlName];
		return time().$aFile['name'];
	}

	// --- GETTER SETTER STUFF --- //

	public function __get($sProperty){
		switch($sProperty){
			case "html":
				return $this->sHTML.'</fieldset></form>';
				break;
			case "valid":
				if(count($this->aErrors) == 0){
					return true;
				}else{
					return false;
				}
				break;
			default:
				die($sProperty." is not allowed to be read from");
		}
	}

	public function __set($sProperty,$value){
		switch($sProperty){
			case "data": // data from post array entered into $this->aData array
				$this->aData = $value;
				break;
			case 'files':
				$this->aFiles = $value;
				break;
			default:
				die($sProperty." is not allowed to write to");
		}
	}
}


?>