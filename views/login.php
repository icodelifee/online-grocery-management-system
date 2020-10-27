<?php
session_start();
require_once('../services/connect_db.php');
if (isset($_SESSION["user"])) {
    echo "<script>alert('You are already logged in')</script>";
    header('location: ../index.php');
    exit();
}
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $sql = "select * from tbl_login where email='" . $email . "'";
    if ($result = $connect->query($sql)) {
        if (password_verify($password, $result->fetch_array()["pswd"])) {
            $id = getUserId($email, $connect);
            $_SESSION['user'] = $email;
            $_SESSION['userId']= $id;
            header('location: ../index.php');
            exit();
        }else{
            echo '<script>alert("Incorrect Email Or Password!")</script>';
        }
    } else {
        if ($connect->error) {
            echo '<script>console.log(' . $connect->error . ')</script>';
        }
    }
}
function getUserId($email, $connect)
{
    $sql = 'SELECT c_id FROM tbl_customer WHERE email="' . $email . '"';
    if ($res = $connect->query($sql)) {
        $resp = $res->fetch_array();
        return $resp[0];
    } else {
        echo $connect->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2 class="main-header">Daily Bell</h2>
            <p>Login from here to access.</p>
            <img src="../assets/images/login.png" class="left-img" alt="">
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <h3 class="form-header">Login</h3>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
                <br>
            </div>
        </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
<style>
    <?php include '../css/login.css'; ?>
</style>

</html>