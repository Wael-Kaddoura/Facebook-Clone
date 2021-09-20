<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$sql="SELECT * FROM `notifications` as `N` JOIN users as `U` ON N.sender_id = U.id WHERE N.reciever_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$user_id);
$stmt->execute();
$result = $stmt->get_result();
$notifications_count = $result -> num_rows;

$notifications_data = [];
$notifications_data["count"] = $notifications_count;

while ($notification = $result->fetch_assoc()) {
    $notifications_data["notifications_list"][$notification["id"]]["notification_body"] = $notification["notification_body"];
    $notifications_data["notifications_list"][$notification["id"]]["sender_name"] = $notification["first_name"]." ".$notification["last_name"];
}

$json = json_encode($notifications_data);
echo $json;
?>