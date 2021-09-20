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

?>