<?php
    $connection = mysqli_connect("localhost", "root", "", "CarRover");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    session_start();
    $id_client = $_SESSION["id_client"];
 

class profile {
    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $CIN;
    private $password;
    private $id_client ;
    private $city;
    private $Country;
    private $photo;



    public function __construct( $first_name , $last_name , $email ,$phone,$CIN,$password,$city,$Country,$id_client,$photo){
        $this -> fname =  $first_name ;
        $this -> lname = $last_name ;
        $this -> email = $email ;
        $this -> phone = $phone ;
        $this -> CIN = $CIN ;
        $this -> password = $password ;
        $this -> id_client = $id_client ;
        $this -> city = $city ;
        $this -> Country= $Country ;
        $this -> photo = $photo ;
    }

    public function edite_profile($connection){
        $first_name = $connection -> real_escape_string($this -> fname); 
        $last_name = $connection -> real_escape_string($this -> lname);
        $email = $connection -> real_escape_string($this -> email);
        $phone =   $this -> phone ;
        $CIN = $connection -> real_escape_string($this -> CIN);
        $password = $connection -> real_escape_string($this -> password);
        $id_client = $this -> id_client ;
        $city = $connection -> real_escape_string($this -> city);
        $Country = $connection -> real_escape_string($this -> Country);
        $photo = $this -> photo ;
        if($password != ""){
            $sql = "UPDATE `clients` SET `Prénom`='$first_name',`Nom`='$last_name',`CIN`='$CIN',`Email`='$email',`Phone`='$phone',`Pays`='$Country',`ville`='$city',`password`='$password' WHERE id_client = '$id_client'" ;
        }else{
            $sql = "UPDATE `clients` SET `Prénom`='$first_name',`Nom`='$last_name',`CIN`='$CIN',`Email`='$email',`Phone`='$phone',`Pays`='$Country',`ville`='$city' WHERE id_client = '$id_client'" ;
        }
        if($photo !=='images/' ){
            $sql = "UPDATE `clients` SET image ='$photo' WHERE id_client = $id_client" ;
        }
        $result = $connection -> query($sql);
        return $result ;
    }

    
}
class affiche_value{
    private $id_client ;

    public function __construct($id_client){
        $this -> id_client = $id_client ;
    }

    public function value_client($connection){
        $id_client =  $this -> id_client ;
        $sql = "SELECT * FROM `clients` WHERE id_client = $id_client";
        $result = $connection-> query($sql);
        return $result ;
    }
}
        if(isset($_POST["submit"])){
            $first_name = $_POST["fname"];
            $last_name = $_POST["lname"] ;
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $CIN = $_POST["CIN"];
            $password = $_POST["password"];
            $new_password =  password_hash($password, PASSWORD_DEFAULT);   
            $city =$_POST["city"];
            $Country=$_POST["Country"];
            $photo =$_FILES["photo"]["name"];
            $tmp_name=$_FILES["photo"]["tmp_name"];
            $dossier = "images/".$photo;
            move_uploaded_file($tmp_name,$dossier);
            $id_client =$_SESSION["id_client"];
    
        $client = new profile ($first_name , $last_name , $email ,$phone,$CIN,$new_password,$city,$Country,$id_client,$dossier);
            $resulta = $client->edite_profile($connection);

        }

    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="Profile.css">
    <title>edite_profile</title>
    <link rel="icon" href="images/icons8-car-glyph-neue-96.png" type="image/x-icon">
    <meta name="keywords" content="">
</head>

<body>
            <?php
                $id_client = $_SESSION["id_client"];
                $result = mysqli_query($connection, "SELECT * FROM `clients` WHERE id_client = $id_client");
                $row = mysqli_fetch_assoc($result);
            ?>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><img src="images/logo.png" style="width: 30%; "></a>
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
                            <style>
                            svg {
                                fill: #ededed
                            }
                            </style>
                            <path
                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                        </svg>
                        <h3 class="nav-link" href="Profile.php"><?php echo $row['Nom']; ?></h3>
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
    <div class="main">
        <section class="section">
            <div class="container">
                <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="user-avatar">
                                            <?php
                                                $id_client = $_SESSION["id_client"];
                                                $displayImage = new affiche_value($id_client);
                                                $result_image = $displayImage->value_client($connection);

                                                $row_image = $result_image->fetch_assoc();
                                                $image = $row_image["image"];

                                                // Check if the image path is not empty and the file exists
                                                if (!empty($image) && file_exists($image)) {
                                                    echo '<img src="' . $image . '" alt="Profile">';
                                                } else {
                                                    echo '<img src="path_to_default_image.jpg" alt="Profile">';
                                                    // Debugging statements
                                                    echo 'Image path: ' . $image . '<br>';
                                                    echo 'File exists: ' . (file_exists($image) ? 'Yes' : 'No') . '<br>';
                                                }
                                            ?>
                                        </div>
                                        <h5 class="user-name">
                                            <?php 
                                                $name = $_SESSION["Nom"];
                                                $prenom = $_SESSION["Prénom"];

                                                echo $name.' '.$prenom;
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-3 " style="color: #FE5B29;">Personal Details</h6>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <?php 
                                            $id_client = $_SESSION["id_client"];
                                            $displayClient = new affiche_value($id_client);

                                            $result_display = $displayClient->value_client($connection);
                                            if($result_display->num_rows>0){
                                            while($row=$result_display->fetch_assoc()){
                                        ?>
                                        <div class="row gutters">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <label for="fullName">First name</label>
                                                <input type="text" class="form-control" name="fname"
                                                    value="<?php echo $row["Prénom"]; ?>" id="fullName"
                                                    placeholder="Enter full name">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="lname">last name </label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $row["Nom"]; ?>" name="lname" id="lname">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <label for="sTate">city</label>
                                                <input type="text" name="city" value="<?php echo $row["ville"]; ?>"
                                                    class="form-control" id="city">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="Country">Country </label>
                                                    <input type="Country" class="form-control"
                                                        value="<?php echo $row["Pays"]; ?>" name="Country" id="Country">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <label for="CIN">CIN</label>
                                                <input type="text" class="form-control"
                                                    value="<?php echo $row["CIN"]; ?>" name="CIN" id="CIN">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="phone">phone</label>
                                                    <input type="tel" class="form-control"
                                                        value="<?php echo $row["Phone"]; ?>" name="phone" id="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control"
                                                    value="<?php echo $row["Email"]; ?>" name="email" id="email">
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="password">password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        id="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Profile photo</label>
                                            <input class="form-control" type="file" name="photo" id="formFile">
                                        </div>
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="text-right">
                                                    <button type="submit" id="submit" name="submit" class="btn"
                                                        style="width: 200px; background-color: #FE5B29;">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                            }  
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>