<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];
$reciever_id = $_POST["reciever_id"];

$sql="INSERT INTO `friend_requests`( `sender_id`, `reciever_id`) VALUES (?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ss",$user_id, $reciever_id);
$stmt->execute();

$notfication_body = "Sent you a friend request!";
$sql2="INSERT INTO `notifications`(`sender_id`, `reciever_id`, `notification_body`) VALUES (?, ?, ?)";
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("sss",$user_id, $reciever_id, $notfication_body);
$stmt2->execute();
?>