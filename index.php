<META charset="utf-8">
<?php
session_start();

include 'connect.php';
include 'header.php';

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