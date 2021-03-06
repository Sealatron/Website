<?php

	include('../resources/include/header.inc.php');

	if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id']))
	{
		die("Invalid entry ID.");
	}
	$id = (int) $_GET['id'];

	if(isset($_POST['update']))
	{
		$entry = htmlspecialchars(strip_tags($_POST['entry']));
		$title = htmlspecialchars(strip_tags($_POST['title']));
		$access = (isset($_POST['access'])) ? 1 : 0;
		$created_at = time();

		$stmt = $database->prepare("UPDATE `blog_posts` SET `created_at`=?, `title`=?, `entry`=?, `access`=? WHERE `post_id`=? LIMIT 1");
		$result = $stmt->execute(Array($created_at, $title, $entry, $access, $id));
		header("Location: /index.php");
	}

	if(isset($_POST['delete']))
	{
		$stmt = $database->prepare("DELETE FROM `blog_posts` where `post_id`=?");
		$result = $stmt->execute(Array($id));
		header( "Location: /index.php" );
	}

	$result = $database->query("SELECT * FROM `blog_posts` WHERE `post_id`='$id'");

	$row = $result->fetch();
	$old_timestamp = $row['created_at'];
	$old_title = $row['title'];
	$old_entry = $row['entry'];
	$old_password = $row['access'];

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
