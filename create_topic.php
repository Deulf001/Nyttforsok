<META charset="utf-8">
<?php
session_start();

include 'connect.php';
include 'header.php';
echo '<h2>Skapa topic</h2>';
if(!isset($_SESSION['signed_in']))
{
	echo 'Du mï¿½ste vara inloggad <a href="signin.php">Logga in</a> fï¿½r att skapa en topic.';
}
else
{
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		$sql = "SELECT
					id,
					name,
					description
				FROM
					categories";
		$stmt = $db->prepare($sql);
		$stmt->execute(array('cat')); //$_POST
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 0) 			{
				if($_SESSION['level'] == 1)
				{
					echo 'Du har inga kategorier ï¿½nnu';
				}
				else
				{
					echo 'Innan du postar en topic mï¿½ste admin ha skapat en kategori';
				}
			}
			else
			{
				echo '<form method="post" action="">
					ï¿½mne: <input type="text" name="subject" />
					<br>Kategori:';
				echo '<select name="cat"><br>';
					foreach($rows AS $row)
					{
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
					}
				echo '</select>';
				echo '<br>Meddelande <textarea name="content" /></textarea>
					<input type="submit" value="Skapa topic" />
				 </form>';
			}
		}
	
	else
	{
		
			$sql = "INSERT INTO topics (subject, date, cat)  VALUES (?, NOW(), ?)";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($_POST['subject'],$_POST['cat']));
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);			
				if($db->lastInsertId('id')) 	
				{
					$topicid = $db->lastInsertId('id');
					echo 'Du har skapat en topic <a href="topic.php?id='. $topicid . '">Din nya topic</a>.';
					
				}
				else
				{
					echo 'Nu blev det lite fel med din topic, försök igen';
				}			
			
				/*$sql = "INSERT INTO
							posts(content,
								  date,
								  topic,
								  by)
						VALUES
							('" . mysql_real_escape_string($_POST['content']) . "',
								  NOW(),
								  '" . $topicid . "',
								  '" . $_SESSION['id'] . "')";*/
				/*
				$sql = "INSERT INTO posts (content, date, topic_id)  VALUES (?, NOW(), null"; //PDO fel tillsammans med signup
				$stmt = $db->prepare($sql);
				$stmt->execute(array($_POST['content']));
				$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
				if($db->lastInsertId('id')) 	
				{
					
					echo 'Du har skapat en topic <a href="topic.php?id='. $topicid . '">Din nya topic</a>.';
					
				}
				else
				{
					echo 'Nu blev det lite fel med din topic, försök igen';
				}
				 
				 */
			}
		}
	

include 'footer.php';
?>