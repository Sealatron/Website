<p><strong>Register New User</strong></p>
<br>
<form method = "POST">

    <p>Username: <input type="text" name="username" size="15"/></p>
    <p>Password: <input type="password" name="password" size="15"/></p>
    <p>E-mail Address: <input type="text" name="e_mail" size="15"/></p>
    <br>
    <p><input type = "submit" name="submit" value = "Register"/></p>
</form>

<?php

    include('header.inc.php');
    
    if(isset($_POST['submit']))
    {
        $username_attempt = $_POST['username'];

        $query = "SELECT * FROM `users` WHERE `username` = '$username_attempt'";
        $stmt = $database->prepare($query);
        $result = $stmt->execute();

        if(!$row = $stmt->fetch())
        {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            $e_mail = $_POST['e_mail'];
            $joined_at = time();
            $admin = 0;

            $query = "INSERT INTO `users` (`username`, `password`, `e_mail`, `joined_at`, `admin`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $database->prepare($query);
            $result = $stmt->execute(Array($username, $password, $e_mail, $joined_at, $admin));
            echo "A new user was created!";
        }
        else
        {
            echo "A user with that name is already registered.";
        }
    }
?>
