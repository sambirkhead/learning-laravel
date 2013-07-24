<?php
require_once("user.php");

class userView{
//still to be done: ratings getter (how many ratings have you done)
	public function render($oUser){
		$sHTML = '';

		$sHTML .= '<ul class="formStyle" id="details">
						<li>
							<span class="label">First Name</span>
							<span class="detail">'.$oUser->firstName.'</span>
						</li>
						<li>
							<span class="label">Last Name</span>
							<span class="detail">'.$oUser->lastName.'</span>
						</li>
						<li>
							<span class="label">Email Name</span>
							<span class="detail">'.$oUser->email.'</span>
						</li>
						<li>
							<span class="label">Admin status</span>
							<span class="detail">'.$oUser->admin.'</span>
						</li>
						<li>
							<span class="label">Ratings</span>
							<span class="detail">'.count($oUser->reviews).'</span> 
						</li>
					</ul>';

		return $sHTML;
	}

}

?>