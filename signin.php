<META charset="utf-8">
<?php
session_start();
  include 'connect.php';
  include 'header.php';
  
    echo '<h3>Logga in<h3/>';
    if (isset($_SESSION['signed_in']) && $_SESSION
    ['signed_in'] == TRUE) 
    {
     echo 'Du är redan inloggad, du kan <a href=
     "signout.php">logga ut</a> om du vill';   
    }
	else 
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			echo '<form method="post" action="">
			Användarnamn: <input type="text" name="name" />
			Lösenord: <input type="password" name="pass">
			<input type="submit" value="Logga in" />
		 </form>';
		 echo "<a href='fblogin.php'><img src='pics/fblogin.png' > </a>";
	}
		else
		{
			$errors = array(); 
		if(!isset($_POST['name']))
		{
			$errors[] = 'Fyll i användarnamnet.';
		}
		if(!isset($_POST['pass']))
		{
			$errors[] = 'Lösenordet är inte ifyllt';
		}
		if(!empty($errors)) 
		{
			echo 'Fälten är inte ifyllda';
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

				echo 'Något gick fel när du logga in, försök igen.';
				return null;
			}
			else
			{
				$_SESSION['signed_in'] = true;
				$_SESSION['id'] 	= $row[0]['id'];
				$_SESSION['name'] 	= $row[0]['name'];
				$_SESSION['level'] = $row[0]['level'];
				echo 'Välkommen, ' . $_SESSION['name'] . '. <a href="index.php">Fortsätt till hemsidan</a>.';
			}
		}
	}
}
include 'footer.php';	


?>