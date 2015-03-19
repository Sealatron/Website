<?php
	include('../resources/include/header.inc.php');

    $distinct_years_query = "SELECT DISTINCT YEAR(FROM_UNIXTIME(`date_to_post`)) FROM `blog_posts`";
    $distinct_years_stmt = $database->prepare($distinct_years_query);
	$result = $distinct_years_stmt->execute();

    while($year = $distinct_years_stmt->fetchColumn())
    {
        $blog_query = "SELECT * FROM `blog_posts` WHERE YEAR(FROM_UNIXTIME(`date_to_post`)) = :year ";
        $blog_stmt = $database->prepare($blog_query);
        $blog_stmt->bindValue(":year",$year);
?>
        <strong><?=$year?></strong><br>
<?php
        if($blog_stmt->execute())
        {
            while($entry = $blog_stmt->fetch())
            {
                $entry_date = date('F jS',$entry['date_to_post']);
?>
                <a href="view_post.php?id=<?=$entry['post_id']?>"><?=$entry['title']?></a>
                <?=$entry_date?>
                <br>
<?php
            }
        }
        echo "<br><hr>";
    }

?>
<a href="/index.php">Home</a>
