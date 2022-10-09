<?php
    //Подключение шапки
    require_once("index.php");
    //подщет количество посещений пользователя
    if (!isset($_SESSION['reg'])) $_SESSION['reg'] = 0;
    {
    $_SESSION['reg'] = $_SESSION['reg'] + 1;
    }
    if(!empty($_COOKIE["user"])):
        echo ("Hello   ".$_COOKIE["user"].$_SESSION['reg']);

        else:

?>
<!-- Блок для вывода сообщений -->

            <h2>Форма регистрации</h2>
 
            <form id="form_reg">
                            <div class="mar10"><label>Логин:      <input name="login"></label></div>
                            <div class="mar10"><label>Password:<input type="password" name="password" minlength="6" required></label></div>
                            <span id="valid_password_message" class="mesage_error"></span>
                            <div class="mar10"><label>Проверочный:<input type="password" name="confirm_pass" minlength="6" required></label></div>
                            <span id="valid_password_message" class="mesage_error"></span>
                            <div class="mar10"><label>Email:<input name="email"></label></div>
                            <span id="valid_email_message" class="mesage_error"></span>
                            <div class="mar10"><label>Имя:      <input name="name"></label></div>
                            
                            
            </form>
            <div id="message"></div>
            <div><button type="button" id="my_form">Зарегистрироватся</button></div>

        <div id="authorized">
                <h2>Форма регистрации </h2>
                

        </div>



<script> 
        $('#my_form').click(function(){
	
	     $.post(
		      'register.php', // адрес обработчика
		       $("#form_reg").serialize(), // отправляемые данные  		
		
		       function(msg) { // получен ответ сервера  
			   $('#form_reg').hide('slow');
			   $('#message').html(msg);
		}
	    );
	
         });
</script> 

<? endif;?>