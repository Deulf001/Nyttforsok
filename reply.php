<META charset="utf-8">
<?php
session_start();

include 'connect.php';  
include 'header.php'; 
$users = $_GET['id'];
$topics = $_SESSION['id'];
$content = $_POST['reply-content'];
if($_SERVER['REQUEST_METHOD'] != 'POST')  
{  
    //someone is calling the file directly, which we don't want  
    echo 'This file cannot be called directly.'; 
} 
else 
{ 
    //kolla om inloggad 
    if($_SESSION['signed_in'] == false) 
    { 
        echo 'You must be signed in to post a reply.'; 
    } 
    else 
    {
      
        //a real user posted a real reply 
        $sql = "INSERT INTO 
                    posts(content, 
                          date,
                          user_id, 
                          topic_id) 
                VALUES (:contentid, 
                        NOW(), 
                        :user_id,
                        :topic_id"; 
       		$stmt = $db->prepare($sql);
			$stmt->execute(array(':contentid' => $content, ':user_id' => $topics, 'topic_id' => $content));
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1) 
			{
            echo 'Din kommentar har inte blivit sparad, försök senare.'; 
        } 
        else 
        { 
            echo 'Din kommentar har blivit sparad, titta på <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.'; 
        } 
    } 
} 
include 'footer.php';  
?>