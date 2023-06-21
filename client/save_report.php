<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["id_client"])) {
    header("Location: login.php");
    exit();
}

$id_client = $_SESSION["id_client"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "carrover";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO reporter (subject, date, text , id_client ) VALUES ('$subject', CURRENT_DATE , '$message' , $id_client )";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
