<?php
include "../connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$sql="SELECT * FROM `users` WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$user_id);
$stmt->execute();
$result = $stmt->get_result();

$row = $result -> fetch_assoc();

$user_data["id"] = $user_id;
$user_data["name"] = $row["first_name"]." ".$row["last_name"];
$user_data["first_name"] = $row["first_name"];
$user_data["last_name"] = $row["last_name"];

if ($row["gender"] == 0) {
    $user_data["gender"] = "Male";
}else {
    $user_data["gender"] = "Female";
}


$json = json_encode($user_data);
echo $json;
?>