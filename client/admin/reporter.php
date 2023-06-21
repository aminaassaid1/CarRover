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
    <link rel ="icon"  href = "images/icons8-car-rental-64.png"  type = "../images/icons8-car-glyph-neue-96.png">    <meta name="keywords" content="">
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
                $sqlReporter = "SELECT COUNT(*) AS total_reporters
                FROM reporter;";
                $result = $conn->query($sqlReporter);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalReporters = $row["total_reporters"];
                    echo " " . $totalReporters;
                }else {
                        echo "0";
                    }                
                ?><br /><span>Reporter</span></p>
                <i class="fa fa-tasks box-icon" aria-hidden="true"></i>
            </div>
        </div>


        <div class="clearfix"></div>
        <br /><br />
        <div class="col">
            <div class="box">
                <div class="content-box">
                        <div>
                            <p>All Clients' Reporters</p>
                        </div>
                    <?php
                        $sql = "SELECT * FROM `reporter`";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {

                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Text</th>
                                    <th>Client ID</th>
                                </tr>";
                            echo "</thead>";

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id_reporter'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['subject'] . "</td>";
                                echo "<td>" . $row['text'] . "</td>";
                                echo "<td>" . $row['id_client'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No records found";
                        }
                    ?>
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