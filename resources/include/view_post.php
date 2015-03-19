<?php
	$my_username = "USERNAME";
	$my_password = "PASSWORD";

	include('header.inc.php');

	if (!isset($_GET['id']) || !is_numeric($_GET['id']))
	{
		die("Invalid ID specified.");
	}

	$id = (int)$_GET['id'];
	$result = $database->query("SELECT * FROM `php_blog` WHERE `id` = '$id' LIMIT 1");

	foreach ($result as $row)
	{
		$date = date('D \t\h\e jS \of F, Y \a\t H:i', $row['timestamp']);
		$title = $row['title'];
		$entry = $row['entry'];
		$password = $row['password'];
?>
		<p><strong><?=$title?></strong></p>

<?php
		if($password == 1) {
			if ( isset($_POST['username']) && isset($_POST['password']) && ($_POST['username'] != $my_username || $_POST['password'] != $my_password) ) {
?>
				<p>Sorry, wrong password!</p>
<?php
				continue;
			} elseif (!isset($_POST['username'])) {
?>
				<p>This is a password protected entry. If you have a password, please log in below.</p>
				<form method="post">
					<p>
						<strong><label for="username">Username:</label></strong><br />
						<input name="username" id="username" />
					</p>
					<p>
						<strong><label for="password">Password:</label></strong><br />
						<input type="password" name="password" id="password" />
					</p>
					<p>
						<input type ="submit" name="submit" id="submit" value="submit" />
					</p>
				</form>
<?php
				continue;
			}
		}
?>
		<?=nl2br($entry)?><br/>
		Posted on <?=$date?>
<?php
	}
?>
	<br>
	<a href="/index.php">Home</a>
