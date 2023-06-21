
<?php

var_dump($_POST);


session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrover";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION["id_client"])) {
    header("location: login.php");
    exit();
}

$vehicleID = $_POST['vehicleID'];
$date_début = $_POST['startDate'];
$date_fin = $_POST['endDate'];
$id_client = $_SESSION['id_client'];

$sql_check = "SELECT * FROM réservation WHERE Date_début = '$date_début' AND Date_fin='$date_fin'";
$query_sql = mysqli_query($conn, $sql_check);
$data = null; // Initialize the $data variable to null

if (mysqli_num_rows($query_sql) === 0) {
    $data = $conn->prepare("INSERT INTO réservation (Date_réservation, Etat, Date_début, Date_fin, id_client, id_véhicule) VALUES (CURDATE(), 'Pending', ?, ?, ?, ?)");
    $data->bind_param("ssii", $date_début, $date_fin, $id_client, $vehicleID);

    if ($data->execute()) {
        
        $conn->query("DELETE FROM réservation WHERE id_véhicule IS NULL"); // Delete rows with null id_véhicule. (Call it CleanUp!)

        header("Location: MyRegistration.php?response=done&id_véhicule=".$vehicleID);
        exit();
    } else {
        echo "Error! " . $data->error;
    }
} else {
    header("Location: MyRegistration.php?response=already_booked&id_véhicule=".$vehicleID);
        exit();
}

if ($data) {
    $data->close(); // Close the prepared statement
}
$conn->close(); // Close the database connection
?>