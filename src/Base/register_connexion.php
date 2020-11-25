<?php
namespace Base;

use PDO;

class register_connexion extends DataBase {

    public function register()
    {

        if ($_POST['type'] == "inscription") {

            $login = htmlentities($_POST['login']);
            $password = $_POST['password'];
            $error = [];
            $user = $this->query('SELECT * FROM utilisateurs WHERE login = ?', [
                $login,
            ])->fetch();

            if (!empty($user)) {
                $error[] = "Ce login existe déjà ! ";
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 15]);
                $this->query('INSERT INTO utilisateurs (login, password) VALUE(?,?)', [
                    $login,
                    $password,
                ]);
            }
            return $error;
        }

    }

    public function connexion()
    {
        if ($_POST['type'] == "connexion") {
            $login = htmlentities($_POST['login']);
            $password = $_POST['password'];
            $errors = [];
            if (empty($login)) {
                $errors[] = 'Entrer un login';
            }
            if (empty($password)) {
                $errors[] = 'Entrer un password';
            }
            $user = $this->query('SELECT * FROM utilisateurs WHERE login = ?', [
                $login,
            ])->fetch(PDO::FETCH_ASSOC);
            if (empty($user)) {
                $errors[] = 'Ce login n\'existe pas';
            }
            if (!empty($user) && !password_verify($password, $user['password'])) {
                $errors[] = 'Le mot de passe n\'est pas bon';
            }
            if (empty($errors)) {
                $_SESSION['id'] = $user['id'];
            }
        }
        return $errors;

    }
}
