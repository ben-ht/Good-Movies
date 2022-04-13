<?php
require_once "../class/Autoloader.php";
Autoloader::register();
use movie\MoviesDB;

if (isset($_POST['title']) && isset($_POST['synopsis']) && isset($_FILES['poster'])){
    if (!empty($_POST['title']) && !empty($_POST['synopsis']) && ($_FILES['poster']['size'] != 0)) {

        $words = 1;
        for ($i = 0; $i < strlen($_POST['synopsis']); $i++){
            $char = $_POST['synopsis'][$i];
            if ($char == " "){
                $words++;
            }
        }
        if ($words > 150){
            echo '<p class = "form-error creation-error">Le synopsis ne peut pas contenir plus de 150 mots</p>';
        } elseif ($_FILES['poster']['error'] == 0) {
            $file_name = $_FILES['poster']['name'];
            $dir_name = $_SERVER['DOCUMENT_ROOT'] . "/GoodMovies/posters/";
            $full_name = $dir_name . $file_name;
            move_uploaded_file($_FILES['poster']['tmp_name'], $full_name);

            $db = new MoviesDB();
            if (isset($_POST['date']) && !empty($_POST['date'])) {
                $db->addMovie($_POST['title'], $file_name, $_POST['synopsis'], $_POST['date']);
            } else {
                $db->addMovie($_POST['title'], $file_name, $_POST['synopsis']);
            }
            echo '<p class = "confirm">Le film a été ajouté</p>';
            $added = true;
        } else {
            echo '<p class = "form-error creation-error">Erreur avec le fichier</p>';
        }
    } else {
        echo '<p class = "form-error creation-error">Erreur, Veuillez saisir le titre, le synopsis et l\'image</p>';
    }
}