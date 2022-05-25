<?php session_start();
/*/ CONSTRUCT /*/
require_once('../core/conf.php'); require_once('../app/functions/pa.php');
$err = [
    'Извините, введённый вами пароль не соответствует логину.',
    'Извините, введённый вами логин не найден.',
    'Вы успешно вошли на сайт!',
    'Успешная регистрация!',
    'Такой логин существует!',
];

foreach($_REQUEST as $k => $v){$$k = htmlspecialchars(stripslashes(trim($v)));} /*/ pa($_REQUEST); pa($GLOBALS);pa($err); /*/


if(!empty($Plogin) && !empty($Ppass)){
    if(isset($r)){
        $stmt = $dbC->prepare("INSERT INTO users (login, pass) SELECT :login, MD5(:pass) FROM DUAL WHERE NOT EXISTS (SELECT login FROM users WHERE login=:login);"); 
        $stmt->execute(['login'=>$Plogin, 'pass'=>$Plogin]);
        if($stmt->rowCount()){header('Location: /?m=3');}else{header('Location: /?m=4');}
            
    }else{
        $stmt = $dbC->prepare("SELECT * FROM users WHERE login=:login"); $stmt->execute(['login'=>$Plogin]);
        if($row = $stmt->fetch(PDO::FETCH_LAZY)){
            if(md5($Ppass) == $row->pass){
                $_SESSION['login'] = $row->login; $_SESSION['id'] = $row->id;
                pa($_SESSION);
            }else{header('Location: /?m=0');}    
        }else{header('Location: /?m=1');  }
    } 
}else{unset($Plogin); unset($Ppass);}


/*/ VIEW /*/
?>
<html>
    <head>
        <title>Регистрация</title>
    </head>
    <body><?=(!empty($m) ) ? '<p>'.$err[$m].'</p><script type="text/javascript">setTimeout("document.location.href=\'/\'", 2000);</script>' : '';?>   
<?php if(isset($r)){?>

        <h2>Регистрация</h2>
        <form action="/?r" method="post">
            <p><label>Ваш логин:*<br></label><input name="Plogin" type="text" size="15" maxlength="15"></p>
            <p><label>Ваш пароль:<br></label><input name="Ppass" type="password" size="15" maxlength="15"></p>
            <p><input type="submit" name="submit" value="Зарегистрироваться"></p><a href="/">На главную</a></p>
        </form>
        
<?php }else{?>

        <h2>Главная страница</h2>
        <form action="" method="post">
            <p><label>Ваш логин:<br></label><input name="Plogin" type="text" size="15" maxlength="15"></p>
            <p><label>Ваш пароль:<br></label><input name="Ppass" type="password" size="15" maxlength="15"></p>
            <p><input type="submit" name="submit" value="Войти"><br><a href="/?r">Зарегистрироваться</a></p>
        </form><br>
        <?php if(empty($_SESSION['login']) || empty($_SESSION['id'])){?>
            Вы вошли на сайт, как гость<br><a href='#'>Эта ссылка доступна только зарегистрированным пользователям</a>
        <?php }else{?>
            Вы вошли на сайт, как <?=$_SESSION['login'];?><br>
            <a href='http://194.67.90.250/index.php'>Эта ссылка доступна только зарегистрированным пользователям</a>
        <?php }?>
        
<?php }?>
    </body>
</html>