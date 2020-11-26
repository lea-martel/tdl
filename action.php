<?php
$url = "";
include 'src/Base.php';
$error = [];
$return = [];
if (in_array($_POST['type'], ['inscription', 'connexion'])) {
    $account = new Base\register_connexion();
    if ($_POST['type'] == "inscription") {
        $url = "connexion.php";
        $error = $account->register();
        $return = [$url, $error];
    }

    if ($_POST['type'] == "connexion") {
        $url = "todolist.php";
        $error = $account->connexion();
        $return = [$url, $error];
    }
}

echo json_encode($return);
