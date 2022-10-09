<?php
setcookie("login",$_COOKIE["login"], time()  -1, "/");
setcookie("user",$_COOKIE["user"], time()  -36, "/");
header("Location: " . $_SERVER["HTTP_REFERER"]);



?>