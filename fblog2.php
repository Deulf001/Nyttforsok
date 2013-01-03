<?php 

   $app_id = "308386372606160";
   $app_secret = "e3fb9e5197f4b4780ab54180befb51dc";
   $my_url = "http://localhost/php/ma12forum/";

   session_start();

   $code = $_REQUEST["code"];

   if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
     $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'] . "&scope=user_birthday,read_stream";

     echo("<script> top.location.href='" . $dialog_url . "'</script>");
   }
   
   if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
     // state variable matches
   }
   else {
     echo("The state does not match. You may be a victim of CSRF.");
   }
   
   if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;

     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);
   }
   else {
     echo("The state does not match. You may be a victim of CSRF.");
   }
   
   if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;

     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);

     $_SESSION['access_token'] = $params['access_token'];

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
     echo("Hello " . $user->name);
   }
   else {
     echo("The state does not match. You may be a victim of CSRF.");
   }
   
?>