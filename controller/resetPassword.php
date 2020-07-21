<?php
    require "./DbHandler.php";
    use db\DbHandler;

    $db = new DbHandler();

    $username = $_POST["username"];
    $password = $_POST["password"];
    $sword = $_POST["sword"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT security FROM users WHERE username = '".$username."'";
    $result = $db->select($sql);
    $swordDB = ($result->fetch_assoc())["security"];

    if($sword == $swordDB) {
        $sql = "UPDATE users SET password = '".$hashed_password."' WHERE username = '".$username."'";
        $db->select($sql);
    } else {
        echo "Query fail";
    }
?>