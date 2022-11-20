<?php
session_start();

class  Record
{
        public $Name;
          
    public function open($login,$password2)
    {
       //Считываем данные из базы данных
       $res = file_get_contents('BD/jsBd.json');
       //Декодируем в массив
       $dec = json_decode($res, true);
       //unset($res);
      
       $cod = false;
      
       
       foreach($dec as $key=>$values )
       {
        
        if( $dec[$key]['login'] == $login){
            $cod = true; 
           }; 
        
        if(in_array($login, $values)){
          
            $d = $dec[$key]['password'];
            if($d != $password2){
            $rd = array('key' => 2,'text'=> 'Поле Password не верно');
            echo json_encode($rd);
            }else{
            setcookie("reg",$key, time() + 60, "/");   
            $data = array('key' => 3,'text'=> '  Hello '.$key);
            echo json_encode($data);
           
            
            };
       
        };          
      };
      
      if($cod != true){
         $rs = array('key' => 1,'text'=> '  Подобного login не существует, попробуйте еще раз!');
         echo json_encode($rs);  
       };
    
    }
};


       
//проверяем на заполнение обезательных полей
//проверка на асинхронность
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') //проверка на асинхронность
	{
    if (isset($_POST["login"]) && isset($_POST["password"]) ) 
	{
        
    if ($_POST['login'] == '') 
    {
        $res = array('key' => 1,'text'=> '  Не заполнено поле Имя, нажмите -Авторизатия- или обновите страницу');
        echo json_encode($res);
        return; //проверяем наличие обязательных полей  
    }
    if (strlen($_POST['login']) < 6)
    {
        $res = array('key' => 1,'text'=> '  Не до конца заполнено поле Имя, должно состоять из 6 символов');
        echo json_encode($res);
        return; //проверяем наличие обязательных полей
    }
   
    if ($_POST['password'] == '') 
    {
        $res = array('key' => 2,'text'=> '  Не заполнено поле Password, нажмите -Авторизатия- или обновите страницу');
        echo json_encode($res);
        return;//проверяем наличие 6 символов
    } 
    if (strlen($_POST['password']) < 6)
    {
        $res = array('key' => 2,'text'=> '  Не до конца заполнено поле Password, должно состоять из 6 символов');
        echo json_encode($res);
        return; //проверяем наличие 6 символов
    }



        $login=$_POST['login'];
        $password=$_POST['password'];
        
        $Sol = 'Soll';
        $password2 = md5($Sol.$password);
        $Nm = new Record();
        $Nm->Open($login, $password2);
       
     
    }
    }

?>