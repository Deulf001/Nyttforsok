<?php
session_start();
   include 'connect.php';
   include 'header.php';
   
 
	$sql = "SELECT
				id,
				name,
				description,
			FROM
				categories";
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		
		echo '<form method="post" action="">
			Kategorinamn: <input type="text" name="name" /><br />
			Kategoribeskrivning:<br /> <textarea name="description" /></textarea><br /><br />
			<input type="submit" value="Lägg till ny kategori" />
		 </form>';
	}
	else
	{
		
		$sql = "INSERT INTO categories(name, description)
		   VALUES('$_POST[name]', '$_POST[description]')";
		$stmt = $db->prepare($sql);
		$stmt->execute(array($_POST['name'],($_POST['description']))); //$_POST
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($stmt->rowCount() == 0) 
		{
			
			echo 'Error' . mysql_error();
		}
		else
		{
			echo 'Ny kategori skapad.';
		}
	}

   
   include 'footer.php';   
?>