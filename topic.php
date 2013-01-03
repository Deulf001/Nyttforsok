<META charset="utf-8">

<?php  
session_start();
include 'connect.php';  
include 'header.php';  
$topicid = $_GET['id'];

$sql = "SELECT  
    		id,  
            subject  
		FROM  
    		topics  
		WHERE  
    		topics.id = ?";  
			 $stmt = $db->prepare($sql);
			$stmt->execute(array($topicid));
			$topicrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($stmt->rowCount()==0)
			{

        echo 'This category does not exist.';  
    }  
    else  
    {  
        //display category data  
       foreach($topicrows AS $topicrow)  
        {  
            echo '<h2> ' . $topicrow['subject'] . '</h2>';  
        }  
        //do a query for the topics  
        $sql = "SELECT
						posts.topic_id,
						posts.content,
						posts.date,
						posts.user_id,
						users.id,
						users.name
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.user_id = users.id
					WHERE
						posts.topic_id =  ?";  
       		$stmt = $db->prepare($sql);
			$stmt->execute(array($topicid));
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($stmt->rowCount()==0) 
			{
                echo 'There are no topics in this category yet.';  
            }  
            else  
            {

               foreach($rows AS $row)  
                {
                    echo '<p>' . $row['content'] . '</p>';   
                    echo date('d-m-Y', strtotime($row['date'])); 
                }  
				
            }  
        }
			
				echo '<tr><td colspan="2"><h2>Reply:</h2><br />
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
					<textarea name="reply-content"></textarea><br /><br />
					<input type="submit" value="Submit reply" />
					</form></td></tr>';
   
 


include 'footer.php';

?>  