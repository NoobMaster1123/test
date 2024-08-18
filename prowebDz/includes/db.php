<?
function db() {
    $dbhost = "127.0.0.1";
    $dbname = "proweebdz";
    $dblogin = "root";
    $dbpass = "root";
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dblogin, $dbpass);
    return $pdo;
}
function addComment($name, $descr) {
    session_start();
    if (isset($_SESSION["user-comment"])) {
        $userId = $_SESSION["user-comment"];
        $result = true;
    } else {
    $name = strip_tags($name);
    $query = "INSERT INTO `users`(`user_login`) VALUES (?)";
    $db = db();
    $pdoStat = $db->prepare($query);
    $result = $pdoStat->execute([$name]);
    $userId = $db->lastInsertId();
    $_SESSION["user-comment"] = $userId;
    }
    if ($result) {
        date_default_timezone_set("Asia/Tashkent");
        $time = time();
        $comment = htmlspecialchars($descr);
        $db = db();
        $query = "INSERT INTO `comment`(`comment_time`, `comment_text`, `user_id`) VALUES (?,?,?)";
        $pdoStat = $db->prepare($query);
        $result = $pdoStat->execute([$time, $comment, $userId]);
    }
    return $result;
}
function commentInfo() {
    $db = db();
    $query = "SELECT * FROM `comment`INNER JOIN users USING (`user_id`)";
    $pdoStat = $db->prepare($query);
    $pdoStat->execute();
    $result = $pdoStat->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
$comments = commentInfo();
session_start();
function getComment($commentId) {
    $db = db();
    $query = "SELECT `comment_id`, `comment_text`, users.user_login FROM `comment` INNER JOIN users USING (`user_id`) WHERE `comment_id`=?";
    $pdoStat = $db->prepare($query);
    $pdoStat->execute([$commentId]);
    $result = $pdoStat->fetch(PDO::FETCH_ASSOC);
    return $result;
}

if (isset($_GET["id"])) {
    $oneComment = getComment($_GET["id"]);
}

function editComment($commentId, $comment) {
    $db = db();
    $query = "UPDATE `comment` SET `comment_text`=? WHERE `comment_id`=?";
    $pdoStat = $db->prepare($query);
    $result = $pdoStat->execute([$comment, $commentId]);
    return $result;
}

function delComment($commentId) {
    $db = db();
    $query = "DELETE FROM `comment` WHERE `comment_id`=?";
    $pdoStat = $db->prepare($query);
    $result = $pdoStat->execute([$commentId]);
    return $result;
}