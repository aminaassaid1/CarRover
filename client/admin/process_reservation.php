<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "carrover";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    session_start();
    $id_admin = $_SESSION["admin_id"];
     if(isset($_POST["confirmed"])){
        $id_reservation = $_POST["id_reservation"];
        $sqlConfirm = "UPDATE `réservation` SET `Etat`='Confirmed', `Id_Admin_validation`='$id_admin'  WHERE `id_Reservation` = $id_reservation";
        $result = mysqli_query($conn,$sqlConfirm);
        header('Location: admin-registration.php');
     }

     
     if(isset($_POST["canceled"])){
        $id_reservation = $_POST["id_reservation"];
        $sqlConfirm = "UPDATE `réservation` SET `Etat`='Canceled', `Id_Admin_annulation`='$id_admin'  WHERE `id_Reservation` = $id_reservation ";
        $result = mysqli_query($conn,$sqlConfirm);
        header('Location: admin-registration.php');
     }

     if(isset($_POST["Return"])){
      $id_reservation = $_POST["id_reservation"];
      $sqlConfirm = "UPDATE `réservation` SET `date_retour`= CURDATE() , `Id_Admin_annulation`='$id_admin'  WHERE `id_Reservation` = $id_reservation ";
      $result = mysqli_query($conn,$sqlConfirm);
      header('Location: admin-registration.php');
   }
?>