<META charset="utf-8">
<?php
session_start();

include 'connect.php';  
include 'header.php'; 
  
if($_SERVER['REQUEST_METHOD'] == 'POST')  
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
                VALUES ('" . $_POST['reply-content'] . "', 
                        NOW(), 
                        " . mysql_real_escape_string($_GET['id']) . ", 
                        " . $_SESSION['id'] . ")"; 
        $result = mysql_query($sql); 
        if(!$result) 
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