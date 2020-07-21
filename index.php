<?php
    require "./controller/DbHandler.php";
    use db\DbHandler;

    $db = new DbHandler();

    session_start();

    $sql = "SELECT * FROM articles ORDER BY id DESC";

    $result = $db->select($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Homepage</title>
</head>
<body class="normal">
    <div class="row justify-content-center">
        <div class="col-6 navig">
            <nav class="navbar navbar-expand-lg navbar-dark nav-img justify-content-center">
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item active insideNav">
                            <a href="index.php" class="nav-link">Homepage</a>
                        </li>
                        <li class="nav-item insideNav">
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
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sql = "SELECT * FROM users WHERE id = '".$row['uid']."'";
                $resultUser = $db->select($sql);
                $rowUser = $resultUser->fetch_assoc();

                $sql = "SELECT * FROM dogs WHERE uid = '".$row['uid']."'";
                $resultDog = $db->select($sql);
                $rowDog = $resultDog->fetch_assoc();

                $username = $_SESSION["user"];
                $sql = "SELECT * FROM users WHERE username = '".$username."'";
                $resultId = $db->select($sql);
                $rowId = $resultId->fetch_assoc();

                $article = new stdClass();
                $article->name = $rowUser["name"];
                $article->surname = $rowUser["surname"];
                $article->dogName = $rowDog["name"];
                $article->imgUrl = $row["imgUrl"];
                $article->likes = $row["likes"];

                $sql = "SELECT * FROM likes WHERE uid = '".$rowId["id"]."' AND aid = '".$row['id']."'";
                if(($db->select($sql))->fetch_assoc() == null) {
                    $btnLike = "Like it";
                } else {
                    $btnLike = "Unlike it";
                }

                echo "<div class='row justify-content-center'>";
                    echo "<div class='col-6 card'>";
                        echo "<div class='card-body'>";
                            echo "<div>";
                                echo "<p class='articleName'>".$article->name." ".$article->surname."</p>";
                                echo "<p class='articleDogName'>".$article->dogName."</p>";
                            echo "</div>";
                            echo "<div id='postImg".$row['id']."' class='postImg' style='background-image: url(uploads/".$article->imgUrl.");'></div>";
                            echo "<div>";
                                echo "<p class='articleLikes'><span id='likeCounter".$row['id']."'>".$article->likes."</span> likes</p>";
                                echo "<button type='button' onclick='likeHandler()' class='btn btn-primary'><span id='btnText".$row['id']."'>".$btnLike."</span></button>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
        }
    ?>
    <script src="homepage.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>