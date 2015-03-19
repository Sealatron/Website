<?php
    $id = empty($id) ? $_GET['id']: $id;

	$result = $database->query("SELECT * FROM `blog_posts` WHERE `post_id` = '$id' LIMIT 1");

	foreach ($result as $row)
	{
		$date = date('D \t\h\e jS \of F, Y \a\t H:i', $row['date_to_post']);
		$title = $row['title'];
		$entry = $row['entry'];
?>
        <p>
            <strong><?=$title?></strong>
            <?php if(isset($_SESSION['user_id'])){?><a href="/edit.php?id=<?=$id?>">Edit</a><?php } ?>
        </p>

        <?=nl2br($entry)?>
        <br>
		Posted on <?=$date?>
        <hr>
<?php
	}
?>
