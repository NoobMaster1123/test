<?
include_once("./db.php");
$result = editComment($_GET["id"], $_POST["descr"]);
if ($result) {
    header("Location:../page/guest.php");
} else {
    header("Location:../page/guest.php?id=".$_GET["id"]);
}