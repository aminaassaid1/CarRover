<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "CarRover");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Registered Cars</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>


            <?php      
                if (!empty($_SESSION["id_client"])) {
                    $id_client = $_SESSION["id_client"];
                    $result = mysqli_query($connection, "SELECT * FROM `clients` WHERE id_client = $id_client");
                    $row = mysqli_fetch_assoc($result);
            ?>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="width: 30%; "></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
            aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <li class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 448 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <style>
                        svg {
                            fill: #ededed
                        }
                        </style>
                        <path
                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                    </svg> <a class="nav-link" href="Profile.php"><?php echo $row['Nom']; ?></a>
                    </li>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="MyRegistration.php">MY REGISTRATIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Profile.php">PROFILE</a>
                    </li>
                </ul>
                <div>
                    <form action="logout.php" method="get">
                        <input type="submit" value="Log out" class="btn"
                            style="width: 200px; background-color: #FE5B29;" name="logout">
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php
}
?>

<?php
if (isset($_GET["response"])) {
    if ($_GET["response"] == "done") {
?>
<button id="modal-btn" type="hidden" class="btn btn-primary d-none" data-bs-toggle="modal"
    data-bs-target="#staticBackdrop">Launch static backdrop modal</button>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">BOOKING</h1>
            </div>
            <div class="modal-body">
                Booking successful!
            </div>
            <div class="modal-footer">
                <a href="MyRegistration.php" class="btn btn-secondary">Close</a>
            </div>
        </div>
    </div>
</div>
<?php
    } elseif ($_GET["response"] == "already_booked") {
?>
<button id="modal-btn" type="hidden" class="btn btn-primary d-none" data-bs-toggle="modal"
    data-bs-target="#staticBackdrop">Launch static backdrop modal</button>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">BOOKING</h1>
            </div>
            <div class="modal-body">
                Vehicle is already booked.
            </div>
            <div class="modal-footer">
                <a href="MyRegistration.php" class="btn btn-secondary">Close</a>
            </div>
        </div>
    </div>
</div>
<?php
    }
}
?>



<body>
    <div class="main" style="padding-top: 50px;">
        <div class="container mt-5">

            <h1 class="text-center">My Registered Cars</h1>
        </div>

        <div class="container mt-5">
            <div class="row">
                <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "carrover";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $id_client = $_SESSION['id_client'];

            $sql = "SELECT v.* FROM véhicule v INNER JOIN réservation r ON v.id_véhicule = r.id_véhicule WHERE r.id_client = $id_client";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '    <div class="gallery_box">';
                    echo '        <div class="gallery_img"><img src="' . $row['Image'] . '"></div>';
                    echo '        <h3 class="types_text">' . $row['Marque'] . ' ' . $row['Modèle'] . '</h3>';
                    echo '        <p class="looking_text">Year: ' . $row["année"] . '</p>';
                    echo '        <p class="looking_text">Modèle: ' . $row["Modèle"] . '</p>';
                    echo '        <p class="looking_text">Color: ' . $row["Couleur"] . '</p>';
                    echo '        <p class="looking_text">Seats: ' . $row["Sièges"] . '</p>';
                    echo '        <p class="looking_text">Doors: ' . $row["Portes"] . '</p>';
                    echo '        <p class="looking_text">Gearbox: ' . $row["Boîte_vitesses"] . '</p>';
                    echo '        <p class="looking_text">Fuel: ' . $row["Carburant"] . '</p>';
                    echo '        <p class="looking_text">Start per day MAD: ' . $row['Prix'] . '</p>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "No registered cars found.";
            }
            $conn->close();
            ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

    <?php
if(isset($_GET["response"])){
    ?>
    <script>
    setTimeout(() => {
        document.getElementById('modal-btn').click()
    }, 200);
    </script>
    <?php
}?>
</body>

</html>