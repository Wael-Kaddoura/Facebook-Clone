<?php
include "connection.php";

session_start();

$user_id = $_SESSION["user_id"];

if(isset($_POST["first_name"]) && $_POST["first_name"] != "" && strlen($_POST["first_name"]) >= 3) {
    $first_name = $_POST["first_name"];
}else{
    die ("Enter a valid input");
}

if(isset($_POST["last_name"]) && $_POST["last_name"] != "" && strlen($_POST["last_name"]) >= 3) {
    $last_name = $_POST["last_name"];
}else{
    die ("Enter a valid input");
}

if(isset($_POST["gender"]) && $_POST["gender"] != "" ) {
    $gender = $_POST["gender"];
}else{
    die ("Enter a valid input");
}

$sql2 = "UPDATE `users` SET `first_name`= ?,`last_name`= ?,`gender`= ? WHERE id = ?";
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("ssss", $first_name, $last_name, $gender, $user_id);
$stmt2->execute();

header("location:../friends_center.php")
?>