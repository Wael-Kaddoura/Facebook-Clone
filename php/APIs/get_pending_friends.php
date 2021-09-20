<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$sql="SELECT * FROM `friend_requests` as `FR` JOIN users as `U` ON FR.reciever_id = U.id WHERE FR.sender_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$user_id);
$stmt->execute();
$result = $stmt->get_result();
$pending_friends_count = $result -> num_rows;

$pending_friends = [];
$pending_friends["count"] = $pending_friends_count;

while ($request = $result->fetch_assoc()) {
    $pending_friends["list"][$request["reciever_id"]]["reciever_name"] = $request["first_name"]." ".$request["last_name"];

    if ($request["gender"] == 0) {
        $pending_friends["list"][$request["reciever_id"]]["gender"] = "Male";
    }else {
        $pending_friends["list"][$request["reciever_id"]]["gender"] = "Female";
    }

}

$json = json_encode($pending_friends);
echo $json;
?>