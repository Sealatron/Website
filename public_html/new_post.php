<head>
    <?php

    include('../resources/include/header.inc.php');

    function options($type)
    {
        $return_string=array();

        switch($type)
        {
            case "year":
            {
                $from = 1900;
                $to = date('Y');
                $current = $to;
            }break;
            case "month":
            {
                $from = 1;
                $to = 12;
                $current = date('m');
            }break;
            case "date":
            {
                $from = 1;
                $to = 31;
                $current = date('d');
            }break;
        }

        for($i=$from;$i<=$to;$i++)
        {
            $selected = ($i == $current ? " selected" : "");
            $return_string[]='<option value="'.$i.'" '.$selected.'>'.($type=="month"?month_conversion($i):$i).'</option>';
        }

        return join('',$return_string);
    }

        function month_conversion($month)
        {
            return date('F',mktime(0,0,0,$month,1));
        }
    ?>
    <script language="Javascript" type="text/javascript" src="js/date_picker.js"></script>
</head>
<body>
    <form method="post">

        <p><label for ="title">Title:</label><input type="text" name="title" id="title" size="40"/></p>

        <p><textarea cols="80" rows="20" name="entry" id="entry"></textarea></p>
        <p>
            Date to post entry:
            <select id = "day_picker" name="day">
                <noscript><?=options("date")?></noscript>
            </select>
            <select id = "month_picker" name="month">
                <noscript><?=options("month")?></noscript>
            </select>
            <select id = "year_picker" name="year">
                <noscript><?=options("year")?></noscript>
            </select>
        </p>

        <script>
            date_picker.day = document.getElementById("day_picker");
            date_picker.month = document.getElementById("month_picker");
            date_picker.year = document.getElementById("year_picker");

            update_year_picker(todays_date.getFullYear(), year_range);
            update_month_picker();

            date_picker.year.selectedIndex = year_range;
            date_picker.month.selectedIndex = todays_date.getMonth();

            update_date_picker();
            date_picker.day.selectedIndex = todays_date.getDate()-1;

            date_picker.month.addEventListener("change",update_date_picker); 
            date_picker.year.addEventListener("change",update_date_picker);
        </script>

        <p><label for ="changebox">Password protect?:</label><input type="checkbox" name="password" id="password" value="1"/></p>

        <p><input type="submit" name="submit" id="submit" value="Submit"></p>
    </form>

    <a href="/index.php">Home</a>

    <?php
        if(isset($_POST['submit'])&&isset($_SESSION['user_id']))
        {
            $title = htmlspecialchars(strip_tags($_POST['title']));
            $entry = $_POST['entry'];
            $user_id = $_SESSION['user_id'];
            $access = isset($_POST['password']) ? htmlspecialchars(strip_tags($_POST['password'])) : 0;
            $created_at = time();
            $date_to_post = mktime(0,0,0,date('m',strtotime($_POST['month'])),$_POST['day'],$_POST['year'],0);

            $query = "INSERT INTO `blog_posts` (`title`, `entry`, `user_id`, `access`, `created_at`, `date_to_post`) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $database->prepare($query);
            $result = $stmt->execute(Array($title, $entry, $user_id, $access, $created_at, $date_to_post));
            echo "Your entry has successfully been entered into the database.";
        }
    ?>
</body>
