<?php
require_once "../class/Autoloader.php";
Autoloader::register();
use movie\Template;
use movie\MoviesDB;
$db = new MoviesDB();
$movie = $db->getMovie($_GET['movie']);
session_start();
ob_start(); ?>

    <div id = "add-movie-page">
        <form id = "edit-page-form" class = "create-form" method = "post" action = "edit_movie.php?movie=<?php echo $_GET['movie'] ?>" enctype = "multipart/form-data">
            <fieldset>
                <legend>Modifier <?php echo $movie->title ?></legend>
                <?php include_once "edit_movie_script.php" ?>
                <div class = "input-wrapper">
                    <label for = "title-input">Titre</label>
                    <input type = "text" name = "title" id ="title-input" placeholder="Titre" value = "<?php echo $movie->title ?>">
                </div>

                <div class = "input-wrapper">
                    <label for = "title-input">Poster</label>
                    <input type = "file" name = "poster" id ="poster-input">
                    <input value = "<?php echo $movie->poster ?>" name = "image_src" id = "image-src" style = "display: none">
                </div>

                <div class = "input-wrapper">
                    <label for = "date-input">Date</label>
                    <input type = "date" name = "date" id ="date-input" value = "<?php echo $movie->release_date ?>">
                </div>

                <div class = "input-wrapper">
                    <label for = "synopsis-input">Synopsis</label>
                    <textarea name = "synopsis" id = "synopsis-input" placeholder="Synopsis"><?php echo $movie->synopsis ?></textarea>
                    <p id = "word-count">Nombre de mots: /150</p>
                </div>
                <div id = "update-buttons">
                    <button type = "submit" name = "delete" class = "delete-btn btn-main" value = "<?php echo $_GET['movie'] ?>" form = "delete-form">Supprimer</button>
                    <button type = "submit" class = "btn-main" id = "edit-btn" form = "edit-page-form">Modifier</button>
                </div>
            </fieldset>
        </form>

        <form id = "delete-form" method = "post" action = "movies.php"></form>

        <div class="card" id= "card-preview" style="width: 18rem;">
            <img class="card-img-top" id = "poster-display" src="">
            <div class="card-body">
                <div class = "card-movie-info">
                    <h5 class="card-title" id = "title-display"></h5>
                    <h6 class="card-date" id ="date-display" style = "font-style: oblique 20deg"></h6>
                </div>
                <p class="card-text" id = "synopsis-display"></p>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean();
Template::render($content, "edit-page") ?>
<?php
