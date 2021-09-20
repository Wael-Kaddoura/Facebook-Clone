<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];
$sender_id = $_POST["sender_id"];

$sql="DELETE FROM `friend_requests` WHERE (sender_id = ? AND reciever_id = ?) OR (sender_id = ? and reciever_id = ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ssss", $sender_id, $user_id, $user_id, $sender_id);
$stmt->execute();

//deleting notifications related to the friend request being sent since it is accepted
$sql2="DELETE FROM `notifications` WHERE (sender_id = ? AND reciever_id = ?) OR (sender_id = ? and reciever_id = ?)";
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("ssss", $sender_id, $user_id, $user_id, $sender_id);
$stmt2->execute();

$notfication_body = "Accepted your friend request!";
$sql3="INSERT INTO `notifications`(`sender_id`, `reciever_id`, `notification_body`) VALUES (?, ?, ?)";
$stmt3 = $connection->prepare($sql3);
$stmt3->bind_param("sss",$user_id, $sender_id, $notfication_body);
$stmt3->execute();

$sql4="INSERT INTO `users_friends`(`user_id`, `friend_id`) VALUES (?, ?)";
$stmt4 = $connection->prepare($sql4);
$stmt4->bind_param("ss",$user_id, $sender_id);
$stmt4->execute();

$sql5="INSERT INTO `users_friends`(`user_id`, `friend_id`) VALUES (?, ?)";
$stmt5 = $connection->prepare($sql5);
$stmt5->bind_param("ss",$sender_id, $user_id);
$stmt5->execute();
?>