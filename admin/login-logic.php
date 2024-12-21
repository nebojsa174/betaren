<?php 

    require '../app/config/database.php';
    require '../app/config/config.php';


    if(isset($_POST['submit'])) {
        // get form data
        $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$username) {
            $_SESSION['login'] = "Unesite korisničko ime";
        } elseif(!$password) {
            $_SESSION['login'] = "Unesite lozinku";
        } else {

            $sql = "SELECT * FROM users WHERE username = '$username'";
            $sql_result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($sql_result) == 1) {
                $user = mysqli_fetch_assoc($sql_result);
                $db_password = $user['password'];

                if(password_verify($password, $db_password)) {
                    $_SESSION['user-id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['userLoginStatus'] = true;

                    header('location: ' . ADMIN_URL);
                    } else {
                        $_SESSION['login'] = "Pogrešna lozinka. Pokušajte ponovo";
                    }
                } else {
                    $_SESSION['login'] = "Korisničko ime <b>$username</b> ne postoji.";
                }
            }

            // if any problem, redirect to login page
            if(isset($_SESSION['login'])) {
                $_SESSION['login-data'] = $_POST;
                header('location: ' . ADMIN_URL . 'login.php');
                die();
            }
        } else {
            header('location: ' . ADMIN_URL . 'login.php');
            die();
    }