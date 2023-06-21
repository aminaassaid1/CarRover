<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("location: admin-login.php");
    exit();
}

require_once 'Vehicle.php';

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

$vehicle = new Vehicle($servername, $username, $password, $dbname);
$vehicles = $vehicle->getAllVehicles();

// Form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Code for handling form submissions goes here
    if (isset($_POST["add"])) {
        $marque = $_POST["marque"];
        $annee = $_POST["annee"];
        $modele = $_POST["modele"];
        $couleur = $_POST["couleur"];
        $prix = $_POST["prix"];
        $sieges = $_POST["sieges"];
        $portes = $_POST["portes"];
        $boite_vitesses = $_POST["boite_vitesses"];
        $carburant = $_POST["carburant"];

        $vehicle->addCar($marque, $annee, $modele, $couleur, $prix, $sieges, $portes, $boite_vitesses, $carburant);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["update"])) {
        $id = $_POST["edit-id"];
        $marque = $_POST["edit-marque"];
        $annee = $_POST["edit-annee"];
        $modele = $_POST["edit-modele"];
        $couleur = $_POST["edit-couleur"];
        $prix = $_POST["edit-prix"];
        $sieges = $_POST["edit-sieges"];
        $portes = $_POST["edit-portes"];
        $boite_vitesses = $_POST["edit-boite_vitesses"];
        $carburant = $_POST["edit-carburant"];

        $vehicle->updateVehicle($id, $marque, $annee, $modele, $couleur, $prix, $sieges, $portes, $boite_vitesses, $carburant);

        // Redirect.
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["delete"])) {
        $id = $_POST["delete-id"];
        $vehicle->deleteVehicle($id);
        // Redirect.
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<!Doctype HTML>
<html>

<head>
    <title>Dashboard</title>
    <link rel="icon" href="images/icons8-car-rental-64.png" type="image/x-icon">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="css/dashboard.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>


<body>


    <div id="mySidenav" class="sidenav">
        <p class="logo"><span>C</span>arRover</p>
        <a href="dashboard.php" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
        <a href="#" class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Customers</a>
        <a href="admin-vehicle.php" class="icon-a"><i class="fa fa-list icons"></i> &nbsp;&nbsp;Vehicle</a>
        <a href="admin-registration.php" class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Orders</a>
        <a href="reporter.php" class="icon-a"><i class="fa fa-tasks icons"></i> &nbsp;&nbsp;Reporter</a>
        <a href="#" class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Accounts</a>
        <div>
            <form action="admin-logout.php" method="get">
                <input type="submit" value="Log out" class="btn" style="width: 200px; background-color: #818181;"
                    name="logout">
            </form>
        </div>

    </div>
    <div id="main">
        <div class="clearfix"></div>
        <br />

        <div class="col-div-3">
            <div class="box">
                <p><?php
                $sqlCustomers = "SELECT COUNT(*) AS total_customers
                 FROM clients";
                $result = $conn->query($sqlCustomers);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalCustomers = $row["total_customers"];
                    echo " " . $totalCustomers;
                }else {
                        echo "0";
                    }                
                ?><br /><span>Customers</span></p>
                <i class="fa fa-users box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p><?php
                    $sqlVehicle = "SELECT COUNT(*) AS total_vehicle FROM véhicule";
                    $result = $conn->query($sqlVehicle);
    
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $totalVehicle = $row["total_vehicle"];
                            echo $totalVehicle;
                        } else {
                            echo "0";
                        }
                    ?><br /><span>Vehicle</span></p>
                <i class="fa fa-list box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p><?php
                    $sqlRes = "SELECT COUNT(*) AS total_reservations
                    FROM réservation;";
                    $result = $conn->query($sqlRes);
    
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $totalRes = $row["total_reservations"];
                            echo $totalRes;
                        } else {
                            echo "0";
                        }
                    ?><br /><span>Orders</span></p>
                <i class="fa fa-shopping-bag box-icon"></i>
            </div>
        </div>
        <div style="margin-top:100px;">
           <canvas id="myChart" style="margin-top:5%;"></canvas>
        </div>
        


    </div>
   







    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" crossorigin="anonymous">
    </script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var vehicle = <?php echo $totalVehicle?>;
        var customers = <?php echo $totalCustomers?>;
        var orders = <?php echo $totalRes?>;


        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Customers', 'Vehicle', 'Orders'],
                datasets: [{
                    label: 'Statistiques',
                    data: [customers, vehicle, orders],
                    backgroundColor: [
                        'rgb(152, 191, 248)',
                        'rgb(220, 53, 69)',
                        'rgb(253, 126, 20)'
                    ],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>





</body>


</html>