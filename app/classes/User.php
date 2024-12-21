<?php

class User
{

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($username, $password)
    {

        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            if(password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_login_status'] = true;

                return true;
            } else {
                return "Pogrešna lozinka. Pokušajte ponovo.";
            }
        } else {
            return "Korisničko ime nije dostupno. Pokušajte ponovo.";
        }
    }

    public function logout() {
        
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        $_SESSION['user_login_status'] = false;
    }

    public function isLogged() {
        return isset($_SESSION['user_id']);
    }
}
