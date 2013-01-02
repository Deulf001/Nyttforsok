<META charset="utf-8">
<?php
session_start();
  include 'connect.php';
  include 'header.php';
  
    echo '<h3>Logga in<h3/>';
    if (isset($_SESSION['signed_in']) && $_SESSION
    ['signed_in'] == TRUE) 
    {
     echo 'Du �r redan inloggad, du kan <a href=
     "signout.php">logga ut</a> om du vill';   
    }
	else 
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			echo '<form method="post" action="">
			Anv�ndarnamn: <input type="text" name="name" />
			L�senord: <input type="password" name="pass">
			<input type="submit" value="Logga in" />
		 </form>';
	}
		else
		{
			$errors = array(); 
		if(!isset($_POST['name']))
		{
			$errors[] = 'Fyll i anv�ndarnamnet.';
		}
		if(!isset($_POST['pass']))
		{
			$errors[] = 'L�senordet �r inte ifyllt';
		}
		if(!empty($errors)) 
		{
			echo 'F�ltet �r inte ifyllda';
			echo '<ul>';
			foreach($errors as $key => $value) 
			{
				echo '<li>' . $value . '</li>';	
			}
			echo '</ul>';
		}
		else
		{
			
			$sql = "SELECT
						id,
						name,
						level
					FROM
						users
					WHERE
						name = ?
					AND
						pass = ?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($_POST['name'],sha1($_POST['pass'])));
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($stmt->rowCount() != 1) 
			{
					
				echo 'N�got gick fel n�r du logga in, f�rs�k igen.';
				return null;
			}
			else
			{
				$_SESSION['signed_in'] = true;
				$_SESSION['id'] 	= $row[0]['id'];
				$_SESSION['name'] 	= $row[0]['name'];
				$_SESSION['level'] = $row[0]['level'];
				echo 'V�lkommen, ' . $_SESSION['name'] . '. <a href="index.php">Forts�tt till hemsidan</a>.';
			}
		}
	}
}
include 'footer.php';	
	

?>