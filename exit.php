<?php

setcookie("user",' ', time() + 36, "/");
header("Location: " . $_SERVER["HTTP_REFERER"]);



?>