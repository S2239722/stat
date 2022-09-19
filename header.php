<?php
    //Запускаем сессию
    session_start();
    setcookie("user",' ', time() + 360, "/");
    setcookie("login",' ', time() + 360, "/");
    setcookie("pas",' ', time() + 360, "/");
    setcookie("login1",' ', time() + 360, "/");
    setcookie("reg",' ', time() + 360, "/");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Веб-приложение</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
 
        <div id="header">
            <h2>Веб-приложение</h2>
 
            <a href="header.php">Главная</a>
 
            <div id="auth_block">
 
                <div id="link_register">
                    <a href="/form_register.php">Регистрация</a>
                </div>
 
                <div id="link_auth">
                    <a href="/form_auth.php">Авторизация</a>
                </div>
 
            </div>
             <div class="clear"></div>
        </div>
        
    </body>
</html>



