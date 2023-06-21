<?php
require_once 'Vehicle.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrover";

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
        $prix = $_POST["prix"];

        $vehicle->addVehicle($marque, $annee, $modele, $couleur, $prix);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["update"])) {
        $id = $_POST["edit-id"];
        $marque = $_POST["edit-marque"];
        $annee = $_POST["edit-annee"];
        $modele = $_POST["edit-modele"];
        $couleur = $_POST["edit-couleur"];
        $prix = $_POST["edit-prix"];

        $vehicle->updateVehicle($id, $marque, $annee, $modele, $couleur, $prix);

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

<!DOCTYPE html>
<html>
<head>
    <title>Vehicle CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
        .report-list {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
<body>
    <div class="container mt-5">
        <h2>Vehicle List</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marque</th>
                        <th>Année</th>
                        <th>Modèle</th>
                        <th>Couleur</th>
                        <th>Prix</th>
                        <th>Action</th>
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
                            <td>
                                <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editModal" data-id="<?php echo $vehicle['id_véhicule']; ?>" data-marque="<?php echo $vehicle['Marque']; ?>" data-annee="<?php echo $vehicle['année']; ?>" data-modele="<?php echo $vehicle['Modèle']; ?>" data-couleur="<?php echo $vehicle['Couleur']; ?>" data-prix="<?php echo $vehicle['Prix']; ?>">Edit</button>
                                <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $vehicle['id_véhicule']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <button type="button" class="btn btn-success" data-toggle="modal" name="add" data-target="#addModal">Add Vehicle</button>
    </div>

    <!-- Add Vehicle Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="marque">Marque:</label>
                            <input type="text" class="form-control" id="marque" name="marque" required>
                        </div>
                        <div class="form-group">
                            <label for="annee">Année:</label>
                            <input type="text" class="form-control" id="annee" name="annee" required>
                        </div>
                        <div class="form-group">
                            <label for="modele">Modèle:</label>
                            <input type="text" class="form-control" id="modele" name="modele" required>
                        </div>
                        <div class="form-group">
                            <label for="couleur">Couleur:</label>
                            <input type="text" class="form-control" id="couleur" name="couleur" required>
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix:</label>
                            <input type="text" class="form-control" id="prix" name="edit-prix" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Vehicle Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="edit-id">
                        <div class="form-group">
                            <label for="edit-marque">Marque:</label>
                            <input type="text" class="form-control" id="edit-marque" name="edit-marque" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-annee">Année:</label>
                            <input type="text" class="form-control" id="edit-annee" name="edit-annee" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-modele">Modèle:</label>
                            <input type="text" class="form-control" id="edit-modele" name="edit-modele" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-couleur">Couleur:</label>
                            <input type="text" class="form-control" id="edit-couleur" name="edit-couleur" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-prix">Prix:</label>
                            <input type="text" class="form-control" id="edit-prix" name="edit-prix" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Vehicle Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this vehicle?</p>
                        <input type="hidden" id="delete-id" name="delete-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger" name="delete">Yes, Delete</button>
                    </div>

                </form>


            </div>
        </div>
    </div>

    <div class="report-list">
        <table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Subject</th>
                <th>Text</th>
                <th>Client ID</th>
            </tr>
            <?php
            // Display the reports
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_reporter"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["subject"] . "</td>";
                    echo "<td>" . $row["text"] . "</td>";
                    echo "<td>" . $row["id_client"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No reports found.</td></tr>";
            }
            ?>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $(".edit-btn").click(function() {
                var id = $(this).data("id");
                var marque = $(this).data("marque");
                var annee = $(this).data("annee");
                var modele = $(this).data("modele");
                var couleur = $(this).data("couleur");
                var prix = $(this).data("prix");

                $("#edit-id").val(id);
                $("#edit-marque").val(marque);
                $("#edit-annee").val(annee);
                $("#edit-modele").val(modele);
                $("#edit-couleur").val(couleur);
                $("#edit-prix").val(prix);
            });
            $(".delete-btn").click(function() {
                var id = $(this).data("id");
                $("#delete-id").val(id);
            });
        });
    </script>
</body>
</html>
