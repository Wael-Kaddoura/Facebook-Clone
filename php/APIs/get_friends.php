<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$sql="SELECT * FROM `users_friends` as `UF` JOIN users as `U` ON UF.friend_id = U.id WHERE UF.user_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$user_id);
$stmt->execute();
$result = $stmt->get_result();
$friends_count = $result -> num_rows;

$friends = [];
$friends["count"] = $friends_count;


while ($friend = $result->fetch_assoc()) {
    $friends["friends_list"][$friend["friend_id"]]["name"] = $friend["first_name"]." ".$friend["last_name"];

    if ($friend["gender"] == 0) {
        $friends["friends_list"][$friend["friend_id"]]["gender"] = "Male";
    }else {
        $friends["friends_list"][$friend["friend_id"]]["gender"] = "Female";
    }

}

$json = json_encode($friends);
echo $json;
?>