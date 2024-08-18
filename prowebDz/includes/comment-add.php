<?
include_once("./db.php");
// var_dump($_POST);
$add = addComment($_POST['name'], $_POST['descr']);
// $add = false;
if ($add) {
    header("Location:../page/guest.php");
} else {
    header("Location:../page/guest.php?error=1");
}