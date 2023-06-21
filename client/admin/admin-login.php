<?php
 session_start();
 if (isset($_SESSION["admin_id"])) {
    header("location: dashboard.php");
    exit();
}
// DB configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrover";
// 
$conn = new mysqli($servername, $username, $password, $dbname);

// conn check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $passwordd = $_POST["password"];
    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($passwordd, $row["password"])) {
            // Admin login success!
            session_start();
            $_SESSION["admin_id"] = $row["Id_Admin"];
            $_SESSION["f_name"] =$row["prénom"];
            $_SESSION["l_name"]=$row["nom"];
            $_SESSION["email"]=trim($row["email"]);
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = " error";
    }
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
</head>

<body>

    <?php if (isset($error_message)) { ?>
    <p><?php echo $error_message; ?></p>
    <?php } ?>
    <section class="vh-100" style="background-color: #FFFFFF;">
        <div class="container py-5 h-100 " >
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem; border: none">
                        <div class="row g-0 shadow-lg p-3 rounded">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="../images/bk-admin.jfif" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">CarRover Admin Login : </span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"></h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example17" class="form-control form-control-lg"
                                                name="email" />

                                            <label class="form-label" name="email" for="form2Example17">Email
                                                address</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example27"
                                                class="form-control form-control-lg" name="password" />
                                            <label class="form-label" name="password"
                                                for="form2Example27">Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" name="login" type="submit">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
$conn->close();
?>