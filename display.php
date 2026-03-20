<?php

$conn = mysqli_connect("localhost", "root", "", "signup_db");

$sql = "SELECT * FROM signup";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['ID'] . ". " . $row['F_Name'] . " - " . $row['L_Name']. 
    " - " . $row['Email']. " - " . $row['Password']. "<br>";
}

?>
