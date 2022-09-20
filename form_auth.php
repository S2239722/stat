<?php
    
    require_once("header.php");
    
?>
 
<!-- Блок для вывода сообщений -->
<div class="block_for_messages">

</div>
 
<?php

    //Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    //иначе выводим сообщение о том, что он уже авторизован
         if(empty($_COOKIE["user"])){
?>
 
 
    <div id="form_auth">
        <h2>Форма авторизации</h2>
        <form action="auth.php" method="post" name="form_auth">
            <table>
          
                <tbody><tr>
                    <td> Login: </td>
                    <td>
                         <input type="text" name="login" required="required"  value='Sektor'>
                    </td>
                    <td> <?if(!empty($_COOKIE["login"])): echo $_COOKIE["login"]; endif;?> </td>
                </tr>
          
                <tr>
                    <td> Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="минимум 6 символов" required="required"><br>
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                    <td> <?if(!empty($_COOKIE["pas"])): echo $_COOKIE["pas"]; endif;?> </td>
                </tr>
                 
                <tr>
                </tr>
 
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit_auth" value="Войти">
                    </td>
                </tr>
            </tbody></table>
        </form>
    </div>
 
<?php
         }else{
            print_r( 'Здравстуй '.$_COOKIE["user"].'  Для выхода нажмите ');
           
    
?>
 <a href="exit.php">здесь</a>
    
 
<?php
         }
?>
 
