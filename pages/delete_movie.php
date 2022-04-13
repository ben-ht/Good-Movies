<?php
require_once "../class/Autoloader.php";
Autoloader::register();
use movie\MoviesDB;


if (isset($_POST['delete'])){
    if (!empty($_POST['delete'])) {
        $db = new MoviesDB();
        $db->deleteMovie($_POST['delete']);
        echo '<p class = "confirm">Le film a été supprimé</p>';
    } else {
        echo '<p class = "form-error creation-error">Erreur, le film n\'a pas pu etre supprimé</p>';
    }
}