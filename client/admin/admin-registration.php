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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reporter</title>
    <link rel="icon" href="images/icons8-car-rental-64.png" type="../images/icons8-car-glyph-neue-96.png">
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
                ?><br /><span>Reporter</span></p>
                <i class="fa fa-tasks box-icon" aria-hidden="true"></i>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-auto">
                <form action="" method="post" class="d-flex">
                    <select class="form-select form-select-lg mb-3" style="width: 200px;" name="SEARCHname"
                        aria-label=".form-select-lg example">
                        <option selected>Booking status</option>
                        <option value="Canceled">canceled</option>
                        <option value="Confirmed">confirmed</option>
                        <option value="Pending">Pending</option>
                    </select>
                    <button type="submit" class="btn btn-primary" style="height: 50px;" name="search">Search</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <br /><br />
        <div class="col">
            <div class="box">
                <div class="content-box">
                    <div>
                        <p>All registration</p>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Reservation ID</th>
                                <th>Date_réservation</th>
                                <th>Etat</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Return date</th>
                                <th>véhicule ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $query = "";
                                    $result = "";
                                    
                                    if(isset($_POST["search"])){
                                        $search = $_POST["SEARCHname"];
                                        if($search == 'Pending'){
                                            $query = "SELECT * FROM `réservation` WHERE `Etat` = 'Pending'";
                                            $result = mysqli_query($conn, $query);
                                        }elseif($search == 'Confirmed'){
                                            $query = "SELECT * FROM `réservation` WHERE `Etat` = 'Confirmed'";
                                            $result = mysqli_query($conn, $query);
                                        }elseif($search == 'Cancel'){
                                            $query = "SELECT * FROM `réservation` WHERE `Etat` = 'Cancel'";
                                            $result = mysqli_query($conn, $query);
                                        }
                                    }else{
                                        $query = "SELECT * FROM `réservation`";
                                        $result = mysqli_query($conn, $query);
                                    }

                                    if (mysqli_num_rows($result) > 0) {
                                    
                                        
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>'.$row['id_Reservation'].'</td>';
                                            echo '<td>'.$row['Date_réservation'].'</td>';
                                            echo '<td>'.$row['Etat'].'</td>';
                                            echo '<td>'.$row['Date_fin'].'</td>';
                                            echo '<td>'.$row['Date_début'].'</td>';
                                            echo '<td>'.$row['date_retour'].'</td>';
                                            echo '<td>'.$row['id_véhicule'].'</td>';
                                            
                                            if($row["Etat"]=='Pending'){
                                                echo '<td>';
                                                echo '<form method="post" action="process_reservation.php">';
                                                echo '<input type="hidden" name="id_reservation" value="'.$row['id_Reservation'].'"/>';
                                                echo '<button class="btn btn-success" type="submit" name="confirmed" >Confirmed</button>';
                                                echo '<button class="btn btn-danger" type="submit" name="canceled" >Canceled</button>';
                                                echo '</form>';
                                                echo '</td>';
                                            }elseif($row["Etat"]=='Confirmed'){
                                                echo '<td>';
                                                echo '<form method="post" action="process_reservation.php">';
                                                echo '<input type="hidden" name="id_reservation" value="'.$row['id_Reservation'].'"/>';
                                                echo '<button class="btn btn-info" type="submit" name="Return" >Return</button>';
                                                echo '</form>';
                                                echo '</td>';
                                            }else{
                                                echo '<td>';
                                                echo "---";
                                                echo '</td>';

                                            }
                                        }
                                    } else {
                                        echo 'No reservations found';
                                    }

                                ?>

                        </tbody>
                    </table>




                </div>
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
</body>

</html>