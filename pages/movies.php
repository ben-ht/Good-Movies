<?php
require_once "../class/Autoloader.php";
use movie\Template;
use movie\MoviesDB;
Autoloader::register();
session_start();
ob_start(); ?>

<form id = "search-form" method = "get" action = "movies.php">
    <div id = "search-bar">
        <label for = "search-input" style = "display: none">Movie</label>
        <input type = "text" name = "movie_name" placeholder="Rechercher..." id = "search-input"  <?php echo isset($_GET['movie_name'])? "value=".$_GET['movie_name'] : "" ?>>
        <button type = "submit" id = "search-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if (isset($_GET['sort'])){
                if ($_GET['sort'] == "rating") echo "Mieux notés";
                if ($_GET['sort'] == "title") echo "A - Z";
                if ($_GET['sort'] == "oldest") echo "Plus ancien";
                if ($_GET['sort'] == "most-recent") echo "Plus récent";
                if ($_GET['sort'] == "") echo "Tri";
            } else echo "Tri";
            ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
            <li>
                <a class="dropdown-item">Par défaut</a>
                <input type = "radio" name = "sort" value = "" style = "display: none">
            </li>
            <li>
                <a class="dropdown-item">Mieux notés</a>
                <input type = "radio" name = "sort" value = "rating" style = "display: none">
            </li>
            <li>
                <a class="dropdown-item">A - Z</a>
                <input type = "radio" name = "sort" value = "title" style = "display: none">
            </li>
            <li>
                <a class="dropdown-item">Plus récent</a>
                <input type = "radio" name = "sort" value = "most-recent" style = "display: none">
            </li>
            <li>
                <a class="dropdown-item">Plus ancien</a>
                <input type = "radio" name = "sort" value = "oldest" style = "display: none">
            </li>
        </ul>
    </div>
</form>


<?php include_once "delete_movie.php" ?>
<?php

$db = new MoviesDB();
if (isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
} else {
    $page = 1;
}


if (isset($_GET['movie_name']) && !empty($_GET['movie_name'])){
    if (isset($_GET['sort']) && !empty($_GET['sort'])){
        $db->getMovies($page, $_GET['movie_name'], $_GET['sort']);
    } else {
        $db->getMovies($page, $_GET['movie_name']);
    }
    $paginationValues = $db->getPaginationValues($page, $_GET['movie_name']);
} else {
    if (isset($_GET['sort']) && !empty($_GET['sort'])){
        $db->getMovies($page, null, $_GET['sort']);
    } else {
        $db->getMovies($page);
    }
    $paginationValues = $db->getPaginationValues($page);
}

if (isset($_SESSION['logged'])) : ?>
    <form id = "edit-form" method = "get" action = "edit_movie.php"></form>
<?php endif; ?>

<nav>
    <ul class = "pagination">
        <li class = "page-item <?php echo ($page == 1)? "disabled" : "" ?>">
            <a href = "/GoodMovies/pages/movies.php?<?php echo ((isset($_GET['movie_name']) && !empty($_GET["movie_name"]))? "movie_name=".$_GET['movie_name'] : "") ?><?php echo (isset($_GET['sort'])? "&sort=".$_GET['sort'] : "") ?>&page=<?php echo $page-1 ?>" class = "page-link">«</a>
        </li>
        <?php for ($i = 1; $i <= $paginationValues['nb_pages']; $i++) : ?>
        <li class = "page-item <?php echo ($i == $page)? "active": "" ?>">
            <a href = "/GoodMovies/pages/movies.php?<?php echo ((isset($_GET['movie_name']) && !empty($_GET["movie_name"]))? "movie_name=".$_GET['movie_name'] : "") ?><?php echo (isset($_GET['sort'])? "&sort=".$_GET['sort'] : "") ?>&page=<?php echo $i ?>" class = "page-link"><?php echo $i ?></a>
        </li>
        <?php endfor ?>
        <li class = "page-item <?php echo ($page == $paginationValues['nb_pages'])? "disabled" : "" ?>">
            <a href = "/GoodMovies/pages/movies.php?<?php echo ((isset($_GET['movie_name']) && !empty($_GET["movie_name"]))? "movie_name=".$_GET['movie_name'] : "") ?><?php echo (isset($_GET['sort'])? "&sort=".$_GET['sort'] : "") ?>&page=<?php echo $page+1?>" class = "page-link">»</a>
        </li>

    </ul>
</nav>

<?php $content = ob_get_clean();
Template::render($content); ?>
