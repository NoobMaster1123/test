<?
include_once("./db.php");
$result = delComment($_GET["id"]);
if ($result) {
    header("Location:../page/guest.php");
} else {
    header("Location:../page/guest.php?error=3");
}