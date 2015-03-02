<?php
	mysql_connect ('localhost') ;
	mysql_select_db ('test_db');

	$sql = "SELECT * FROM php_blog ORDER BY timestamp DESC LIMIT 5";
	$result = mysql_query($sql) or print ("Can't select entries from table php_blog.<br />" . $sql . "<br />" . mysql_error());

	while($row = mysql_fetch_array($result))
	{
		$date = date("D, d F Y, H:i ",$row['timestamp']);

		$title = stripslashes($row['title']);
		$entry = stripslashes($row['entry']);
		$password = $row['password'];
		$id = $row['id'];
?>
		<p><strong><?php echo $title; ?></strong></p>
	
		<?php if($password == 1):?>
			<p>This is a password protected entry. If you have a password, please log in below.</p>
			<form method = "post" action = "view_post.php?id=<?php echo $id;?>">
				<p>
					<strong><label for="username">Username:</label></strong><br />
					<input type = "text" name="username" id="username" />
				</p>
				<p>
					<strong><label for="password">Password:</label></strong><br />
					<input type = "password" name="pass" id="pass" />
				</p>
				<p>
					<input type ="submit" name="submit" id="submit" value="submit" />
				</p>
			</form>
		<?php else:?>
				<p><?php echo $entry; ?></p><br>
				<p>Posted on <?php echo $date;?></p>
		<?php endif ;?>
		<hr>
<?php
	}
?>
	<a href="./new_post.php">Add a new post</a>
<?php
{

	$result =mysql_query("SELECT FROM_UNIXTIME(timestamp, '%Y') AS get_year, COUNT(*) AS entries FROM php_blog GROUP BY get_year");
	while($row = mysql_fetch_array($result))
	{
		$get_year = $row['get_year'];
		$entries = $row['entries'];
?>
		<br>
		<a href="archive.php?year=<?php echo $get_year;?>">Entries from <?php echo $get_year;?></a> (<?php echo $entries; ?>)
		<br>
<?php
	}
}
?>
