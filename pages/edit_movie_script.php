<?php
require_once "../class/Autoloader.php";
Autoloader::register();
use movie\MoviesDB;

if (isset($_POST['title']) && isset($_POST['synopsis']) && isset($_GET['movie'])){
    if (!empty($_POST['title']) && !empty($_POST['synopsis']) && !empty($_GET['movie'])) {

        $db = new MoviesDB();

        $words = 1;
        for ($i = 0; $i < strlen($_POST['synopsis']); $i++){
            $char = $_POST['synopsis'][$i];
            if ($char == " "){
                $words++;
            }
        }
        if ($words > 150){
            echo '<p class = "form-error creation-error">Le synopsis ne peut pas contenir plus de 150 mots</p>';
        } elseif ($_FILES['poster']['size'] != 0){
            if ($_FILES['poster']['error'] == 0) {
                $file_name = $_FILES['poster']['name'];
                $dir_name = $_SERVER['DOCUMENT_ROOT'] . "/GoodMovies/posters/";
                $full_name = $dir_name . $file_name;
                move_uploaded_file($_FILES['poster']['tmp_name'], $full_name);

                if (isset($_POST['date']) && !empty($_POST['date'])) {
                    $db->editMovie($_POST['title'], $file_name, $_POST['synopsis'], $_GET['movie'], $_POST['date']);
                } else{
                    $db->editMovie($_POST['title'], $file_name, $_POST['synopsis'], $_GET['movie']);
                }
            } else {
                echo $_FILES['poster']['error'];
                echo '<p class = "form-error creation-error">Erreur, le fichier n\'a pas pu être uploadé</p>';
            }
        } else {
            if (!empty($_POST['image_src'])) {
                if (isset($_POST['date']) && !empty($_POST['date'])) {
                    $db->editMovie($_POST['title'], $_POST['image_src'], $_POST['synopsis'], $_GET['movie'], $_POST['date']);
                } else{
                    $db->editMovie($_POST['title'], $_POST['image_src'], $_POST['synopsis'], $_GET['movie']);
                }
                echo '<p class = "confirm">Le film a été modifié</p>';
            } else {
                echo '<p class = "form-error creation-error">Erreur, veuillez ajouter une image</p>';
            }
        }
    } else {
        echo '<p class = "form-error creation-error">Erreur, Veuillez remplir le titre et le synopsis</p>';
    }
}

