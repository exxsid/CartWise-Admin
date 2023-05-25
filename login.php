<?php
if (!isset($_SESSION)) {
    session_start();
}
include './utils/db.php';

if (isset($_POST['email'])) {
    $result = $db->query("SELECT * FROM `admin`
            left join users ON admin.user_id = users.id
            where email = '" . $_POST['email'] . "' AND password='" . $_POST['password'] . "'");
    if (mysqli_num_rows($result)) {
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['adminId'] = $admin['user_id'];
        $_SESSION['fname'] = $admin['firstname'];
        $_SESSION['lname'] = $admin['lastname'];
        header("location: index.php");
    } else {
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CartWise - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="card position-center">
                            <img src="img\logo.svg" alt="CartWise Logo" class="rounded mx-auto d-block" alt="..." alt="Lights" style="width: 350px;">
                            </a>
                        </div>
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-4">Sign In Now</h1>
                                    <h2 class="h6 text-gray-900 mb-4">Please login to continue</h2>
                                </div>
                                <form class="user" method="POST">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" required name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Sign in</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="signupp.php">New User? Sign Up</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>