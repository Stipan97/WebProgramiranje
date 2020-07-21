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
                        <li class="nav-item insideNav">
                            <a href="upload.php" class="nav-link">Upload Image</a>
                        </li>
                        <li class="nav-item active insideNav">
                            <a href="profile.php" class="nav-link">My Profile (<?php echo $_SESSION["user"]; ?>)</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <form action="controller/logout.php">
                <input class="btn btn-danger btn-block" type="submit" value="Logout">
            </form>
        </div>
    </div>
    <?php
        if($resultImg->num_rows > 0) {
            while($rowImg = $resultImg->fetch_assoc()) {
                echo "<div class='row justify-content-center'>";
                    echo "<div class='col-6 card'>";
                        echo "<div class='card-body'>";
                            echo "<div>";
                                echo "<p class='articleName'>".$profile->name." ".$profile->surname."</p>";
                                echo "<p class='articleDogName'>".$profile->dogName."</p>";
                            echo "</div>";
                            echo "<div id='postImg' class='postImg' style='background-image: url(uploads/".$rowImg['imgUrl'].");'></div>";
                            echo "<div>";
                                echo "<p class='articleLikes'>".$rowImg['likes']." likes</p>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
        }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>