<head>
    <div class="header">
<?php
        include('../resources/include/header.inc.php');
        include('../resources/include/login_header.php');
?>
        <hr>
    </div>
</head>
<body>
    <div class="content">
<?php

        $result = $database->query("SELECT * FROM `blog_posts` ORDER BY `date_to_post` DESC LIMIT 5");

        foreach($result as $row)
        {
            $id = $row['post_id'];
            include('../resources/include/view_post.php');
        }

        if(isset($_SESSION['user_id'])){?> <a href="/new_post.php">Add new post.</a> <?php }
?>
    </div>
    <div class="sidebar">
        <a href="/archive.php">View archive.</a>
    </div>
    <div class="footer">
    </div>
</body>
