<?php

namespace movie;

class Template
{
    public static function render(string $content, string $class=null): void{ ?>
        <!DOCTYPE html>
        <html lang = "fr">
        <head>
            <meta charset = "utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel = stylesheet href = "/GoodMovies/css/main.css" type = "text/css">
            <link rel = "icon" href ="/GoodMovies/css/images/logo-popcorn.png" type = "image/png">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src = "/GoodMovies/scripts/script.js" type = "text/javascript"></script>
            <script src = "/GoodMovies/scripts/form_control.js" type = "text/javascript"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="https://kit.fontawesome.com/4de0158cd4.js" crossorigin="anonymous"></script>
            <title>Good Movies</title>
        </head>
        <?php if ($class != null): ?>
        <body class = "<?php echo $class ?>">
        <?php else: ?>
        <body>
        <?php endif ?>
        <?php include $_SERVER['DOCUMENT_ROOT']."/GoodMovies/pages/header.php" ?>
            <div id = "main-wrapper">
                <?php echo $content ?>
            </div>
        <?php include $_SERVER['DOCUMENT_ROOT']."/GoodMovies/pages/footer.php" ?>
        </body>
        </html>
<?php
    }
}