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
            header("Location: " . $_SERVER["HTTP_REFERER"]);    
		    exit();
	        endif;
			
        }

        //Если  login  не существует в базе регистрируем его
        $dec[$Name] = $Nam;
        file_put_contents('BD/jsBd.json',json_encode($dec));
		setcookie("reg",'Новый пользователь зарегитрирован', time() + 60, "/");	
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } 
 }



//Данные из формы
 $login=$_POST['login'];
 $password=$_POST['password'];
 $email=$_POST['email'];
 $Name=$_POST['Name'];     
 $confirm_password=$_POST['confirm_password']; 
 //Шифруем рароль
 $Sol = 'Soll';
 $password1 = md5($Sol.$password);
 //print_r($password1);
//создаем новые обьекты
$Nam = new Par($login, $password1, $email, $confirm_password);
$js = new Openrecord();

if($password == $confirm_password):
    $js->Openrec($Name,$login,$Nam);
else:
	setcookie("login1",'Не сходится пароль'.$password1, time() + 60, "/");
    header("Location: " . $_SERVER["HTTP_REFERER"]);
endif;



//setcookie("login",' ', time() + 60, "/");
//header("Location: " . $_SERVER["HTTP_REFERER"]);

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

//header("Location: " . $_SERVER["HTTP_REFERER"]);





?>