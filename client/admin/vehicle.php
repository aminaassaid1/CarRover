<?php

// You can call it Vehicle, or better call it during the presentation VehicleManager.

class Vehicle
{
    private $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAllVehicles()
    {
        $sql = "SELECT * FROM `véhicule`";
        $result = $this->conn->query($sql);

        $vehicles = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $vehicles[] = $row;
            }
        }

        return $vehicles;
    }

    public function addCar($marque, $annee, $modele, $couleur, $prix, $sieges, $portes, $boiteVitesses, $carburant,$dossier)
    {
        $sql = "INSERT INTO `véhicule` (`image`,`Marque`, `année`, `Modèle`, `Couleur`, `Prix`, `Sièges`, `Portes`, `Boîte_vitesses`, `Carburant`) 
        VALUES ('$dossier','$marque', '$annee', '$modele', '$couleur', '$prix', '$sieges', '$portes', '$boiteVitesses', '$carburant')";

        if ($this->conn->query($sql) === TRUE) {
            return true ;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    public function updateVehicle($id, $marque, $annee, $modele, $couleur, $prix, $sieges, $portes, $boiteVitesses, $carburant)
    {
        $sql = "UPDATE `véhicule` SET `Marque`='$marque', `année`='$annee', `Modèle`='$modele', `Couleur`='$couleur', `Prix`='$prix', `Sièges`='$sieges', `Portes`='$portes', `Boîte_vitesses`='$boiteVitesses', `Carburant`='$carburant' WHERE `id_véhicule`='$id'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    public function deleteVehicle($id)
    {
        $sql = "DELETE FROM `réservation` WHERE `id_véhicule`='$id'";

        if ($this->conn->query($sql) === TRUE) {
            $sql_vehicule = "DELETE FROM `véhicule` WHERE `id_véhicule`='$id'";
        }
        if ($this->conn->query($sql_vehicule) === TRUE) {
            return true;
        }
        
        else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
?>
