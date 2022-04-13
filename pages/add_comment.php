<?php
require_once "../class/Autoloader.php";
Autoloader::register();
use movie\MoviesDB;

$send = false;
$db = new MoviesDB();
if (!empty($_POST['user_nickname']) && !empty($_POST['user_email']) && !empty($_POST['comment'])){
    $send = true;
    if (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){
        $check = $db->checkUser($_POST['user_nickname'], $_POST['user_email']);
         if ($check[0]){
             $tmpStr = str_replace(" ", "",$_POST['comment']);
            if (strlen($tmpStr) < 150){
                if (isset($_POST['rating']) && !empty($_POST['rating'])) {
                    $db->addComment($_POST['user_nickname'], $_POST['user_email'], $_POST['comment'], $_GET['movie'], $_POST['rating']);
                } else {
                    $db->addComment($_POST['user_nickname'], $_POST['user_email'], $_POST['comment'], $_GET['movie']);
                }
            }
         } else {
             echo "<p class = 'form-error'>$check[1]</p>";
         }
    } else {
        echo "<p class = 'form-error'>L'email n'est pas valide</p>";
        $send = false;
    }
} else if (!empty($_POST['user_nickname']) || !empty($_POST['user_email']) || !empty($_POST['comment'])){
    echo "<p class = 'form-error'>Veuillez remplir tous les champs</p>";
}
