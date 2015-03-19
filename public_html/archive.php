<?php

	include('header.inc.php');

	if(!isset($_GET['year']) || !is_numeric($_GET['year']))
	{
		die("Invalid year specified.");
	}
	else
	{
		$year = (int)$_GET['year'];
	}
	$result = $database->query("SELECT `timestamp`, `id`, `title` FROM `php_blog` WHERE FROM_UNIXTIME(`timestamp`, '%Y') = '$year' ORDER BY id DESC");

	foreach ($result as $row)
	{
		$date = date("l F d Y", $row['timestamp']);
		$id = $row['id'];
		$title = $row['title'];
?>
		<p><?=$date?><br><a href="/view_post.php?id=<?=$id;?>">Read post "<?=$title?>".</a></p>
		<p><a href="/edit.php?id=<?=$id?>">Edit</a></p>
<?php
	}

?>
<a href="/index.php">Home</a>
