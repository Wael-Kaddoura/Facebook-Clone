<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];
$blocked_user_id = $_POST["blocked_user_id"];

$sql="INSERT INTO `blocked_users`(`user_id`, `blocked_user_id`) VALUES (?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ss",$user_id, $blocked_user_id);
$stmt->execute();

$sql="INSERT INTO `blocked_users`(`user_id`, `blocked_user_id`) VALUES (?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ss",$blocked_user_id, $user_id);
$stmt->execute();

//removing blocked user from friends list
$sql2="DELETE FROM `users_friends` WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)";
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("ssss", $user_id, $blocked_user_id, $blocked_user_id, $user_id);
$stmt2->execute();

//removing any friend requests related to the blocked user
$sql3="DELETE FROM `friend_requests` WHERE (sender_id = ? AND reciever_id = ?) OR (sender_id = ? and reciever_id = ?)";
$stmt3 = $connection->prepare($sql3);
$stmt3->bind_param("ssss", $user_id, $blocked_user_id, $blocked_user_id, $user_id);
$stmt3->execute();

//removing any notifications related to the blocked user
$sql4="DELETE FROM `notifications` WHERE (sender_id = ? AND reciever_id = ?) OR (sender_id = ? and reciever_id = ?)";
$stmt4 = $connection->prepare($sql4);
$stmt4->bind_param("ssss", $user_id, $blocked_user_id, $blocked_user_id, $user_id);
$stmt4->execute();
?>