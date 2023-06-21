<?php
session_start();
if (isset($_SESSION["id_client"])) {
    header("Location: listcar.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
