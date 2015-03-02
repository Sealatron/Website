	<form method="post">

		<p><strong><label for ="title">Title:</label></strong><input type="text" name="title" id="title" size="40"/></p>

		<p><textarea cols="80" rows="20" name="entry" id="entry"></textarea></p>

		<p>
		<p><strong><label for ="changebox">Password protect?:</label></strong><input type="checkbox" name="password" id="password" value="1"/></p>
			<input type="submit" name="submit" id="submit" value="Submit"/>
		</p>
	</form>
		<a href="./index.php">Home</a>
<?php
	if(isset($_POST['submit']))
	{
		$title = htmlspecialchars(strip_tags($_POST['title']));
		$entry = $_POST['entry'];
		$password = isset($_POST['password']) ? htmlspecialchars(strip_tags($_POST['password'])) : 0;

		$timestamp = mktime(date('H'),date('i'),0,date('n'),date('j'),date('Y'));

		$entry = nl2br($entry);

		if(!get_magic_quotes_gpc())
		{
			$title = addslashes($title);
			$entry = addslashes($entry);
		}

		mysql_connect ('localhost');
		mysql_select_db('test_db');

		$sql = "INSERT INTO php_blog (timestamp, title, entry, password) VALUES ('$timestamp', '$title', '$entry','$password')";
		$result = mysql_query($sql) or print ("Can't insert into table php_blog.<br />" . $sql . "<br .>" . mysql_error());

		if ($result != false)
		{
			print "Your entry has successfully been entered into the database.";
		}

		mysql_close();
	}
?>
