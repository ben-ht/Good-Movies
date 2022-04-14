<?php
require_once "../class/Autoloader.php";
Autoloader::register();
use movie\Template;
use movie\MoviesDB;

$db = new MoviesDB();
$movie = $db->getMovie($_GET['movie']);
$rating = $db->getMovieRating($_GET['movie']);
session_start();
ob_start(); ?>
<div id = "movie-presentation">
    <div id ="poster">
    <img src = "<?php echo "/GoodMovies/posters/".$movie->poster ?>">
    </div>
    <div id = "movie-description">
        <h1 id = "title"><?php echo $movie->title ?></h1>
        <div id = "rating-display">
        <?php
        if ($rating != null) {
            for ($i = 0; $i < 5; $i++) {
                if ($i < $rating) {
                    echo '<i class="fa-solid fa-star gold"></i>';
                } else {
                    echo '<i class="fa-solid fa-star grey"></i>';
                }
            }
        }
        ?>
        </div>
        <h2 id = "date" style = "font-style: oblique 20deg"><?php echo $movie->fDay. " ". $movie->fMonth. " ". $movie->fYear ?></h2>
        <hr>
        <p id = "synopsis"><?php echo $movie->synopsis ?></p>
    </div>
</div>
<h3>Commentaires <?php echo "(".$db->getCommentsCount($_GET['movie']).")" ?></h3>
<hr style = "width: 85%; margin: auto">
<div id = "comments">
    <?php include_once "add_comment.php"; ?>
    <form id = "add-comment-form" method = "post" action = "see_movie_details.php?movie=<?php echo $_GET['movie'] ?>">
        <div id = "user-infos">
            <div class = "input-wrapper small-input">
                <label for = "user-nickname">Pseudonyme</label>
                <input type = "text" name = "user_nickname" id = "user-nickname">
            </div>
            <div class = "input-wrapper small-input">
                <label for = "user-email">Email</label>
                <input type = "text" name = "user_email" id = "user-email">
            </div>
        </div>
        <div class = "comment-rating">
            <label for = "comment-area" class = "comment-rating">Commentaire</label>
            <ul class = "rating">
                <i class="fa-solid fa-star editable"></i>
                <input type = "radio"  class = "star-input" name = "rating" value = "1">

                <i class="fa-solid fa-star editable"></i>
                <input type = "radio"  class = "star-input" name = "rating" value = "2">

                <i class="fa-solid fa-star editable"></i>
                <input type = "radio"  class = "star-input" name = "rating" value = "3">

                <i class="fa-solid fa-star editable"></i>
                <input type = "radio"  class = "star-input" name = "rating" value = "4">

                <i class="fa-solid fa-star editable"></i>
                <input type = "radio"  class = "star-input" name = "rating" value = "5">
            </ul>
        </div>
        <textarea name = "comment" id = "comment-area"></textarea>
        <button type = "submit" class = "btn-main add-btn">Ajouter un commentaire</button>
    </form>
</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php $db->getComments($_GET['movie']) ?>

<?php $content = ob_get_clean();
Template::render($content, "movie-page") ?>
