<?php
    require "./DbHandler.php";
    use db\DbHandler;

    $db = new DbHandler();

    session_start();

    $username = $_SESSION["user"];

    $sql = "SELECT * FROM users WHERE username = '".$username."'";

    $result = $db->select($sql);
    $row = $result->fetch_assoc();

    $uid = $row["id"];
    $likes = $_POST["likes"];
    $id = $_POST["id"];

    $sql = "UPDATE articles SET likes = '".$likes."' WHERE id = '".$id."'";
    $db->update($sql);

    $sql = "SELECT * FROM likes WHERE uid = '".$uid."' AND aid = '".$id."'";
    if(($db->select($sql))->fetch_assoc() == null) {
        $sql = "INSERT INTO likes(uid, aid) VALUES ('".$uid."', '".$id."')";
        $db->insert($sql);
    } else {
        $sql = "DELETE FROM likes WHERE uid = '".$uid."' AND aid = '".$id."'";
        $db->delete($sql);
    }
?>