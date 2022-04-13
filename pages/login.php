<?php
require_once "../class/Autoloader.php";
Autoloader::register();
use movie\Template;
use movie\Logger;
session_start();
ob_start() ?>

<?php $logger = new Logger();
if (isset($_POST['username']) && isset($_POST['password'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $log = $logger->log($_POST['username'], $_POST['password']);
        if ($log['grant']) {
            $_SESSION['logged'] = true;
            header("Location: /GoodMovies/index.php");
        } else {
            $logger->generateLoginForm($log['error']);
        }
    } else {
        if ((!empty($_POST['username']) && empty($_POST['password']))) {
            $logger->generateLoginForm("Veuillez remplir le mot de passe");
        } else if ((empty($_POST['username']) && !empty($_POST['password']))){
            $logger->generateLoginForm("Veuillez remplir le nom d'utilisateur");
        } else {
            $logger->generateLoginForm("Veuillez remplir les champs");
        }
    }
} else {
    $logger->generateLoginForm();
}
?>


<?php $content = ob_get_clean();
Template::render($content, "login-page");
