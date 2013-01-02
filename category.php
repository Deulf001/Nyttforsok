<?php
   include 'connect.php';
   include 'header.php';
   $cat = $_GET['id'];
   
   $sql = "SELECT 
   				name,
   				description
   		   FROM
   		   		categories
   		   WHERE
   		   		categories.id = ?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array('cat'));
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1) {
        	echo 'Denna kategori finns inte.';  
    	}  
    		else 
		{  
        //display category data  
        foreach ($rows as $row) {
            
         
          
            echo '<h2>Topics in ′' . $row['name'] . '′ category</h2>';  
        }  
        //do a query for the topics  
        $sql = "SELECT 
                    id, 
                    subject, 
                    date, 
                    cat 
                FROM 
                    topics 
                WHERE 
                    cat = ?";  
      		$stmt = $db->prepare($sql);
			$stmt->execute(array($cat));
			$catrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($db->lastInsertId('id')) {
                echo 'Det finns inga ämnen i den här kategorin.';  
            }  
            else  
            {  
                //prepare the table  
                echo '<table border="1"> 
                      <tr> 
                        <th>Topic</th> 
                        <th>Created at</th> 
                      </tr>';  
                foreach($catrows AS $row)  
                {  
                    echo '<tr>';  
                        echo '<td class="leftpart">';  
                            echo '<h3><a href="topic.php?id=' . $row['id'] . '">' . $row['subject'] . '</a><h3>';  
                        echo '</td>';  
                        echo '<td class="rightpart">';  
                            echo date('d-m-Y', strtotime($row['date']));  
                        echo '</td>';  
                    echo '</tr>';  
                }  
            }  
        }  
        
include 'footer.php';  
?>