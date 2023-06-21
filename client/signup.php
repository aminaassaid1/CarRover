<?php
  
  if (isset($_POST['submit'])) {
    $first_name = $_POST['Firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $CIN  = $_POST['CIN'];
    $phone = $_POST['phone'];
    $city =  $_POST['city'];
    $country = $_POST['country'];
    $password = $_POST['password']; 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);   
    // validate form data
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($CIN) || empty($phone) || empty($city)) {
      echo "Please fill in all fields)";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Please enter a valid email address.";
    } else {
      // connect to the database
      $conn = mysqli_connect("localhost", "root", "", "CarRover");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // insert data into database
      $sql = "INSERT INTO `clients` (`Prénom`, `Nom`, `CIN`, `Email`, `Phone`, `Pays`, `ville`, `password`)
      VALUES ('$first_name', '$last_name', '$CIN', '$email', '$phone', '$city', '$country', '$hashed_password')";
      if ($conn->query($sql) === TRUE) {
        header("location: login.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
    }
  }
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign up</title>
    <link rel ="icon"  href = "images/icons8-car-rental-64.png"  type = "image/x-icon">    <meta name="keywords" content="">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="stylee.css">
</head>

<body>

    <div class="site-wrap d-md-flex align-items-stretch">
        <div class="bg-img" style="background-image: url('images/zyro-image.png')"></div>
        <div class="form-wrap">
            <div class="form-inner">
                <h1 class="title">Sign up</h1>
                <p class="caption mb-4">Create your account in seconds.</p>

                <form action="" method="post" class="pt-3">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" id="Firstname" name="Firstname"
                                    class="form-control form-control-lg" />
                                <label class="form-label" for="Firstname">First name</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" id="lastname" name="lastname" class="form-control form-control-lg" />
                                <label class="form-label" for="lastname">Last name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" id="CIN" name="CIN" class="form-control form-control-lg" />
                                <label class="form-label" for="CIN">CIN</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" id="phone" name="phone" class="form-control form-control-lg" />
                                <label class="form-label" for="phone">phone</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" id="city" name="city" class="form-control form-control-lg" />
                                <label class="form-label" for="city">city</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="text" id="country" name="country" class="form-control form-control-lg" />
                                <label class="form-label" for="country">country</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" name="password">
                        </div>
                    </div>
                    <div class="d-grid mb-4">
                        <button type="submit" name="submit" class="btn btn-primary">Create an account</button>
                    </div>
                    <div class="mb-2">Already a member? <a href="login.php">Log in</a></div>
                    <div class="mb-2">Back to <a href="index.php">HOME</a></div>
                </form>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="js/custom.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });
    </script>
</body>

</html>