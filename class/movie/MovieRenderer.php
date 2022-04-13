<?php

namespace movie;
require_once "Template.php";

/**
 * Génerate HTML code for movie cards and comments
 */
class MovieRenderer
{

    public function getHTML(){ ?>
    <div class="card vertical movie" style="width: 18rem;">
        <input type = "radio" name = "movie" value = "<?php echo $this->movie_id ?>" style ="display: none">
        <img class="card-img-top" src="<?php echo "/GoodMovies/posters/".$this->poster ?>" alt="<?php echo $this->title ?>">
        <div class="card-body">
            <div class = "card-movie-info">
                <div class = "title-rating-horizontal">
                    <h5 class="card-title"><?php echo $this->title ?></h5>
                    <?php
                    $db = new MoviesDB();
                    $rating = $db->getMovieRating($this->movie_id);
                    $this->generateStars($rating);
                    ?>
                </div>
                <h6 class="card-date" style = "font-style: oblique 20deg"><?php echo $this->fDay. " ". $this->fMonth. " ". $this->fYear ?></h6>
            </div>
            <p class="card-text"><?php echo $this->synopsis ?></p>
        </div>
        <?php if (isset($_SESSION['logged'])): ?>
        <button type = "submit" class = "edit-btn" name ="movie" form = "edit-form" value = "<?php echo $this->movie_id ?>">Modifier</button>
        <?php endif ?>
    </div>
<?php
    }

    public function getCommentHTML(){ ?>
        <div class = "comment">
            <div class = "comment-header">
                <div class = "nickname"><?php echo $this->nickname ?></div>
                    <div class = "rating-display">
                    <?php
                    if ($this->rating != null) {
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $this->rating) {
                                echo '<i class="fa-solid fa-star gold"></i>';
                            } else {
                                echo '<i class="fa-solid fa-star grey"></i>';
                            }
                        }
                    }
                    ?>
                    </div>
                <div class = "date"><?php echo $this->fTime ?></div>
            </div>
            <div class = "comment-text"><?php echo $this->content ?></div>
        </div>
<?php
    }

    public function getHorizontalCard(){ ?>
        <div class="card mb-3 diaporama-card movie">
            <input type = "radio" name = "movie" value = "<?php echo $this->movie_id ?>" style ="display: none">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo "/GoodMovies/posters/".$this->poster ?>" class="img-fluid rounded-start" alt="<?php echo $this->title ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class ="title-rating">
                            <h5 class="horizontal-card-title"><?php echo $this->title ?></h5>
                            <?php
                            $db = new MoviesDB();
                            $rating = $db->getMovieRating($this->movie_id);
                            $this->generateStars($rating);
                            ?>
                        </div>
                        <h6 class="card-date" style = "font-style: oblique 20deg"><?php echo $this->fDay. " ". $this->fMonth. " ". $this->fYear ?></h6>
                        <p class="horizontal-card-text"><?php echo $this->synopsis ?></p>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    public function getPoster(){ ?>
        <div class = "poster-card movie">
            <input type = "radio" name = "movie" value = "<?php echo $this->movie_id ?>" style ="display: none">
            <div class = "card-visible">
                <img src ="<?php echo "/GoodMovies/posters/".$this->poster ?>">
                <div class = "title-overlay">
                    <?php echo $this->title ?>
                </div>
            </div>
            <div class = "extra hidden">
                <div class = "title-hidden">
                    <?php echo $this->title ?>
                    <?php $db = new MoviesDB();
                    $rating = $db->getMovieRating($this->movie_id);
                    $this->generateStars($rating); ?>
                </div>
                <div class = "date-hidden">
                    <?php echo $this->fDay. " ". $this->fMonth. " ". $this->fYear ?>
                </div>
                <div class = "synopsis-hidden">
                    <?php echo $this->synopsis ?>
                </div>
            </div>
        </div>

        <?php
    }


    public function generateStars(int $rating=null){
        echo '<div class = "rating-display">';
        if ($rating != null) {
            for ($i = 0; $i < 5; $i++) {
                if ($i < $rating) {
                    echo '<i class="fa-solid fa-star gold"></i>';
                } else {
                    echo '<i class="fa-solid fa-star grey"></i>';
                }
            }
        }
        echo '</div>';
    }
}