<?php
require_once('vendor/autoload.php');
require('class/User.class.php');
$loader = new \Twig\Loader\ArrayLoader([
    'index' => "Hello {{name}}!",
]);
$twig = new \Twig\Environment($loader);
echo $twig->render('index', ['name' => 'Patryk']);

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