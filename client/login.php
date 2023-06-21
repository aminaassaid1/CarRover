<?php
session_start();

if (isset($_SESSION["id_client"])) {
    header("location: index.php");
    exit();
}

$msgs = "";

class Database
{
    private $connection;

    public function __construct($host, $username, $password, $database)
    {
        $this->connection = mysqli_connect($host, $username, $password, $database);
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

class User
{
    private $email;
    private $password;
    private $connection;

    public function __construct($email, $password, $connection)
    {
        $this->email = $email;
        $this->password = $password;
        $this->connection = $connection;
    }

    public function login()
    {
        $stmt = mysqli_prepare($this->connection, "SELECT * FROM `clients` WHERE `Email` = ?");
        mysqli_stmt_bind_param($stmt, "s", $this->email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($this->password, $row["password"])) {
                $_SESSION["Email"] = $row["Email"];
                $_SESSION["password"] = $row["password"];
                $_SESSION["id_client"] = $row["id_client"];
                $_SESSION["Nom"] = $row["Nom"];
                $_SESSION["Prénom"] = $row["Prénom"];
                $_SESSION["CIN"] = $row["CIN"];
                $_SESSION["image"] = $row["image"];
                $_SESSION["Phone"] = $row["Phone"];
                $_SESSION["Pays"] = $row["Pays"];
                $_SESSION["ville"] = $row["ville"];
                header("location: index.php");
                exit();
            } else {
                $GLOBALS['msgs'] = "Incorrect password.";
            }
        } else {
            $GLOBALS['msgs'] = "Email does not exist.";
        }

        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database("localhost", "root", "", "CarRover");
    $connection = $database->getConnection();

    $user = new User($email, $password, $connection);
    $user->login();

    mysqli_close($connection);
}
?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <title> Login </title>
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
        <div class="bg-img" style="background-image: url('images/zyro-image.png) !i"></div>
        <div class="form-wrap">
            <div class="form-inner">
                <h1 class="title">Login</h1>
                <p class="caption mb-4">Please enter your login details to sign in.</p>

                <form action="#" class="pt-3" method="post">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="email" placeholder="info@example.com">
                        <label for="email">Email Address</label>
                    </div>

                    <div class="form-floating">
                        <span class="password-show-toggle js-password-show-toggle"><span class="uil"></span></span>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password">
                        <label for="password">Password</label>
                    </div>


                    <div class="d-grid mb-4">
                        <button type="submit" name="login" class="btn btn-primary">Log in</button>
                    </div>

                    <div class="mb-2">Don’t have an account? <a href="signup.php">Sign up</a></div>

                </form>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="js/custom.js"></script>


    <script src="script.js"></script>
</body>

</html>