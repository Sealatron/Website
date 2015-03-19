<?php
	include('header.inc.php');

    if(isset($_SESSION['user_id']))
    {
?>
        <p>
            You are logged in as user number <?=$_SESSION['user_id']?>.
            <a href="/logout.php">Logout.</a>
        </p>
<?php
    }
    else
    {
        include('login.php');
        if(isset($_SESSION['user_id']))
        {
            header('Location: /index.php');
        }
    }
?>
    <hr>
<?php

	$result = $database->query("SELECT * FROM `php_blog` ORDER BY `timestamp` DESC LIMIT 5");

	foreach($result as $row)
	{
		$date = date("D, d F Y, H:i ",$row['timestamp']);

		$title = $row['title'];
		$entry = $row['entry'];
		$password = $row['password'];
		$id = $row['id'];
?>
		<p><strong><?=$title?></strong></p>
<?php
        if($password == 1)
        {
            if(isset($_SESSION['user_id']))
            {
?>
                <p><?=nl2br($entry)?></p><br>
                <p>Posted on <?=$date?></p>
<?php
            }
            else
            {
?>
                <p>This entry is password protected. Please login above to view.</p>
<?php
            }
        }
        else
        {
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
