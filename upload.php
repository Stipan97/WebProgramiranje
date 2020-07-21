<?php
    require "./controller/DbHandler.php";
    use db\DbHandler;

    $db = new DbHandler();

    session_start();

    $sql = "SELECT * FROM users WHERE username = '".$_SESSION["user"]."'";
    $resultUser = $db->select($sql);
    $rowUser = $resultUser->fetch_assoc();

    $sql = "SELECT * FROM dogs WHERE uid = '".$rowUser['id']."'";
    $resultDog = $db->select($sql);
    $rowDog = $resultDog->fetch_assoc();

    $profile = new stdClass();
    $profile->name = $rowUser["name"];
    $profile->surname = $rowUser["surname"];
    $profile->dogName = $rowDog["name"];

    $sql = "SELECT * FROM articles WHERE uid = '".$rowUser['id']."'";
    $resultImg = $db->select($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Profile</title>
</head>
<body class="normal">
    <div class="row justify-content-center">
        <div class="col-6 navig">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center">
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item insideNav">
                            <a href="index.php" class="nav-link">Homepage</a>
                        </li>
                        <li class="nav-item insideNav">
                            <a href="leaderboard.php" class="nav-link">Leaderboard</a>
                        </li>
                        <li class="nav-item active insideNav">
                            <a href="upload.php" class="nav-link">Upload Image</a>
                        </li>
                        <li class="nav-item insideNav">
                            <a href="profile.php" class="nav-link">My Profile (<?php echo $_SESSION["user"]; ?>)</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 card">
            <div class="card-body">
                <form action="controller/uploadImg.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="chooseimage">Choose image:</label>
                        <br>
                        <input id="img" type="file" name="file">
                        <div id="imgPreview" class="postImg"></div>
                        <button class="btn btn-primary btn-block" id="upload" type="submit">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="uploadPreview.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>