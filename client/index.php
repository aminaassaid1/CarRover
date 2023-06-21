<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "CarRover");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>


<!DOCTYPE html>
<html>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Home</title>
    <link rel="icon" href="images/icons8-car-rental-64.png" type="image/x-icon">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- font css -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <div class="container">
            <?php      
                if (!empty($_SESSION["id_client"])) {
                    $id_client = $_SESSION["id_client"];
                    $result = mysqli_query($connection, "SELECT * FROM `clients` WHERE id_client = $id_client");
                    $row = mysqli_fetch_assoc($result);
            ?>

            <nav class="navbar navbar-dark bg-dark fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="width: 30%; "></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                        aria-labelledby="offcanvasDarkNavbarLabel">
                        <div class="offcanvas-header">
                            <<li class="nav-item">
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
         }else {
            ?>
                <nav class="navbar body-tertiary" style="background-color: 	#000000;">
                    <div class="container-fluid">
                        <a href="index.html"><img src="images/logo.png" style="width:30%"></a>
                        <div class="row justify-content-between">
                            <div class="col-5">
                                <form action="signup.php" method="get">
                                    <input type="submit" value="Sign up" class="btn"
                                        style="width: 200px; background-color: #FE5B29;" name="signup">
                                </form>
                            </div>
                            <div class="col-5">
                                <form action="login.php" method="get">
                                    <input type="submit" value="Login" class="btn"
                                        style="width: 200px; background-color: #FE5B29;" name="login">
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- header section end -->
    <div class="call_text_main">
        <div class="container">
            <div class="call_taital">
                <div class="call_text"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span
                            class="padding_left_15">Location</span></a></div>
                <div class="call_text"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i><span
                            class="padding_left_15">0534679210</span></a></div>
                <div class="call_text"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i><span
                            class="padding_left_15">CarRover@gmail.com</span></a></div>
            </div>
        </div>
    </div>
    <!-- banner section start -->
    <div class="banner_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div id="banner_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="banner_taital_main">
                                    <h1 class="banner_taital">Car Rent <br><span style="color: #fe5b29;">For You</span>
                                    </h1>
                                    <p class="banner_text">The best place to find great used cars</p>
                                    <div class="btn_main">
                                        <div class="contact_bt"><a href="#">Read More</a></div>
                                        <div class="contact_bt active"><a href="#">Contact Us</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="banner_taital_main">
                                    <h1 class="banner_taital">Car Rent <br><span style="color: #fe5b29;">For You</span>
                                    </h1>
                                    <p class="banner_text">WE MOVE DREAMS GET YOUR FAST CAR IN A FAST WAY</p>
                                    <div class="btn_main">
                                        <div class="contact_bt"><a href="#">Read More</a></div>
                                        <div class="contact_bt active"><a href="#">Contact Us</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="banner_taital_main">
                                    <h1 class="banner_taital">Car Rent <br><span style="color: #fe5b29;">For You</span>
                                    </h1>
                                    <p class="banner_text">There are many variations of passages of Lorem Ipsum
                                        available, but the majority</p>
                                    <div class="btn_main">
                                        <div class="contact_bt"><a href="#">Read More</a></div>
                                        <div class="contact_bt active"><a href="#">Contact Us</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#banner_slider" role="button" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#banner_slider" role="button" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner_img"><img src="images/banner-img.png"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner section end -->
    <!-- about section start -->
    <div class="about_section layout_padding">
        <div class="container">
            <div class="about_section_2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="image_iman"><img src="images/about-img.png" class="about_img"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="about_taital_box">
                            <h1 class="about_taital">About <span style="color: #fe5b29;">Us</span></h1>
                            <p class="about_text">At CarRover, we are dedicated to providing exceptional car rental
                                services to our valued customers. With a strong commitment to reliability,
                                affordability, and customer satisfaction, we strive to make your car rental experience
                                smooth and hassle-free.</p>
                            <div class="readmore_btn"><a href="#">Read More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white pt-3 px-lg-5 mx-auto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <form action="listcar.php" method="get">
                                <div class="date mb-3" id="date" data-target-input="nearest">
                                    <label for="pickup">Pickup Date</label>
                                    <input type="date" class="form-control p-4 datetimepicker-input" name="pickup"
                                        placeholder="Pickup Date" id="pickup" data-target="#date"
                                        data-toggle="datetimepicker" />
                                </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="date mb-3" id="dateoff" data-target-input="nearest">
                                <label for="dropoff">Drop off Date</label>
                                <input type="date" class="form-control p-4 datetimepicker-input" name="dropoff"
                                    placeholder="Drop off Date" data-target="#dateoff" id="dropoff"
                                    data-toggle="datetimepicker" />
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 d-flex justify-content-center align-items-start">
                            <button class="btn btn-block mb-3" name="sea" type="submit"
                                style="height: 80px; background-color: #fe5b29; margin-top: 30px;">Search</button>    
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- gallery section start -->


        <!-- Modal start-->
        <!-- Booking modal -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Book Now</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="book.php" method="post">
                            <div class="mb-3">
                                <label for="startDate" class="form-label">Date debut:</label>
                                <input type="date" class="form-control" id="startDate" name="startDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="endDate" class="form-label">Date fin:</label>
                                <input type="date" class="form-control" id="endDate" name="endDate" required>
                            </div>
                            <input type="hidden" id="vehicleID" name="vehicleID">
                            <input type="hidden" id="etat" name="etat" value="pending">
                            <button type="submit" class="btn btn-primary">Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function() {
            $('.bookvehic').click(function() {
                var vehicleID = $(this).data('vehicle-id');
                $('#vehicleID').val(vehicleID);
            });
        });
        </script>



        <!-- Modal end -->
        <div class="gallery_section layout_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="gallery_taital">FIND YOUR CAR</h1>
                    </div>
                </div>
                <?php
                $query = "SELECT * FROM Véhicule";
                $result = mysqli_query($connection, $query);
                ?>
                <div class="gallery_section_2">
                    <div class="row">
                        <?php
                            $query = "SELECT * FROM Véhicule LIMIT 3"; // Retrieve only 3 rows from the table
                            $result = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $vehicleID = $row['id_véhicule']; // Get the vehicle ID from the row

                                echo '<div class="col-md-4">';
                                echo '    <div class="gallery_box">';
                                echo '        <div class="gallery_img"><img src="' . $row['Image'] . '"></div>';
                                echo '        <h3 class="types_text">' . $row['Marque'] . ' ' . $row['Modèle'] . '</h3>';
                                echo '        <p class="looking_text">Start per day MAD ' . $row['Prix'] . '</p>';
                                echo '        <p> id véhicule : ' . $row['id_véhicule'] . '</p>';
                                echo '        <div class="read_bt">';
                                echo '           <a href="#" class=" book-now-link bookvehic" data-bs-toggle="modal" data-bs-target="#bookingModal" data-vehicle-id="' . $vehicleID . '">Book Now</a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';
                            }

                            mysqli_close($connection);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- gallery section end -->
        <!-- choose section start -->
        <div class="choose_section layout_padding" style="margin-bottom: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="choose_taital">WHY CHOOSE US</h1>
                    </div>
                </div>
                <div class="choose_section_2">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="icon_1"><img src="images/icon-1.png"></div>
                            <h4 class="safety_text">SAFETY & SECURITY</h4>
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <div class="icon_1"><img src="images/icon-2.png"></div>
                            <h4 class="safety_text">Online Booking</h4>
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <div class="icon_1"><img src="images/icon-3.png"></div>
                            <h4 class="safety_text">Best Drivers</h4>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact section start -->
        <?php 

        if(!empty($_SESSION["id_client"])){
            ?>
             <div class="contact_section">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="contact_taital">Reporter</h1>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="contact_section_2">
                            <div class="row d-flex justify-content-around">
                                <div class="col-md-10">
                                    <form method="POST" action="save_report.php">
                                        <input type="text" class="mail_text" placeholder="Subject" name="subject">
                                        <textarea class="massage-bt" placeholder="Message" rows="5" id="comment"
                                            name="message"></textarea>
                                        <div class="send_bt">
                                            <button type="submit" class="btn btn-light">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
        }   
        ?>
       
    </div>
    <!-- contact section end -->
    <!-- footer section start -->
    <div class="footer_section ">
        <div class="container" >
            <div class="footer_section_2">
                <div class="row">
                    <div class="col">
                        <h4 class="footer_taital">CarRover</h4>
                        <p class="footer_text">We at CarRover are dedicated to providing exceptional car rental services
                            to our valued customers. With a strong commitment to reliability, affordability, and
                            customer satisfaction, we strive to make your car rental experience smooth and hassle-free
                        </p>
                    </div>
                    <div class="col">
                        <h4 class="footer_taital">Contact Us</h4>
                        <div class="location_text"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span
                                    class="padding_left_15">Location</span></a></div>
                        <div class="location_text"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i><span
                                    class="padding_left_15">0534679210</span></a></div>
                        <div class="location_text"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i><span
                                    class="padding_left_15">CarRover@gmail.com</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="copyright_text">2023 All Rights Reserved. Design by <a href="https://html.design">© 2023
                            CarRover. All rights reserved.</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript files-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- JavaScript code -->
    <script>
    // Wait for the document to load
    document.addEventListener("DOMContentLoaded", function() {
        // Get the modal element
        var bookingModal = document.getElementById("bookingModal");

        // Get the "Book Now" buttons
        var bookButtons = document.querySelectorAll(".read_bt a");

        // Add event listeners to the buttons
        bookButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault();

                // Get the selected dates
                var startDate = document.getElementById("pickup").value;
                var endDate = document.getElementById("dropoff").value;
                var vehicleID = button.getAttribute("data-vehicle-id");

                console.log("startDate:", startDate);
                console.log("endDate:", endDate);
                console.log("vehicleID:", vehicleID);
                // 
                document.getElementById("startDate").value = startDate;
                document.getElementById("endDate").value = endDate;
                document.getElementById("vehicleID").value = vehicleID;

                // Open the modal
                var modal = new bootstrap.Modal(bookingModal);
                modal.show();
            });
        });
    });
    </script>

</body>
</html>