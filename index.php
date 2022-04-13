<?php
require_once "class/Autoloader.php";
use movie\Template;
use movie\MoviesDB;
Autoloader::register();
session_start();
ob_start();
$db = new MoviesDB() ?>



<form class = "select-movie" id = "index-form" method ="get" action = "pages/movie.php">
    <div class = "pos">

    </div>
    <div id = "recently-added">
            <h5 class = "div-title sidebar-title">
                <a href = "pages/movies.php">Derniers ajouts</a>
            </h5>
            <?php $db->getPosterCards(4) ?>
    </div>

    <div id = "diaporama-header">Vous pourriez aimer...</div>
    <div id = "diaporama">
        <?php $db->getDiaporamaCards(5); ?>
    </div>

    <div id = "previous-btn">
        <img src = "css/images/chevron-gauche.png">
    </div>

    <div id = "next-btn">
        <img src = "css/images/chevron-droit.png">
    </div>

    <div id = "best-rated-wrapper">
        <h5 class = "div-title">
            <a href = "pages/movies.php?sort=rating">Les mieux notés</a>
        </h5>
        <div id = "best-rated">
            <?php echo $db->getBestRated() ?>
        </div>
    </div>
</form>
<script>
</script>
<?php $content = ob_get_clean();
Template::render($content, "index") ?>
