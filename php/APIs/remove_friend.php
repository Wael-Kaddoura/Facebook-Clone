<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];
$removed_friend_id = $_POST["removed_friend_id"];

$sql="DELETE FROM `users_friends` WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ssss", $user_id, $removed_friend_id, $removed_friend_id, $user_id);
$stmt->execute();

$sql2="DELETE FROM `notifications` WHERE (sender_id = ? AND reciever_id = ?) OR (sender_id = ? and reciever_id = ?)";
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("ssss", $removed_friend_id, $user_id, $user_id, $removed_friend_id);
$stmt2->execute();
?>