<?php
session_start();

    include 'connect.php';  
	include 'header.php';
	echo '<h3> Sign up </h3>';
	
	/* om formul�ret inte har postats �n, s� visas formul�ret */
	
	if($_SERVER ['REQUEST_METHOD']!= 'POST')
	{
		echo '<form method="post" action="">
		Anv�ndarnamn: <input type="text" name="name" /><br>
		L�senord: <input type ="password" name="pass" ><br>
		L�senord igen <input type="password" name="pass_check"><br>
		E-mail: <input type="email" name ="email"><br>
		<input type="submit" value="Registrera" />
		</form>';
		
		//echo "<a href='#' onClick=\"window.open('fblogin.php', 'WindowC', 'width=1100, height=700,scrollbars=yes');\"><img src='pics/fbcreateaccount.png'></a>";
		echo "<a href='fblogin.php'><img src='pics/fbcreateaccount.png' > </a>";
		
	}
	else {
		$errors = array();
		if(isset($_POST['name']))
		{
			if(!ctype_alnum($_POST['name']))
		{
			$errors[] = 'Anv�ndarnamnet kan endast ha bokst�ver och siffror.';
		}
		if(strlen($_POST['name']) > 20 )
		{
			$errors[] = 'Anv�ndarnamnet f�r max vara 20 bokst�ver l�ngt.';
		}	
	}
	else {
		$errors[] = 'Du har gl�mt fylla i n�t anv�ndarnamn.';
		
	}
	if(isset($_POST['pass']))
	{
		if($_POST['pass'] != $_POST['pass_check'])
		{
			$errors[] = 'L�senorden matchade inte.';
		}
	}
	else
	{
		$errors[] = 'L�senordsf�ltet �r tomt.';
	}
	if(!empty($errors))
	{
		echo'N�gra f�lt �r inte korrekt ifylda';
		echo '<ul>';
		foreach ($errors as $key => $value) 
		{
			echo '<li>' . $value . '</li>';
		}
		echo '</ul>';
	}
	else 
	{
		$sql = "INSERT INTO users(name, pass, email , date)	VALUES(?, ?, ? ,NOW())";
		$stmt = $db->prepare($sql);
		$stmt->execute(array($_POST['name'],sha1($_POST['pass']),$_POST['email'])); //PDO fel..
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);	
			
		if(!$db->lastInsertId('id')) 
		{
			echo 'N�got gick fel vid registreringen, f�rs�k igen.';		
		}
		else
		{
			echo 'Godk�nd registrering. Du kan nu <a href="signin.php">signa in</a> och starta posta! :-)'; 
        } 
    } 
} 
include 'footer.php';  
	
?>