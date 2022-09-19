<?php
    //Подключение шапки
    require_once("header.php");
    //setcookie("login",'  ', time() + 36, "/");
?>
<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    
    
</div>     
        <div id="form_register">
            <h2>Форма регистрации</h2>
 
            <form action="register.php" method="post" name="form_register">
                <table>
                    <tbody><tr>
                        <td> Login: </td>
                        <td>
                            <input type="text" name="login" minlength="6"  required="required" > 
                                                              
                        </td>
                        <td> <?=$_COOKIE["login"]?> </td>
                    </tr>
 
                    <tr>
                        <td> Password: </td>
                        <td>
                            <input type="password" name="password" minlength="6"  required="required">
                            <span id="valid_password_message" class="mesage_error"></span>
                        </td>
                    </tr>
              
                    <tr>
                        <td> Email: </td>
                        <td>
                            <input type="email" name="email" required="required"><br>
                            <span id="valid_email_message" class="mesage_error"></span>
                        </td>
                    </tr>
              
                    <tr>
                        <td> Name: </td>
                        <td>
                            <input type="Name" name="Name" placeholder="Только 2 символа" maxlength="2" required="required"><br>
                            
                        </td>
                    </tr>
                    <tr>
                        <td> Confirm_password: </td>
                        <td>
                            <p>
                                <input type="text" name="confirm_password" placeholder="confirm_password" required="required">
                            </p>
                        </td>
                        <td> <?=$_COOKIE["login1"]?> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="btn_submit_register" value="Зарегистрироватся!">
                        </td>
                    </tr>
                </tbody></table>
            </form>
        </div>
<?php
     //endif;
     //$new_url = 'exit.php';
     //header('Location: '.$new_url);
    //if($_COOKIE["user"] == ' ')
?>
        <div id="authorized">
                <h2>Форма регистрации </h2>
                <h2><?=$_COOKIE["reg"]?></h2>

        </div>
<?php
    
     
    
?>