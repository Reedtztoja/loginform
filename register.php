<?php 
require_once('config.php');
if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    $user = new User($_REQUEST['login'], $_REQUEST['password']);
    $user->setfirstName($_REQUEST['firstName']);
    $user->setlastName($_REQUEST['lastName']);
    if($user->register()) {
        $twig->display("message.html.twig", ['message' => "Zarejestrowano poprawnie"]);
    } else {
        $twig->display("message.html.twig", ['message' => "Błąd w rejestracji"]);
    }
} else {
    $twig->display("register.html.twig");
}
?>