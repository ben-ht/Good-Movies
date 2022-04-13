<?php

namespace movie;

/**
 * Authenticator functions
 */

class Logger
{
    public function generateLoginForm(string $error=null){ ?>
        <?php echo '<p class = "form-error login-error">'.$error.'</p>'; ?>
        <form id = "login-form" method = "post" action = "login.php">
            <img src = "/GoodMovies/css/images/user-circle.png" id = "user-circle">
            <fieldset>
                <label for = "username" style = "display: none">Name</label>
                <div class = "input-img">
                    <div class = "red-block">
                        <img src = "/GoodMovies/css/images/user.png">
                    </div>
                    <input type = "text" name = "username" placeholder = "Nom d'utilisateur" id = "username">
                </div>

                <label for = "password" style = "display: none">Password</label>
                <div class = "input-img">
                    <div class = "red-block">
                        <img src = "/GoodMovies/css/images/lock.png">
                    </div>
                    <input type = "password" name ="password" placeholder = "Mot de Passe" id = "password">
                </div>
                <button type = "submit" id = "login-form-btn">Se connecter</button>
            </fieldset>
        </form>
<?php
    }

    /**
     * Checks if the provided login information are valid
     *
     * @param string $username User input
     * @param string $password User input
     * @return array Grant access or return an error
     */


    public function log(string $username, string $password): array{
        $username_log = "admin";
        $password_log = "123";

        $grant = false;
        $error = "";

        if ($username == $username_log && $password == $password_log){
            $grant = true;
        } else if ($username == $username_log){
            $error = "Mot de passe erroné";
        } else {
            $error = "Nom d'Utilisateur inconnu";
        }
        return array("grant" => $grant, "error" => $error);
    }
}