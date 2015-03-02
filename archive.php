<?php
{
	mysql_connect('localhost');
	mysql_select_db('test_db');

	if(!isset($_GET['year']))
	{
		die("Invalid year specified.");
	}
	else
	{
		$year = (int)$_GET['year'];
	}
	$result = mysql_query("SELECT timestamp, id, title FROM php_blog WHERE FROM_UNIXTIME(timestamp, '%Y') = '$year' ORDER BY id DESC");

	while($row = mysql_fetch_array($result))
	{
		$date = date("l F d Y", $row['timestamp']);
		$id = $row['id'];
		$title = stripslashes($row['title']);
?>
		<p><?php echo $date; ?><br><a href="view_post.php?id=<?php echo $id; ?>">Read post "<?php echo $title; ?>".</a></p>
		<p><a href="edit.php?id=<?php echo $id;?>">Edit</a></p>
<?php
	}
	
	mysql_close();
}
?>
	<a href="./index.php">Home</a>
