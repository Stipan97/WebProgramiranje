<?php
    require "./DbHandler.php";
    use db\DbHandler;

    $db = new DbHandler();

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $sex = $_POST["sex"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sword = $_POST["sword"];
    $dogName = $_POST["dogName"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name, surname, username, sex, email, password, security) VALUES ('".$name."', '".$surname."', '".$username."', '".$sex."', '".$email."', '".$hashed_password."', '".$sword."')";

    $db->insert($sql);

    $sql = "SELECT id FROM users WHERE username = '".$username."'";
    $id = (($db->select($sql))->fetch_assoc())["id"];

    $sql = "INSERT INTO dogs(uid, name) VALUES ('".$id."', '".$dogName."')";
    $db->insert($sql);
?>