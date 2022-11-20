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

public function Openrec($Name,$login,$Nam,$email,$password1)
    {
	   

       //Считываем данные из базы данных
       $res = file_get_contents('BD/jsBd.json');
       //Декодируем в массив
       $dec = json_decode($res, true);
       unset($res);
       foreach($dec as $key=>$values )
       {
           if(in_array($login, $values)):
			   
            $res = array('key' => 1,'text'=> '  Подобный логин уже существует, попробуйте еще раз!');
            echo json_encode($res);
          
		    exit();
	        endif;
		   
            if(in_array($email, $values)):
                
                $res = array('key' => 3,'text'=> '  Подобный email уже существует, попробуйте еще раз!');
                echo json_encode($res);
              
            exit();
            endif;

            if(in_array($password1, $values)):
              
               $res = array('key' => 2,'text'=> '  Подобный password уже существует, попробуйте еще раз!');
               echo json_encode($res);
             
           exit();
           endif;
        }




      //Если  login  не существует в базе регистрируем его
      $dec[$Name] = $Nam;   
  if (file_exists('BD/jsBd.json')){
        file_put_contents('BD/jsBd.json',json_encode($dec));
       // header('Location: '. $_SERVER['HTTP_REFERER']);
		  setcookie("reg",$Name, time() + 60, "/");
        $red = array('key' => 4,'text'=> '  Hello  '.$Name);
        echo json_encode($red);
        };
        
        

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
    $res = array('key' => 1,'text'=> '  Не заполнено поле login, нажмите -Регистрация- или обновите страницу');
    echo json_encode($res);
     return;
 }
 if (iconv_strlen($_POST['login']) < 6)
    {
        $res = array('key' => 1,'text'=> '  Не до конца заполнено поле Имя, должно состоять из 6 символов');
        echo json_encode($res);
        return; //проверяем наличие обязательных полей
    }
    
    if (!preg_match('/^([а-пр-яa-zA-Z]|\d|_)+$/', $_POST['login']))
      {
         $res = array('key' => 1,'text'=> '  Поле login не должен содежать пробелы');
         echo json_encode($res);
         return;
      }
   
 if ($_POST['password'] == '') 
 {
    $res = array('key' => 2,'text'=> '  Не заполнено поле Password, нажмите -Регистрация- или обновите страницу');
    echo json_encode($res);
     return;
 }
 if (strlen($_POST['password']) < 6)
    {
        $res = array('key' => 2,'text'=> '  Не до конца заполнено поле Password, должно состоять мин из 6 символов');
        echo json_encode($res);
        return; //проверяем наличие обязательных полей
    }
 if (!preg_match('/^([a-z]|\d|)+$/i', $_POST['password']))
 {
    $res = array('key' => 2,'text'=> '  Поле Password не должен содержать пробелы');
    echo json_encode($res);
    return;
 }
 
 if ($_POST['email'] == '') 
 {
    $res = array('key' => 3,'text'=> '  Не заполнено поле Email, нажмите -Регистрация- или обновите страницу');
    echo json_encode($res);
    return;
 } 
 if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
 {
    $res = array('key' => 3,'text'=> '  Не правильно заполнено поле Email, нажмите -Регистрация- или обновите страницу');
    echo json_encode($res);
    return;
 } 
 if ($_POST['name'] == '')
 {
    $res = array('key' => 6,'text'=> '  Не заполнено поле Имя, нажмите -Регистрация- или обновите страницу');
    echo json_encode($res);
    return;
 } 
 if (iconv_strlen($_POST['name']) < 2)
 {
    $res = array('key' => 6,'text'=> '  Не до конца заполнено поле Имя, должно быть 2 символа');
    echo json_encode($res);
    return;
 }
 if (iconv_strlen($_POST['name']) > 2)
 {
    $res = array('key' => 6,'text'=> '  Поле Имя должно быть не более 2-х символа');
    echo json_encode($res);
    return;
 }
 if (!preg_match('/^([а-пр-яa-zA-Z]|\d|)+$/', $_POST['name']))
 {
    $res = array('key' => 6,'text'=> '  Поле Имя не должно содержать пробелы');
    echo json_encode($res);
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
   $js->Openrec($Name,$login,$Nam,$email,$password1);
   
   
   return; //возвращаем сообщение пользователю
else:
    $res = array('key' => 5,'text'=> '  Не сходится пароль');
    echo json_encode($res);
    
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