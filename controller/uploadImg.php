<?php
    require "./DbHandler.php";
    use db\DbHandler;

    $db = new DbHandler();

    session_start();

    $username = $_SESSION["user"];

    $sql = "SELECT * FROM users WHERE username = '".$username."'";

    $result = $db->select($sql);
    $row = $result->fetch_assoc();

    $uploadDir = "../uploads/";
    $uploadStatus = 1;

    if(!empty($_FILES["file"]["name"])) {
        $filename = basename($_FILES["file"]["name"]);
        $targetFilePath = $uploadDir . $filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $uploadedFile = $filename;

        $allowTypes = array('jpg', 'png', 'jpeg'); 

        if(in_array($fileType, $allowTypes)){ 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) { 
                $uploadedFile = $fileName; 
            } else { 
                $uploadStatus = 0; 
                echo "Sorry, there was an error uploading your file."; 
            } 
        }else{ 
            $uploadStatus = 0; 
            echo "Sorry, only JPG, JPEG, & PNG files are allowed to upload."; 
        } 
        if($uploadStatus == 1){ 
            $db= new DbHandler();
            $sql = "INSERT INTO articles(uid, imgUrl, likes) VALUES ('".$row['id']."', '".$filename."', '0')";

            $db->insert($sql);
            header("location:../index.php");
        } 
    } else {
        echo "<script> window.onload = function() { var box = confirm('Please choose image!'); if(box == true) { window.location = '../upload.php' } else { window.location = '../index.php' } } </script>";
    }
?>