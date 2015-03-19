<?php
 if(isset($_SESSION['user_id']))
    {
        $query = "SELECT `username` FROM `users` WHERE `user_id`=" . $_SESSION['user_id'];
        $stmt = $database->prepare($query);
        $stmt->execute();
        $username = $stmt->fetchColumn();
?>
        <p>
            You are logged in as <?=$username?>.
            <a href="/logout.php">Logout</a>
        </p>
<?php
    }
    else
    {
        include('login.php');

        if(isset($_SESSION['user_id']))
        {
            header('Refresh: 0;');
        }
    }
