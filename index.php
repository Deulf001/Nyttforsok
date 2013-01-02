<META charset="utf-8">
<?php
session_start();

include 'connect.php';
include 'header.php';
require 'script/facebook-php-sdk-master/src/facebook.php'; //läser in facebook SDKn

// skapar en ny facebook app instans. och appid och säkerhetskoden skrivs in i en array
$facebook = new Facebook(array(
  'appId'  => '308386372606160',
  'secret' => 'e3fb9e5197f4b4780ab54180befb51dc',
  'cookie' => true
));

// Hämtar användar ID
$user = $facebook->getUser();

// Om man har en användare som har tillåtit appen, fortsätt med detta:
if ($user) {
  try {
    $fbuid = $facebook->getUser();
     $user_profile = $facebook->api('/me');
	 } 
	 
	 catch (FacebookApiException $e) {
       error_log($e);
       $user = null;
       }
         }else{
       header('Location: index.php');
		//om en användare har blivit inloggad med facebook. Lägg till den nya användaren i databasen.
        }
          $query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'facebook' AND     oauth_uid = ". $user_profile['id']);  
          $result = mysql_fetch_array($query);  

        if(empty($result)){ 
          $query = mysql_query("INSERT INTO users (email, date, oauth_provider, oauth_uid, name)         VALUES ('{$user_profile['email']}', NOW(), 'facebook', {$user_profile['id']}, '{$user_profile['name']}')");
          $query = mysql_query("SELECT * FROM users WHERE id = " . mysql_insert_id());  
          $result = mysql_fetch_array($query);  
           }  



       // Login or logout url will be needed depending on current user state.
        if ($user_profile) {
         $paramsout = array('next'=>'http://www.mywebsite.com/test/logout.php');
         $logoutUrl = $facebook->getLogoutUrl($paramsout);
         }

$sql = "SELECT
			categories.id,
			categories.name,
			categories.description,
			COUNT(topics.id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.id = categories.id
		GROUP BY
			categories.name, categories.description, categories.id";

		$stmt = $db->prepare($sql);
		$stmt->execute(array('topic')); //$_POST['topic'],
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if($stmt->rowCount() == 0) 
	{
		echo 'Ingen kategori vald än.';
	}
	else
	{
		//prepare the table
		echo '<table border="1">
			  <tr>
				<th>Category</th>
				<th>Last topic</th>
			  </tr>';	
			
		foreach($rows AS $row)
		{				
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<h3><a href="category.php?id=' . $row['id'] . '">' . $row['name'] . '</a></h3>' . $row['description'];
				echo '</td>';
				echo '<td class="rightpart">';
				
				//fetch last topic for each cat
					$topicsql = "SELECT id, subject, date, cat 
								FROM topics
								WHERE cat = " . $row['id'] . "
								ORDER BY date DESC
								LIMIT 1";			
								
					$stmt = $db->prepare($topicsql);
					$stmt->execute(array('cat')); //$_POST
					$topicrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
						if($stmt->rowCount() == 0) 
						{
							echo 'no topic';
						}
						else
						{
							foreach($topicrows AS $topicrow)
							echo '<a href="topic.php?id=' . $topicrow['id'] . '">' . $topicrow['subject'] . '</a> at ' . date('d-m-Y', strtotime($topicrow['date']));
						}
					}
				echo '</td>';
			echo '</tr>';
		}
	

include 'footer.php';
?>