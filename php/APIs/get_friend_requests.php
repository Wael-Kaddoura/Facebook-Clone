<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$sql="SELECT * FROM `friend_requests` as `FR` JOIN users as `U` ON FR.sender_id = U.id WHERE FR.reciever_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$user_id);
$stmt->execute();
$result = $stmt->get_result();
$requests_count = $result -> num_rows;

$friend_requests = [];
$friend_requests["count"] = $requests_count;

while ($request = $result->fetch_assoc()) {
    $friend_requests["requests_list"][$request["sender_id"]]["sender_name"] = $request["first_name"]." ".$request["last_name"];

    if ($request["gender"] == 0) {
        $friend_requests["requests_list"][$request["sender_id"]]["gender"] = "Male";
    }else {
        $friend_requests["requests_list"][$request["sender_id"]]["gender"] = "Female";
    }

}

$json = json_encode($friend_requests);
echo $json;
?>