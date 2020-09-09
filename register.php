<?php
    function generateRandomString($length) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    $errorList = array();
    $user = array();
    if(isset($_POST['login']))
    {
        $sault = generateRandomString(5);
        $password = md5($sault.$_POST['password']);

        $user = array(
            "login" => $_POST['login'],
            "password" => $password,
            "sault" => $sault,
            "email" => $_POST['email'],
            "name" => $_POST['name']
        );

        if(file_exists('users/'.$login.'.xml'))
        {
            $errorList['tLog'] = 'Login is already taken.';
        }
        if(file_exists('users/'.$_POST['email'].'.xml'))
        {
            $errorList['tMail'] = 'Email is already taken.';
        }
        if($_POST['password'] != $_POST['confirmPassword'])
        {
            $errorList['fConf'] = 'Password confirmation failed.';
        }

        if(count($errorList) == 0)
        {
            $xml = new SimpleXMLElement('<user></user>');
            $xml->addChild('password', $user['password']);
            $xml->addChild('sault', $user['sault']);
            $xml->addChild('email', $user['email']);
            $xml->addChild('name', $user['name']);
            $xml->asXML('users/'.$user['login'].'.xml');
            header('Location: login.php');
            die;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <style>
        body
        {
            text-align:center;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h4>Login <input type="text" size="21" name="login" required minlength='6'></h4> <? if($errorList['tLog'] != ''){ echo $errorList['tLog']; } ?>
        <h4>Password <input type="password" size="18" name="password" required minlength='6'></h4> <? if($errorList['fConf'] != ''){ echo $errorList['fConf']; } ?>
        <h4>Confirm password <input type="password" size="18" name="confirmPassword" required></h4>
        <h4>Email <input type="email" size="18" name="email" required></h4> <? if($errorList['tMail'] != ''){ echo $errorList['tMail']; } ?>
        <h4>Name <input type="text" size="18" name="name" required minlength='2' maxlength='2'></h4>
        <input type="submit" value="Thats it." name="subLog">
        <a href="index.php">back to main page.</a>
    </form>
</body>
</html>