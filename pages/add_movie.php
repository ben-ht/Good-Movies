<?php
require_once "../class/Autoloader.php";
Autoloader::register();
use movie\Template;
session_start();
ob_start();
?>
<?php $added = false ?>
<div id = "add-movie-page">
    <form id = "create-form" class = "create-form" method = "post" action = "add_movie.php" enctype = "multipart/form-data">
        <fieldset>
            <legend>Ajouter un film</legend>
            <?php include_once "add_movie_script.php" ?>
            <div class = "input-wrapper">
                <label for = "title-input">Titre</label>
                <?php if (!empty($_POST['title']) && !$added): ?>
                    <input type = "text" name = "title" id ="title-input" placeholder="Titre" value = "<?php echo $_POST['title'] ?>">
                <?php else: ?>
                    <input type = "text" name = "title" id ="title-input" placeholder="Titre">
                <?php endif ?>
            </div>

            <div class = "input-wrapper">
                <label for = "title-input">Poster</label>
                <input type = "file" name = "poster" id ="poster-input">
            </div>

            <div class = "input-wrapper">
                <label for = "date-input">Date</label>
                <?php if (!empty($_POST['date']) && !$added): ?>
                    <input type = "date" name = "date" id ="date-input" value = "<?php echo $_POST['date'] ?>">
                <?php else: ?>
                    <input type = "date" name = "date" id ="date-input">
                <?php endif ?>
            </div>

            <div class = "input-wrapper">
                <label for = "synopsis-input">Synopsis</label>
                <?php if (!empty($_POST['synopsis']) && !$added): ?>
                    <textarea name = "synopsis" id = "synopsis-input" placeholder="Synopsis"><?php echo $_POST['synopsis'] ?></textarea>
                <?php else: ?>
                    <textarea name = "synopsis" id = "synopsis-input" placeholder="Synopsis"></textarea>
                <?php endif ?>
                <p id = "word-count">Nombre de mots: /150</p>
            </div>
            <button type = "submit" class = "btn-main add-btn">Ajouter</button>
        </fieldset>
    </form>
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
