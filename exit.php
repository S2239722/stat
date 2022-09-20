<?php
setcookie("login",$_COOKIE["login"], time()  -10, "/");
setcookie("user",$_COOKIE["user"], time()  -36, "/");
header("Location: " . $_SERVER["HTTP_REFERER"]);



?>