<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrover";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// debug
$vehicleID = $_POST['vehicleID'];
$id_client = $_SESSION["id_client"];
$date_début = $_POST['startDate'];
$date_fin = $_POST['endDate'];

$sqldespo = mysqli_query($conn,"SELECT v.*
FROM véhicule v
LEFT JOIN réservation r ON v.id_véhicule = r.id_véhicule
WHERE r.id_Reservation IS NULL ;
 ") ;

$data = $conn->prepare("INSERT INTO réservation (Date_réservation, Etat, Date_début, Date_fin, id_client, id_véhicule) VALUES (CURDATE(), 'Pending', ?, ?, ?, ?)");
$data->bind_param("ssii", $date_début, $date_fin, $id_client, $vehicleID);

if ($data->execute()) {
    // Booking successful
    echo "<br>Car Booking success!!! Vehicle ID: " . $vehicleID;
} else {
    echo "<br>Error! " . $data->error;
}

$data->close();
$conn->close();
?>
