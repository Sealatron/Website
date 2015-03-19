<form method="post">

	<p><label for ="title">Title:</label><input type="text" name="title" id="title" size="40"/></p>

	<p><textarea cols="80" rows="20" name="entry" id="entry"></textarea></p>

	<p><label for ="changebox">Password protect?:</label><input type="checkbox" name="password" id="password" value="1"/></p>

	<p><input type="submit" name="submit" id="submit" value="Submit"></p>
</form>

<a href="/index.php">Home</a>

<?php
	include('header.inc.php');
	if(isset($_POST['submit']))
	{
		$title = htmlspecialchars(strip_tags($_POST['title']));
		$entry = $_POST['entry'];
		$password = isset($_POST['password']) ? htmlspecialchars(strip_tags($_POST['password'])) : 0;
		$timestamp = time();

		$query = "INSERT INTO `php_blog` (`timestamp`, `title`, `entry`, `password`) VALUES (?, ?, ?, ?)";
		$stmt = $database->prepare($query);
		$result = $stmt->execute(Array($timestamp, $title, $entry, $password));
		echo "Your entry has successfully been entered into the database.";
	}
