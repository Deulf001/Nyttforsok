<?php
session_start();

    include 'connect.php';  
	include 'header.php';
	echo '<h3> Sign up </h3>';
	
	/* om formuläret inte har postats än, så visas formuläret */
	
	if($_SERVER ['REQUEST_METHOD']!= 'POST')
	{
		echo '<form method="post" action="">
		Användarnamn: <input type="text" name="name" /><br>
		Lösenord: <input type ="password" name="pass" ><br>
		Lösenord igen <input type="password" name="pass_check"><br>
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
			$errors[] = 'Användarnamnet kan endast ha bokstäver och siffror.';
		}
		if(strlen($_POST['name']) > 20 )
		{
			$errors[] = 'Användarnamnet får max vara 20 bokstöver långt.';
		}	
	}
	else {
		$errors[] = 'Du har glömt fylla i något användarnamn.';
		
	}
	if(isset($_POST['pass']))
	{
		if($_POST['pass'] != $_POST['pass_check'])
		{
			$errors[] = 'Lösenorden matchade inte.';
		}
	}
	else
	{
		$errors[] = 'Lösenordsfältet är tomt.';
	}
	if(!empty($errors))
	{
		echo'Vissa fält är inte korrekt ifylda';
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
			echo 'Något gick fel vid registreringen, försök igen.';		
		}
		else
		{
			echo 'Godkänd registrering. Du kan nu <a href="signin.php">logga in</a> och börja posta! :-)'; 
        } 
    } 
} 
include 'footer.php';  
	
?>