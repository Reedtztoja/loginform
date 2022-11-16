<?php
require('class/User.class.php');

$db = new mysqli('localhost', 'root', '', 'loginForm');
$user = new User("jkowalski","tajnehaslo");
//$user->register();
$user->login();
if($user->isAuth()) {
    echo "Użytkownik zalogowany poprawnie";
} else {
    echo "Błąd logowania";
}



?>