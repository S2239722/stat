<?php
    
    require_once("index.php");
    //Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    //иначе выводим сообщение о том, что он уже авторизован
    if (!isset($_SESSION['reg'])) $_SESSION['reg'] = 0;
    {
    $_SESSION['reg'] = $_SESSION['reg'] + 1;
    }
    if(!empty($_COOKIE["user"])):
        echo ("Hello   ".$_COOKIE["user"].$_SESSION['reg']);//подсчет посещений
        else:
                   
        
?>
 
 
        <h2>Форма авторизации</h2>
    <form id="form">
	     <div class="mar10"><label>Имя: <input name="login"></label></div>	
	     <div class="mar10"><label>password: <input type="password" name="password" minlength="6" required></label></div>
         

    </form> 
       <div id="message"></div>
       <div><button type="button" id="my_form_send">Войти</button></div>
         

<script> //отправка формы страницы без перезагрузки и получение ответа
        $('#my_form_send').click(function(){
	
	     $.post(
		      'auth.php', // адрес обработчика
		       $("#form").serialize(), // отправляемые данные  		
		
		       function(msg) { // получен ответ сервера  
			   $('#form').hide('slow');
			   $('#message').html(msg);
		}
	    );
	
         });
</script> 

    
 <?php
        endif;  
 ?>
