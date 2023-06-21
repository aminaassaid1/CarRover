<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car list</title>
    <link rel="icon" href="images/icons8-car-rental-64.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- font css -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <meta name="keywords" content="">
</head>

<body>
    <style>
        .gallery_box {
            margin-bottom: 20px;
            /* Adjust the value as per your desired spacing */
            width: 100%;
        }

        .gallery_img {
            height: 250px;
            display: flex;
            flex-grow: 0;
            flex-shrink: 0;
            overflow: hidden !important;
        }

        .gallery_img img {
            max-width: 95% !important;
            max-height: 100%;
            height: auto;
            display: block;
        }
        #book_now{

            width: 50%;
    float: none;
    font-size: 16px;
    color: #fefefd;
    text-align: center;
    background-color: #fe5b29;
    font-weight: bold;
    padding: 10px;
    margin-left: 130px !important;
    margin: 3%;
}

    </style>
    <div class="container mt-5" style="background-color:white;">
        <h1 class="text-center">Cars available on this date:</h1>
    </div>
    <div class="row mt-5" style="max-width:1800px; margin: 0 auto; ">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CarRover";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die($conn->connect_error);
}

$start_date = $_GET["pickup"];
$end_date = $_GET["dropoff"];
$sql = "SELECT DISTINCT v.*
        FROM véhicule v
        LEFT JOIN réservation r ON v.id_véhicule = r.id_véhicule
        WHERE r.id_véhicule IS NULL OR (r.Date_début > '$end_date' OR r.Date_fin < '$start_date')";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4">';
        echo '<form action="booking.php" method="POST">';
        echo '    <div class="gallery_box">';
        echo '        <div class="gallery_img"><img src="' . $row['Image'] . '"></div>';
        echo '        <h3 class="types_text">' . $row['Marque'] . ' ' . $row['Modèle'] . '</h3>';
        echo '        <p class="looking_text" style="color:black;">Year: ' . $row["année"] . '</p>';
        echo '        <p class="looking_text" style="color:black;">Modèle: ' . $row["Modèle"] . '</p>';
        echo '        <p class="looking_text" style="color:black;">Color: ' . $row["Couleur"] . '</p>';
        echo '        <p class="looking_text" style="color:black;">Seats: ' . $row["Sièges"] . '</p>';
        echo '        <p class="looking_text" style="color:black;">Doors: ' . $row["Portes"] . '</p>';
        echo '        <p class="looking_text" style="color:black;">Gearbox: ' . $row["Boîte_vitesses"] . '</p>';
        echo '        <p class="looking_text" style="color:black;">Fuel: ' . $row["Carburant"] . '</p>';
        echo '        <p class="looking_text" >Start per day MAD: ' . $row['Prix'] . '</p>';
        echo '        <input type="hidden" name="vehicleID" value="' . $row['id_véhicule'] . '">';
        echo '        <input type="hidden" name="startDate" value="' . $start_date . '">';
        echo '        <input type="hidden" name="endDate" value="' . $end_date . '">';
        echo '        <input type="submit" id="book_now" name="book_now" value="book now" />';
        echo '    </div>';
        echo '</form>';
        echo '</div>';
    }
}

$conn->close();
?>

    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
