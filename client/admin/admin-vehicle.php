<?php
session_start();

// if (!isset($_SESSION["admin_id"])) {
//     header("location: admin-login.php");
//     exit();
// }

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
        $image = $_FILES["image"]["name"];
        $tmp_name=$_FILES["image"]["tmp_name"];
        $dossier = "images/".$image;
        $dossier_file = "../images/".$image;
        move_uploaded_file($tmp_name,$dossier_file);
        $vehicle->addCar($marque, $annee, $modele, $couleur, $prix, $sieges, $portes, $boite_vitesses, $carburant,$dossier);
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
        <a href="admin-registration" class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Orders</a>
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
        <div class="clearfix"></div>
        <br /><br />
        <div class="col">
            <div class="box">
                <div class="content-box">
                    <div class="">
                        <div>
                            <p>vehicle management</p>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#addVehicleModal">Add Vehicle</button>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Brand</th>
                                <th>Year</th>
                                <th>Model</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Seats</th>
                                <th>Doors</th>
                                <th>Transmission</th>
                                <th>Fuel Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vehicles as $vehicle) { ?>
                            <tr>
                                <td><?php echo $vehicle['id_véhicule']; ?></td>
                                <td><?php echo $vehicle['Marque']; ?></td>
                                <td><?php echo $vehicle['année']; ?></td>
                                <td><?php echo $vehicle['Modèle']; ?></td>
                                <td><?php echo $vehicle['Couleur']; ?></td>
                                <td><?php echo $vehicle['Prix']; ?></td>
                                <td><?php echo $vehicle['Sièges']; ?></td>
                                <td><?php echo $vehicle['Portes']; ?></td>
                                <td><?php echo $vehicle['Boîte_vitesses']; ?></td>
                                <td><?php echo $vehicle['Carburant']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary toggleModalBtn" data-bs-toggle="modal"
                                        data-bs-target="#updateVehicleModal"
                                        data-id="<?php echo $vehicle['id_véhicule']; ?>"
                                        data-marque="<?php echo $vehicle['Marque']; ?>"
                                        data-annee="<?php echo $vehicle['année']; ?>"
                                        data-modele="<?php echo $vehicle['Modèle']; ?>"
                                        data-couleur="<?php echo $vehicle['Couleur']; ?>"
                                        data-prix="<?php echo $vehicle['Prix']; ?>"
                                        data-sieges="<?php echo $vehicle['Sièges']; ?>"
                                        data-portes="<?php echo $vehicle['Portes']; ?>"
                                        data-boite_vitesses="<?php echo $vehicle['Boîte_vitesses']; ?>"
                                        data-carburant="<?php echo $vehicle['Carburant']; ?>">Edit</button>
                                    <button type="button" class="btn btn-danger deleteInTable" data-bs-toggle="modal"
                                        data-bs-target="#deleteVehicleModal"
                                        data-id="<?=$vehicle['id_véhicule']?>">Delete</button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Vehicle Modal -->
    <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVehicleModalLabel">Add Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add vehicle form -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="mb-3">
                            <label for="marque" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="marque" name="marque" required>
                        </div>
                        <div class="mb-3">
                            <label for="annee" class="form-label">Year</label>
                            <input type="number" class="form-control" id="annee" name="annee" required>
                        </div>
                        <div class="mb-3">
                            <label for="modele" class="form-label">Model</label>
                            <input type="text" class="form-control" id="modele" name="modele" required>
                        </div>
                        <div class="mb-3">
                            <label for="couleur" class="form-label">Color</label>
                            <input type="text" class="form-control" id="couleur" name="couleur" required>
                        </div>
                        <div class="mb-3">
                            <label for="prix" class="form-label">Price</label>
                            <input type="number" class="form-control" id="prix" name="prix" required>
                        </div>
                        <div class="mb-3">
                            <label for="sieges" class="form-label">Seats</label>
                            <input type="number" class="form-control" id="sieges" name="sieges" required>
                        </div>
                        <div class="mb-3">
                            <label for="portes" class="form-label">Doors</label>
                            <input type="number" class="form-control" id="portes" name="portes" required>
                        </div>
                        <div class="mb-3">
                            <label for="boite_vitesses" class="form-label">Transmission</label>
                            <input type="text" class="form-control" id="boite_vitesses" name="boite_vitesses" required>
                        </div>
                        <div class="mb-3">
                            <label for="carburant" class="form-label">Fuel Type</label>
                            <input type="text" class="form-control" id="carburant" name="carburant" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Update Vehicle Modal -->
    <div class="modal fade" id="updateVehicleModal" tabindex="-1" aria-labelledby="updateVehicleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateVehicleModalLabel">Edit Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Update vehicle form -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" id="edit-id" name="edit-id">
                        <div class="mb-3">
                            <label for="edit-marque" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="edit-marque" name="edit-marque" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-annee" class="form-label">Year</label>
                            <input type="number" class="form-control" id="edit-annee" name="edit-annee" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-modele" class="form-label">Model</label>
                            <input type="text" class="form-control" id="edit-modele" name="edit-modele" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-couleur" class="form-label">Color</label>
                            <input type="text" class="form-control" id="edit-couleur" name="edit-couleur" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-prix" class="form-label">Price</label>
                            <input type="number" class="form-control" id="edit-prix" name="edit-prix" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-sieges" class="form-label">Seats</label>
                            <input type="number" class="form-control" id="edit-sieges" name="edit-sieges" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-portes" class="form-label">Doors</label>
                            <input type="number" class="form-control" id="edit-portes" name="edit-portes" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-boite_vitesses" class="form-label">Transmission</label>
                            <input type="text" class="form-control" id="edit-boite_vitesses" name="edit-boite_vitesses"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-carburant" class="form-label">Fuel Type</label>
                            <input type="text" class="form-control" id="edit-carburant" name="edit-carburant" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteVehicleModal" tabindex="-1" aria-labelledby="deleteVehicleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteVehicleModalLabel">Delete Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this vehicle?</p>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" id="delete-id" name="delete-id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function() {
        $(".toggleModalBtn").click(function() {
            var id = $(this).data("id");
            var marque = $(this).data("marque");
            var annee = $(this).data("annee");
            var modele = $(this).data("modele");
            var couleur = $(this).data("couleur");
            var prix = $(this).data("prix");
            var sieges = $(this).data("sieges");
            var portes = $(this).data("portes");
            var boite_vitesses = $(this).data("boite_vitesses");
            var carburant = $(this).data("carburant");

            $("#edit-id").val(id);
            $("#edit-marque").val(marque);
            $("#edit-annee").val(annee);
            $("#edit-modele").val(modele);
            $("#edit-couleur").val(couleur);
            $("#edit-prix").val(prix);
            $("#edit-sieges").val(sieges);
            $("#edit-portes").val(portes);
            $("#edit-boite_vitesses").val(boite_vitesses);
            $("#edit-carburant").val(carburant);
        });

        $(".deleteInTable").click(function() {
            var id = $(this).data("id");
            $("#delete-id").val(id);
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        // Rest of your code...

        // Populate the form fields with the fetched values
        <?php if ($vehicleDetails) { ?>
        $("#edit-id").val(<?php echo $vehicleDetails['id_véhicule']; ?>);
        $("#edit-marque").val("<?php echo $vehicleDetails['Marque']; ?>");
        $("#edit-annee").val(<?php echo $vehicleDetails['année']; ?>);
        $("#edit-modele").val("<?php echo $vehicleDetails['Modèle']; ?>");
        $("#edit-couleur").val("<?php echo $vehicleDetails['Couleur']; ?>");
        $("#edit-prix").val(<?php echo $vehicleDetails['Prix']; ?>);
        $("#edit-sieges").val(<?php echo $vehicleDetails['Sièges']; ?>);
        $("#edit-portes").val(<?php echo $vehicleDetails['Portes']; ?>);
        $("#edit-boite_vitesses").val("<?php echo $vehicleDetails['Boîte_vitesses']; ?>");
        $("#edit-carburant").val("<?php echo $vehicleDetails['Carburant']; ?>");
        <?php } ?>
    });
    </script>


</body>


</html>