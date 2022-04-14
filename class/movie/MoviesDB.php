<?php

namespace movie;
require_once $_SERVER['DOCUMENT_ROOT']."/GoodMovies/class/Autoloader.php";
use PDO;

\Autoloader::register();

/**
 *All functions related to database
 */

class MoviesDB
{
    private $pdo;

    /**
     * Start a connection to database
     */

    public function __construct(){
        try {
            $dsn = 'mysql:dbname=movies;host=127.0.0.1;port=3306';
            $this->pdo = new PDO($dsn, "root", "123");
        }
        catch(\Exception $e) {
            die("Erreur: " . $e->getMessage());
        }
    }

    /**
     * @param int $currentPage Used to display movies on several pages
     * @param string|null $searchPattern Search for movies with it in the title
     * @param string|null $sort Option selected by the user
     */

    public function getMovies(int $currentPage, string $searchPattern=null, string $sort=null): void{
        if ($sort != "rating") {
            $query = "SELECT *, DAY(release_date) as fDay, YEAR(release_date) as fYear,CASE MONTH(release_date)
            WHEN 1 THEN 'Janvier'
            WHEN 2 THEN 'Février'
            WHEN 3 THEN 'Mars'
            WHEN 4 THEN 'Avril'
            WHEN 5 THEN 'Mai'
            
            WHEN 6 THEN 'Juin'
            WHEN 7 THEN 'Juillet'
            WHEN 8 THEN 'Août'
            WHEN 9 THEN 'Septembre'
            WHEN 10 THEN 'Octobre'
            WHEN 11 THEN 'Novembre'
            WHEN 12 THEN 'Décembre'
            ELSE 'Date de sortie inconnue'
        END as fMonth 
        FROM movie WHERE title LIKE :searchPattern";

            $value = "";
            if ($sort == "") $value = "movie_id DESC";
            if ($sort == "title") $value = "title";
            if ($sort == "most-recent") $value = "release_date DESC";
            if ($sort == "oldest") $value = "-release_date DESC";
            $query .= " ORDER BY $value";
        }

        else{
            $query = "SELECT title, release_date, poster, synopsis, movie_id, SUM(rating)/COUNT(rating) AS movie_rating, DAY(release_date) as fDay, YEAR(release_date) as fYear,CASE MONTH(release_date)
            WHEN 1 THEN 'Janvier'
            WHEN 2 THEN 'Février'
            WHEN 3 THEN 'Mars'
            WHEN 4 THEN 'Avril'
            WHEN 5 THEN 'Mai'
            WHEN 6 THEN 'Juin'
            WHEN 7 THEN 'Juillet'
            WHEN 8 THEN 'Août'
            WHEN 9 THEN 'Septembre'
            WHEN 10 THEN 'Octobre'
            WHEN 11 THEN 'Novembre'
            WHEN 12 THEN 'Décembre'
            ELSE 'Date de sortie inconnue'
        END as fMonth 
        FROM movie LEFT OUTER JOIN comments USING (movie_id) WHERE title LIKE :searchPattern GROUP BY movie.movie_id ORDER BY movie_rating DESC, title";
        }

        $values = $this->getPaginationValues($currentPage, $searchPattern);

        $query .= " LIMIT :first, :moviesPerPage";
        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':searchPattern', '%'.$searchPattern.'%');
        $statement->bindValue(':first', $values['first'], PDO::PARAM_INT);
        $statement->bindValue(':moviesPerPage', $values['movies_per_page'], PDO::PARAM_INT);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\movie\MovieRenderer"); ?>
        <form id = "movies-wrapper" class = "select-movie" method ="get" action = "see_movie_details.php">
        <?php foreach($results as $movie){
            $movie->getHTML();
        } ?>
        </form>
<?php
    }

    /**
     * Display the 3 best rated movies
     */

    public function getBestRated(): void{
        $query = "SELECT title, release_date, poster, synopsis, movie_id, SUM(rating)/COUNT(rating) AS movie_rating, DAY(release_date) as fDay, YEAR(release_date) as fYear,CASE MONTH(release_date)
            WHEN 1 THEN 'Janvier'
            WHEN 2 THEN 'Février'
            WHEN 3 THEN 'Mars'
            WHEN 4 THEN 'Avril'
            WHEN 5 THEN 'Mai'
            WHEN 6 THEN 'Juin'
            WHEN 7 THEN 'Juillet'
            WHEN 8 THEN 'Août'
            WHEN 9 THEN 'Septembre'
            WHEN 10 THEN 'Octobre'
            WHEN 11 THEN 'Novembre'
            WHEN 12 THEN 'Décembre'
            ELSE 'Date de sortie inconnue'
        END as fMonth 
        FROM movie INNER JOIN comments USING (movie_id) WHERE rating IS NOT NULL GROUP BY comments.movie_id ORDER BY movie_rating DESC, title LIMIT :limit";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':limit', 3, PDO::PARAM_INT);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\movie\MovieRenderer");
        foreach ($results as $movie){
            $movie->getHTML();
        }
    }

    /**
     * Get movies to be displayed as a slideshow
     * @param int $limit Number of movies in the diaporama
     */

    public function getDiaporamaCards(int $limit): void{
        $query = "SELECT *, DAY(release_date) as fDay, YEAR(release_date) as fYear,CASE MONTH(release_date)
            WHEN 1 THEN 'Janvier'
            WHEN 2 THEN 'Février'
            WHEN 3 THEN 'Mars'
            WHEN 4 THEN 'Avril'
            WHEN 5 THEN 'Mai'
            WHEN 6 THEN 'Juin'
            WHEN 7 THEN 'Juillet'
            WHEN 8 THEN 'Août'
            WHEN 9 THEN 'Septembre'
            WHEN 10 THEN 'Octobre'
            WHEN 11 THEN 'Novembre'
            WHEN 12 THEN 'Décembre'
            ELSE 'Date de sortie inconnue'
        END as fMonth 
        FROM movie ORDER BY RAND() LIMIT :limit";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\movie\MovieRenderer");
        foreach ($results as $movie){
            $movie->getHorizontalCard();
        }
    }

    /**
     * Get movies in another style
     * @param int $limit Number of movies
     */

    public function getPosterCards(int $limit): void{
        $query = "SELECT *, DAY(release_date) as fDay, YEAR(release_date) as fYear,CASE MONTH(release_date)
            WHEN 1 THEN 'Janvier'
            WHEN 2 THEN 'Février'
            WHEN 3 THEN 'Mars'
            WHEN 4 THEN 'Avril'
            WHEN 5 THEN 'Mai'
            WHEN 6 THEN 'Juin'
            WHEN 7 THEN 'Juillet'
            WHEN 8 THEN 'Août'
            WHEN 9 THEN 'Septembre'
            WHEN 10 THEN 'Octobre'
            WHEN 11 THEN 'Novembre'
            WHEN 12 THEN 'Décembre'
            ELSE 'Date de sortie inconnue'
        END as fMonth 
        FROM movie ORDER BY movie_id DESC LIMIT :limit";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\movie\MovieRenderer");
        foreach ($results as $movie){
            $movie->getPoster();
        }
    }

    /**
     * Select 1 movie in the database and return all its information
     *
     * @param int $id Id of the movie
     * @return array|false|void All information about a movie
     */
    public function getMovie(int $id){
        $query = "SELECT *, DAY(release_date) as fDay, YEAR(release_date) as fYear, CASE MONTH(release_date)
            WHEN 1 THEN 'Janvier'
            WHEN 2 THEN 'Février'
            WHEN 3 THEN 'Mars'
            WHEN 4 THEN 'Avril'
            WHEN 5 THEN 'Mai'
            WHEN 6 THEN 'Juin'
            WHEN 7 THEN 'Juillet'
            WHEN 8 THEN 'Août'
            WHEN 9 THEN 'Septembre'
            WHEN 10 THEN 'Octobre'
            WHEN 11 THEN 'Novembre'
            WHEN 12 THEN 'Décembre'
            ELSE 'Date de sortie inconnue'
        END as fMonth
        FROM movie WHERE movie_id = :id";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchAll(PDO::FETCH_CLASS, "\movie\MovieRenderer")[0];
    }


    /**
     * Check if the email or nickname the user entered already exists in the database
     *
     * @param string $nickname User input
     * @param string $email User input
     * @return array 1st parameter (boolean): True if the email or nickname is already used. 2nd parameter (string): Error to be displayed
     */

    public function checkUser(string $nickname, string $email): array{
        $bool = true;
        $error = "";
        $query = "SELECT nickname, email FROM users WHERE nickname = :nickname";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':nickname', $nickname);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetch(PDO::FETCH_OBJ);
        if ($results->email != $email) {
            $error = "Ce pseudonyme est déja utilisé";
            $bool = false;
        }

        $query2 = "SELECT nickname, email FROM users WHERE email = :email";
        $statement2 = $this->pdo->prepare($query2);
        $statement2->bindValue(':email', $email);
        $statement2->execute() or die(var_dump($statement2->errorInfo()));
        $results2 = $statement2->fetch(PDO::FETCH_OBJ);
        if ($results2->nickname != $nickname) {
            $error = "Cet email est déja utilisé";
            $bool = false;
        }
        return array($bool, $error);
    }

    /**
     * Search for a User ID given its nickname
     *
     * @param string $nickname User nickname
     */
    public function getUserID(string $nickname): int{
        $query = "SELECT user_id FROM users WHERE nickname = :nickname";
        $statement= $this->pdo->prepare($query);
        $statement->bindValue(':nickname', $nickname);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetch(PDO::FETCH_OBJ);
        return $results->user_id;
    }

    /**
     * Add User and his comment in the database
     *
     * @param string $nickname User nickname
     * @param string $email User email
     * @param string $comment
     * @param int $movieId Movie on which the comment is posted
     * @param int|null $rating Rating of the movie by user on a range from 1 to 5
     */

    public function addComment(string $nickname, string $email, string $comment, int $movieId, int $rating=null): void{
        $query = "INSERT INTO users (nickname, email) SELECT :nickname, :email FROM DUAL WHERE NOT EXISTS(SELECT 1 FROM users WHERE nickname = :nickname AND email = :email) ";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':nickname', $nickname);
        $statement->bindValue(':email', $email);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        $userID = $this->getUserID($nickname);
        if ($rating != null) {
            $query2 = "INSERT INTO comments (content, rating, movie_id, user_id) VALUES (:comment,:rating,:movieId,:userId)";
        } else {
            $query2 = "INSERT INTO comments (content, movie_id, user_id) VALUES (:comment,:movieId,:userId)";
        }
        $statement2 = $this->pdo->prepare($query2);
        $statement2->bindValue(':comment', $comment);
        if ($rating != null) {
            $statement2->bindValue(':rating', $rating, PDO::PARAM_INT);
        }
        $statement2->bindValue(':movieId', $movieId, PDO::PARAM_INT);
        $statement2->bindValue(':userId', $userID, PDO::PARAM_INT);
        $statement2->execute() or die(var_dump($statement2->errorInfo()));
    }

    /**
     * Get the rating of a given movie
     *
     * @param int $movieId Movie ID
     * @return int|null Movie rating
     */

    public function getMovieRating(int $movieId): int|null{
        $query = "SELECT SUM(rating)/COUNT(rating) as movie_rating FROM comments WHERE movie_id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $movieId);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetch()['movie_rating'];
    }

    /**
     * Display all comments of a movie
     *
     * @param int $movieId Movie from which we want the comments
     */

    public function getComments(int $movieId): void{
        $query = "SELECT *, DATE_FORMAT(time, '%d/%m/%Y') AS fTime from comments INNER JOIN users USING (user_id)  WHERE movie_id = :movieId ORDER BY time DESC";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':movieId', $movieId, PDO::PARAM_INT);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\movie\movieRenderer"); ?>
        <div id = "comments-list">
        <?php foreach ($results as $comment){
            $comment->getCommentHTML();
        } ?>
        </div>
        <?php
    }

    /**
     * Get the number of comments of a movie
     *
     * @param int $movieId Movie from which we want the comments count
     * @return int
     */

    public function getCommentsCount(int $movieId): int{
        $query = "SELECT count(comment_id) AS nb_comments from comments WHERE movie_id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $movieId, PDO::PARAM_INT);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetch();
        return $results['nb_comments'];
    }


    /**
     * Add a movie to database
     *
     */

    public function addMovie(string $title, string $poster, string $synopsis, string $date=null): void{
        $query = "INSERT INTO movie(title, release_date, poster, synopsis) VALUES (:title, :releaseDate, :poster, :synopsis)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':releaseDate', $date);
        $statement->bindValue(':poster', $poster);
        $statement->bindValue(':synopsis', $synopsis);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    /**
     * Edit an already existing movie in the database
     *
     */

    public function editMovie(string $title, string $poster, string $synopsis, int $id,  string $date=null){
        $query = "UPDATE movie SET title = :title, release_date = :releaseDate, poster = :poster, synopsis = :synopsis WHERE movie_id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':releaseDate', $date);
        $statement->bindValue(':poster', $poster);
        $statement->bindValue(':synopsis', $synopsis);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    /**
     * Delete a movie from database
     *
     * @param int $id Id of the movie to be deleted
     */

    public function deleteMovie(int $id){
        $query = "DELETE FROM comments WHERE movie_id = $id";
        $statement = $this->pdo->prepare($query);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        $query2 = "DELETE FROM movie WHERE movie_id = $id";
        $statement2 = $this->pdo->prepare($query2);
        $statement2->execute() or die(var_dump($statement2->errorInfo()));
    }

    /**
     * Return all useful values to create a pagination
     *
     * @param int $currentPage Used to display movies on several pages
     * @param string|null $searchPattern Take in account the research made by user
     * @return array Contains values(int)
     */

    public function getPaginationValues(int $currentPage, string $searchPattern=null): array{
        $query = "SELECT COUNT(movie_id) AS nb_movies FROM movie WHERE title LIKE :searchPattern";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':searchPattern', '%'.$searchPattern.'%');
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetch();

        $nbMovies = (int) $results['nb_movies'];
        $moviesPerPage = 10;
        $first = ($currentPage * $moviesPerPage) - $moviesPerPage;
        $nbPages = ceil($nbMovies/$moviesPerPage);
        return
            array(
                "nb_movies" => $nbMovies,
                "movies_per_page" => $moviesPerPage,
                "first" => $first,
                "nb_pages" => $nbPages
            );
    }
}