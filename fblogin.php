<?php

require_once("script/facebook-php-sdk-master/src/facebook.php");
	
	$config = array();
	$config['appId'] = '308386372606160';
	$config['secret'] = 'e3fb9e5197f4b4780ab54180befb51dc';
	$config['fileUpload'] = false; // optional
	
	$facebook = new Facebook($config);
	
	$uid =$facebook -> getUser();
	if (!$uid) {
		$params = array (
		'scope'=> 'read_stream, friends_likes, user_about_me, user_checkins,
		user_likes, friends_status, email'
		);
		echo "<a href='" . $facebook->getLoginUrl($params)
		. "'><img src='pics/facebookconnect.png' > </a>";
		
	}
	
	else {
		$user_profile = $facebook-> api('/me', 'GET');
	}
	
	

?>