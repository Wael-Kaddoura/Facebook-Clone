<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];
$srch_term = "%".$_GET["srch_term"]."%";

//searching for new users, meaning users that are not friends, are not pending on a friend request, and are not blocked
$sql="SELECT * FROM `users` WHERE (first_name LIKE ? OR last_name LIKE ?)
AND id != ?
AND id NOT IN (SELECT blocked_user_id FROM `blocked_users` WHERE user_id = ?) 
AND id NOT IN (SELECT friend_id FROM `users_friends` WHERE user_id = ?)
AND id NOT IN (SELECT reciever_id FROM `friend_requests` WHERE sender_id = ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ssssss",$srch_term, $srch_term, $user_id, $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

$serach_results = [];

while ($row = $result->fetch_assoc()) {
    $serach_results[$row["id"]]["name"] = $row["first_name"]." ".$row["last_name"];
    if ($row["gender"] == 0) {
        $serach_results[$row["id"]]["gender"] = "Male";
    }else {
        $serach_results[$row["id"]]["gender"] = "Female";
    }
}

$json = json_encode($serach_results);
echo $json;
?>