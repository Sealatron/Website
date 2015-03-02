<?php
{
	mysql_connect('localhost');
	mysql_select_db('test_db');

	if(isset($_POST['update']))
	{
		$id = (int)$_GET['id'];
		$entry = htmlspecialchars(strip_tags($_POST['entry']));
		$title = htmlspecialchars(strip_tags($_POST['title']));

		if(isset($_POST['password']))
		{
			$password = 1;
		}
		else
		{
			$password = 0;
		}

		$entry = nl2br($entry);

		if(!get_magic_quotes_gpc())
		{
			$title = addslashes($title);
			$entry = addslashes($entry);
		}

		$timestamp = mktime(date('H'),date('i'),0,date('n'),date('j'),date('Y'));
		$result = mysql_query("UPDATE php_blog SET timestamp='$timestamp', title='$title', entry='$entry', password ='$password' WHERE id='$id' LIMIT 1") or print("Can't update entry.<br>" . mysql_error());
		header("Location: view_post.php?id=" . $id);

	}

	if(isset($_POST['delete']))
	{
		$id = (int)$_GET['id'];
		$result = mysql_query("DELETE FROM php_blog where id = '$id'") or print("Can't delete entry. <br>" . mysql_error());

		if($result != false)
		{
			header("Location: index.php");
		}
	}

	if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id']))
	{
		die("Invalid entry ID.");
	}
	else
	{
		$id = (int)$_GET['id'];
	}

	$result = mysql_query("SELECT * FROM php_blog WHERE id='$id'") or print("Can't select entry.<br>" . $sql . "<br>" . mysql_error());

	while($row = mysql_fetch_array($result))
	{
		$old_timestamp = $row['timestamp'];
		$old_title = $row['title'];
		$old_entry = $row['entry'];
		$old_password = $row['password'];

		$old_title = str_replace('"','\'', $old_title);
		$old_entry = str_replace('<br>','', $old_entry);

		$old_month =date("F",$timestamp);
		$old_date =date("d",$timestamp);
		$old_year =date("Y",$timestamp);
		$old_time =date("H:i",$timestamp);
	}
?>
	<form method="post">

		<p><strong><label for ="title">Title:</label></strong><input type="text" name="title" id="title" value="<?php echo $old_title;?>" size="40"/></p>

		<p><textarea cols="80" rows="20" name="entry" id="entry"><?php echo $old_entry;?></textarea></p>

		<p>
		<p><strong><label for ="changebox">Password protect?:</label></strong><input type="checkbox" name="password" id="password" value="1"<?php if($old_password == 1) echo " checked=\"checked\""; ?>/></p>
			<input type="submit" name="update" id="update" value="Update"/>
		</p>
	</form>
	<form method="post">
		<input type = "hidden" name="id" id="id" value = "<?php echo $id;?>"/>
		<input type = "submit" name="delete" id = "delete" value="Delete"/>
	</form>
<?php
	mysql_close();
}
?>
	<a href="./index.php">Home</a>
