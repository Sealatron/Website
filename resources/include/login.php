<form method="POST">
    <p>
        <label>Username:</label> <input type="username" name="username" size="20"/>
        <label>Password:</label> <input type="password" name="password" size="20"/>
        <input type="submit" name="submit" value="Login">
    </p>
</form>

<?php
    if(isset($_POST['submit']))
    {
        $username_attempt = $_POST['username'];
        $password_attempt = $_POST['password'];

        $query = "SELECT * FROM `users` WHERE `username` = '$username_attempt'";
        $stmt = $database->prepare($query);
        $result = $stmt->execute();

        if($row = $stmt->fetch())
        {
           if(password_verify($password_attempt, $row['password']))
           {
                echo "Correct Password! <br>";
                $_SESSION['user_id'] = $row['user_id'];
           }
           else
           {
                echo "Incorrect Password! <br>";
           }
        }
        else
        {
            echo "A user with that name does not exist. <br>";
        }
    }
?>
