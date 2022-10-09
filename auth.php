<?php
session_start();
class BD{
    public $login;
    public $password;


    public function __construct($login, $password) 
    {
        $this -> login = $login;
        $this -> password= $password;
    } 
        
    public function open()
    {
       //Считываем данные из базы данных
       $res = file_get_contents('BD/jsBd.json');
       //Декодируем в массив
       $dec = json_decode($res, true);
       //print_r($dec);
       unset($res);
       foreach($dec as $key=>$values )
       {
           if(in_array($this->login, $values)){
            if(in_array($this->password, $values)){
                setcookie("user",$key, time() + 36, "/");
                }else{
                setcookie("pas",'ошибка', time() + 10, "/");
            }}else{
                setcookie("login",'ошибка', time() + 10, "/");
                
            }
            
        }
     
    }
    

}  


//проверяем на заполнение обезательных полей
//проверка на асинхронность
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') //проверка на асинхронность
	{
    if (isset($_POST["login"]) && isset($_POST["password"]) ) 
	{ 
    if ($_POST['login'] == '') 
    {
        echo 'Не заполнено поле Имя, нажмите -Авторизатия- или обновите страницу';
        return; //проверяем наличие обязательных полей
    }
    if ($_POST['password'] == '') 
    {
        echo 'Не заполнено поле Password, нажмите -Авторизатия- или обновите страницу';
        return;
    } 
        $login=$_POST['login'];
        $password=$_POST['password'];
        $Sol = 'Soll';
        $password = md5($Sol.$password);
        $Nam = new BD($login, $password);
        $Nam->open();
        print_r("Hello  ".$login);
        $_SESSION['reg'] = 1;
    	return; //возвращаем сообщение пользователю
    }
    }









?>