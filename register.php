<?php
session_start();

class  Par{
	
    public $login;
    public $password;
    public $email;
    public $confirm_password;
   
	
	
	public function __construct($login, $password, $email, $confirm_password)
    {
     $this -> login = $login;
     $this -> password= $password;
     $this -> email = $email;
     $this -> confirm_password = $confirm_password;
     
    }
}

class  Openrecord{
       public $Name;
	   public $Nam = array();

public function Openrec($Name,$login,$Nam)
    {
	   

       //Считываем данные из базы данных
       $res = file_get_contents('BD/jsBd.json');
       //Декодируем в массив
       $dec = json_decode($res, true);
       unset($res);
       foreach($dec as $key=>$values )
       {
           if(in_array($login, $values)):
			setcookie("login",'ошибка', time() + 10, "/");
            echo "Подобный логин уже существует, попробуйте еще раз!" ;  
		    exit();
	        endif;
			
        }

        //Если  login  не существует в базе регистрируем его
        $dec[$Name] = $Nam;
        file_put_contents('BD/jsBd.json',json_encode($dec));
		setcookie("reg",$login, time() + 60, "/");	
    } 
 }
 //проверяем наличие обязательных полей
 //проверка на асинхронность
 if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
 {
 if (isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["email"]) ) 
 {
 if(!empty($_COOKIE["reg"])) 
    {
     echo ('Hello  '.$_COOKIE["reg"].',если вы хотите зарегистрироватся как новый пользователь немножко подождите!');
     return;
    }   
 if ($_POST['login'] == '') 
 {
     echo 'Не заполнено поле login, нажмите -Регистрация- или обновите страницу';
     return;
 }
 if ($_POST['password'] == '') 
 {
     echo 'Не заполнено поле Password, нажмите -Регистрация- или обновите страницу';
     return;
 }
 if (!preg_match('/^([a-z]|\d|_)+$/i', $_POST['password']))
 {
   echo "Не правильно заполненно поле Password, нажмите -Регистрация- или обновите страницу";
   return;
 }
 
 if ($_POST['email'] == '') 
 {
     echo 'Не заполнено поле Email, нажмите -Регистрация- или обновите страницу';
     return;
 } 
 if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
 {
     echo 'Не правильно заполненно поле Email, нажмите -Регистрация- или обновите страницу';
     return;
 } 
//Данные из формы
$login=$_POST['login'];
$password=$_POST['password'];
$email=$_POST['email'];
$Name=$_POST['name'];     
$confirm_password=$_POST['confirm_pass']; 
//Шифруем рароль
$Sol = 'Soll';
$password1 = md5($Sol.$password);
$confirm_password1 = md5($Sol.$confirm_password);
//создаем новые обьекты
$Nam = new Par($login, $password1, $email, $confirm_password1);
$js = new Openrecord();

if($password == $confirm_password):
   $js->Openrec($Name,$login,$Nam);
   echo ('Hello ' .$login);
   return; //возвращаем сообщение пользователю
else:
   
   echo "Не сходится пароль" ;  
endif;

 }
 }
//Проверка на запись файла 
switch (json_last_error()) {
	case JSON_ERROR_NONE:
	break;
	case JSON_ERROR_DEPTH:
		echo 'Достигнута максимальная глубина стека';
	break;
	case JSON_ERROR_STATE_MISMATCH:
		echo 'Некорректные разряды или несоответствие режимов';
	break;
	case JSON_ERROR_CTRL_CHAR:
		echo 'Некорректный управляющий символ';
	break;
	case JSON_ERROR_SYNTAX:
		echo 'Синтаксическая ошибка, некорректный JSON';
	break;
	case JSON_ERROR_UTF8:
		echo 'Некорректные символы UTF-8, возможно неверно закодирован';
	break;
	default:
		echo 'Неизвестная ошибка';
	break;

	
}







?>