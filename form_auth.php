<?php
    
    require_once("index.php");
    //Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    //иначе выводим сообщение о том, что он уже авторизован
    
    if(empty($_COOKIE["reg"])):      
        
?>
 
 
        <h2>Форма авторизации</h2>
    <form id="form">
         <div class="mar10"><label>Имя: <input type="text" name="login" required="required"  value='Sektor' minlength="6" ></label>
         <span id = mes></span><span id = m></span></div>
	     <div class="mar10"><label>Password: <input type="password" name="password" minlength="6" required></label>
         <span id = mesp></span></div>

    </form> 
       
       <div id = ok></div>
       <div><button type="button" id="my_form_send">Войти</button></div>
         

<script> //отправка формы страницы без перезагрузки и получение ответа
        $('#my_form_send').click(function(){
	
	     $.post(
		      'auth.php', // адрес обработчика
              
		       $("#form").serialize(), // отправляемые данные  		
		       function(msg) { // получен ответ сервера  
			 
              var jsonData = JSON.parse(msg);
 
                if (jsonData.key == "1")
                {                   
                    $('#mes').html(jsonData.text); 
                }
                if (jsonData.key == "1")
                {                   
                    $('#mes').html(jsonData.text); 
                }
			    if (jsonData.key == "2")
                {
                                   
                    $('#mesp').html(jsonData.text); 
                }
                if (jsonData.key == "2")
                {
                                    
                    $('#mesp').html(jsonData.text); 
                }
                if (jsonData.key == "3")
                {
                    $('#form').hide('slow');                  
                    $('#ok').html(jsonData.text); 
                }
             
		}
	    );
       
         });
</script> 

    
 <?php
        endif;  
 ?>
