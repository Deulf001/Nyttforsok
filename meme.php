<META charset="utf-8">
<?php
session_start();
  include 'connect.php';
  include 'header.php';

?>
   <div class="meme">
		<form action="upload_file.php" method="post"enctype="multipart/form-data">
			<label for="file">Filnamn:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="submit" value="MEME GO!">
		</form>
	</div>
