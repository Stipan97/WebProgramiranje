<?php
    require "./controller/DbHandler.php";
    use db\DbHandler;

    session_start();

    $db = new DbHandler();

    $sql = "SELECT * FROM articles ORDER BY likes DESC";
    $resultArticle = $db->select($sql);
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
                        <li class="nav-item active insideNav">
                            <a href="leaderboard.php" class="nav-link">Leaderboard</a>
                        </li>
                        <li class="nav-item insideNav">
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
    <?php
        if($resultArticle->num_rows > 0) {
            while($rowArticle = $resultArticle->fetch_assoc()) {
                $sql = "SELECT name, surname FROM users WHERE id = '".$rowArticle['uid']."'";
                $resultUser = $db->select($sql);
                $rowUser = $resultUser->fetch_assoc();

                $sql = "SELECT name FROM dogs WHERE uid = '".$rowArticle['uid']."'";
                $resultDog = $db->select($sql);
                $rowDog = $resultDog->fetch_assoc();

                echo "<div class='row justify-content-center'>";
                    echo "<div class='col-6 card'>";
                        echo "<div class='card-body'>";
                            echo "<div>";
                                echo "<p class='articleName'>".$rowUser['name']." ".$rowUser['surname']."</p>";
                                echo "<p class='articleDogName'>".$rowDog['name']."</p>";
                            echo "</div>";
                            echo "<div id='postImg' class='postImg' style='background-image: url(uploads/".$rowArticle['imgUrl'].");'></div>";
                            echo "<div>";
                                echo "<p class='articleLikes'>".$rowArticle['likes']." likes</p>";
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