<?php

	include('header.inc.php');

	if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id']))
	{
		die("Invalid entry ID.");
	}
	$id = (int) $_GET['id'];

	if(isset($_POST['update']))
	{
		$entry = htmlspecialchars(strip_tags($_POST['entry']));
		$title = htmlspecialchars(strip_tags($_POST['title']));
		$password = (isset($_POST['password'])) ? 1 : 0;
		$timestamp = time();

		$stmt = $database->prepare("UPDATE `php_blog` SET `timestamp`=?, `title`=?, `entry`=?, `password`=? WHERE `id`=? LIMIT 1");
		$result = $stmt->execute(Array($timestamp, $title, $entry, $password, $id));
		header("Location: /view_post.php?id=" . $id);
	}

	if(isset($_POST['delete']))
	{
		$stmt = $database->prepare("DELETE FROM `php_blog` where `id`=?");
		$result = $stmt->execute(Array($id));
		header( "Location: /index.php" );
	}

	$result = $database->query("SELECT * FROM php_blog WHERE id='$id'");

	$row = $result->fetch();
	$old_timestamp = $row['timestamp'];
	$old_title = $row['title'];
	$old_entry = $row['entry'];
	$old_password = $row['password'];

?>

<form method="post">
	<p><strong><label for="title">Title:</label></strong><input type="text" name="title" id="title" value="<?=$old_title;?>" size="40"/></p>
	<p><textarea cols="80" rows="20" name="entry" id="entry"><?=$old_entry?></textarea></p>
	<p><strong><label for ="changebox">Password protect?:</label></strong><input type="checkbox" name="password" id="password"<?php if($old_password == 1) echo " checked=\"checked\""; ?>/></p>
	<p><input type="submit" name="update" id="update" value="Update"/></p>
</form>
<form method="post">
	<input type="hidden" name="id" id="id" value="<?=$id?>"/>
	<input type="submit" name="delete" id="delete" value="Delete"/>
</form>
<a href="./index.php">Home</a>
