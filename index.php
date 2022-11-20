<?php
    //Запускаем сессию
    session_start();
    

   // define('MyConst', TRUE);
   
    
    
    

        
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Веб-приложение</title>
        <script src="assets/js/jquery.min.js"></script>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
    <div class="layout-center-wrap"><div class="layout-wrap pad50-b">
        <div id="header">
            <h2>Веб-приложение</h2>
 
            <a href="index.php">Главная</a>
 
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
         <? if(!empty($_COOKIE["reg"])):
         echo ("Hello   ".$_COOKIE["reg"]); endif; ?>
    </body>
</html>



