<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
</head>
<body>
    <?php
        if(isset($_SESSION['login']))
        {
            echo "Hello, <b style='font-size:9vh;'>".$_SESSION['name']."</b>, welcome to your page.</br>";
            echo "Your login is" . $_SESSION['login']."</br>";
            echo "<a href='logout.php'>Logout</a>";
        }
        else
        {
            echo "<a href='login.php'>Login form</a></br>";
            echo "<a href='register.php'>Register form</a>";
        }
    ?>
</body>
</html>