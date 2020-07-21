<?php
    require "./DbHandler.php";
    use db\DbHandler;

    $db = new DbHandler();

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT password FROM users WHERE username = '".$username."'";

    $result = $db->select($sql);

    $hash = implode("", $result->fetch_assoc());

    if(password_verify($password, $hash)) {
        session_start();
        $_SESSION["user"] = $username;
        echo "success";
    } else {
        echo "failed";
    }
?>