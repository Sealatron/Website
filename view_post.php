<?php
	$my_username = "USERNAME";
	$my_password = "PASSWORD";

	mysql_connect ('localhost') ;
	mysql_select_db ('test_db');

	if (!isset($_GET['id']) || !is_numeric($_GET['id']))
	{
		die("Invalid ID specified.");
	}
	
	$id = (int)$_GET['id'];
	$sql = "SELECT * FROM php_blog WHERE id='$id' LIMIT 1";

	$result = mysql_query($sql) or print ("Can't select entries from table php_blog.<br />" . $sql . "<br />" . mysql_error());

	while($row = mysql_fetch_array($result))
	{
		$date = date('D \t\h\e jS \of F, Y \a\t H:i',$row['timestamp']);
		$title = stripslashes($row['title']);
		$entry = stripslashes($row['entry']);
		$password = $row['password'];
?>
		<p><strong><?php echo $title; ?></strong></p>
	
		<?php if($password == 1):?>
			<?php if(isset($_POST['username'])&& $_POST['username'] == $my_username):?>
				<?php if(isset($_POST['pass'])&& $_POST['pass'] == $my_password):?>
					<p>
						<?php echo $entry;?>
						Posted on <?php echo $date;?>
					</p>
				<?php else:?>
					<p>Sorry, wrong password!</p>
				<?php endif ;?>
			<?php else:?>
				<p>This is a password protected entry. If you have a password, please log in below.</p>
				<form method = "post">
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
			<?php endif ;?>
		<?php else:?>
			<?php echo $entry;?>
			<br>
			Posted on <?php echo $date;?>
		<?php endif ;?>

<?php
	}
	mysql_close();
?>
	<br>
	<a href="./index.php">Home</a>
