<?php
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
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                }else{
                setcookie("pas",'ошибка', time() + 10, "/");
                header("Location: " . $_SERVER["HTTP_REFERER"]); }
            }else{
                setcookie("login",'ошибка', time() + 10, "/");
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
            
        }
       /* if(in_array($this->password, $values)){
             
            setcookie("user",$key, time() + 36, "/");
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            
              
            }else{
            setcookie("pas",'ошибка', time() + 60, "/");
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            }*/
    }
    

}  
    


$login=$_POST['login'];
$password=$_POST['password'];
$Sol = 'Soll';
$password = md5($Sol.$password);
$Nam = new BD($login, $password);
$Nam->open();




?>