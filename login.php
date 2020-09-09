<?php
$errorList = array();
if(isset($_POST['login']))
{
    if(file_exists('users/'.$_POST['login'].'.xml'))
        {
            $xml = new SimpleXMLElement('users/'.$_POST['login'].'.xml', 0, true);
            if(md5($xml->sault.$_POST['password']) == $xml->password && count($errorList) == 0)
            {
                session_start();
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['name'] = $xml->name;
                header('Location:index.php' );
                die;
            }
            else $errorList['wPass'] = 'Wrong password.';
        }
    else $errorList['noUser'] = 'Such login is not exists.';
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body
        {
            text-align:center;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h4>Login <input type="text" size="21" name="login" required></h4> <? if($errorList['noUser'] != ''){ echo $errorList['noUser']; } ?>
        <h4>Password <input type="password" size="18" name="password" required></h4> <? if($errorList['wPass'] != ''){ echo $errorList['wPass']; } ?>
        <input type="submit" value="Go on!" name="subLog">
        <a href="index.php">back to main page.</a>
    </form>
</body>
</html>