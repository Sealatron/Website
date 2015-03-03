<?php

	include('header.inc.php');

	$result = $database->query("SELECT * FROM `php_blog` ORDER BY `timestamp` DESC LIMIT 5");

	foreach ($result as $row)
	{
		$date = date("D, d F Y, H:i ",$row['timestamp']);

		$title = $row['title'];
		$entry = $row['entry'];
		$password = $row['password'];
		$id = $row['id'];
?>
		<p><strong><?=$title?></strong></p>

<?php
		if ( $password == 1 ) {
?>
			<p>This is a password protected entry. If you have a password, please log in below.</p>
			<form method="post" action="/view_post.php?id=<?=$id?>">
				<p>
					<strong><label for="username">Username:</label></strong><br />
					<input name="username" id="username" />
				</p>
				<p>
					<strong><label for="password">Password:</label></strong><br />
					<input type="password" name="pass" id="pass" />
				</p>
				<p>
					<input type ="submit" name="submit" id="submit" value="submit" />
				</p>
			</form>
<?php
		} else {
?>
				<p><?=nl2br($entry)?></p><br>
				<p>Posted on <?=$date?></p>
<?php
		}
?>
		<hr>
<?php
	}
?>
	<a href="/new_post.php">Add a new post</a>
<?php
{

	$result = $database->query("SELECT FROM_UNIXTIME(timestamp, '%Y') AS get_year, COUNT(*) AS entries FROM php_blog GROUP BY get_year");
	foreach($result as $row)
	{
		$get_year = $row['get_year'];
		$entries = $row['entries'];
?>
		<br>
		<a href="/archive.php?year=<?=$get_year?>">Entries from <?=$get_year?></a> (<?=$entries?>)
		<br>
<?php
	}
}
?>
