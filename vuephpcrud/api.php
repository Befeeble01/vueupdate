<?php

$conn = new mysqli("localhost","root","","vuephpcrud");
if ($conn->connect_error) {
    die("Could not connect to database!");
}

$res = array ('error' => false);

$action = 'read';

if(isset($_GET['action'])) {
    $action = $_GET['action'];
}


if ($action == 'read') {
    $result = $conn->query("SELECT * FROM `users`");
    $users = array();

    while ($row = $result -> fetch_assoc()) {
        array_push($users,$row);
    }

    $res['users'] = $users;
}

if ($action == 'create') {

    $username = $_POST ['username'];
    $email = $_POST ['email'];
    $mobille = $_POST ['mobille'];

    $result = $conn->query("INSERT INTO `users` (`username`,`email`,`mobille`) VALUES ('$username' , '$email' , '$mobille') ");
    $users = array();

    if ($result) {
        $res['message'] = "User add successfully";
    }else {
        $res['error'] = true;
        $res['message'] = "Could not insert user";
    }

}


if ($action == 'update') {

    $id = $_POST['id'];
    $username = $_POST ['username'];
    $email = $_POST ['email'];
    $mobille = $_POST ['mobille'];

    $result = $conn->query("UPDATE  `users` SET  `username`='$username',`email`='$email',`mobille`='$mobille' WHERE `id`='$id'");
    $users = array();

    if ($result) {
        $res['message'] = "User updated successfully";
    }else {
        $res['error'] = true;
        $res['message'] = "Could not update user";
    }

}

if ($action == 'delete') {

    $id = $_POST['id'];

    $result = $conn->query("DELETE FROM  `users` WHERE `id`='$id'");
    $users = array();

    if ($result) {
        $res['message'] = "User delete successfully";
    }else {
        $res['error'] = true;
        $res['message'] = "Could not delete user";
    }

}









$conn->close();

header("Content-type: application/json");
echo json_encode($res);
die();