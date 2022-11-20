<?php
    //Подключение шапки
    require_once("index.php");
    //подщет количество посещений пользователя
   
    if(empty($_COOKIE["reg"])):
      

?>
<!-- Блок для вывода сообщений -->

            <h2>Форма регистрации</h2>
 
            <form id="form_reg">
                            <div class="mar10"><label>Логин:      <input name="login"></label>
                            <span id = mes></span>
                            <div class="mar10"><label>Password:<input type="password" name="password" minlength="6" required></label>
                            <span id="valid_password_message" class="mesage_error"></span><span id = mesp></span>
                            <div class="mar10"><label>Проверочный:<input type="password" name="confirm_pass" minlength="6" required></label>
                            <span id="valid_password_message" class="mesage_error"></span><span id = mespc></span>
                            <div class="mar10"><label>Email:<input name="email"></label>
                            <span id="valid_email_message" class="mesage_error"></span><span id = eml></span>
                            <div class="mar10"><label>Имя:      <input name="name"></label></span><span id = nm></span>
                                                        
            </form>
            
            

        
        
        <div><button type="button" id="my_form">Зарегистрироватся</button></div>
        <div id = okk></div>
                <h2>Форма регистрации </h2>
                

        </div>



<script> //отправка формы страницы без перезагрузки и получение ответа
        $('#my_form').click(function(){
	
	     $.post(
		      'register.php', // адрес обработчика
		       $("#form_reg").serialize(), // отправляемые данные  		
		       
		       function(msg) { // получен ответ сервера  
               var jsonData = JSON.parse(msg);
			   //$('#form_reg').hide('slow');
               if (jsonData.key == "1")
                {                   
                    $('#mes').html(jsonData.text); 
                }
                if (jsonData.key == "2")
                {                   
                    $('#mesp').html(jsonData.text); 
                }
                if (jsonData.key == "3")
                {                   
                    $('#eml').html(jsonData.text); 
                }
                if (jsonData.key == "5")
                {                   
                    $('#mespc').html(jsonData.text); 
                }
                if (jsonData.key == "6")
                {                   
                    $('#nm').html(jsonData.text); 
                }
                if (jsonData.key == "4")
                {  
                   // $('#form_reg').hide('slow');              
                    $('#okk').html(jsonData.text); 
                }
		}
	    );
	
         });
</script> 

<? endif;?>