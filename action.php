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

if($_POST['type'] == 'tache')
{
    $todoList = new Base\actionTodolist();
    $return = $todoList->addList();
}

if ($_POST['type'] == "deleteList") {
    $todoList = new Base\actionTodolist();
    $error = $todoList->deleteList();
    $url  = 'dsffq';
    $return = [$url, $error];
}
if ($_POST['type'] == "checkedList") {
    $todoList = new Base\actionTodolist();
    $error = $todoList->checkedList();
    $url  = 'dsffq';
    $return = [$url, $error];
}
echo json_encode($return);
