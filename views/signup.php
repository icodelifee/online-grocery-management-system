<?php
session_start();
require_once('../services/connect_db.php');
if (isset($_POST['form'])) {
    $form = $_POST['form'];
    $hash = password_hash($form['passwd'], PASSWORD_DEFAULT);
    $insertlogin = "INSERT INTO tbl_login (email,pswd,utype) VALUES ('{$form['email']}', '$hash','C')";
    if ($connect->query($insertlogin)) {
        $insert = "INSERT INTO tbl_customer (c_name,c_phno,email,c_address,c_city,c_state,c_pincode) VALUES ('{$form['name']}','{$form['phone']}','{$form['email']}','{$form['address']}','{$form['city']}','{$form['state']}','{$form['zip']}');";
        if ($connect->query($insert)) {
            $_SESSION['user'] = $form['email'];
            $id = getUserId($form['email'], $connect);
            $_SESSION['userId'] = $id;
            $res = createUserCart($id, $connect);
            echo "true";
        } else {
            echo $connect->error;
        }
    } else {
        echo $connect->error;
    }
    exit();
} else if (isset($_POST['user'])) {
    $sql = "SELECT * FROM tbl_login WHERE email='{$_POST['user']['email']}'";
    if ($result = $connect->query($sql)) {
        if ($result->num_rows <= 0) {
            // if user doesn't exist 
            echo "false";
        } else {
            // if user exist
            echo "true";
        }
    } else {
        printf("Query failed: %s\n", $connect->error);
    }
    exit();
}
function createUserCart($id, $connect)
{
    $createCart = "INSERT INTO tbl_cart_master (c_id, items_count, total_price) VALUES ('{$id}', 0, 0)";
    if ($connect->query($createCart)) {
        return true;
    } else {
        echo $connect->error;
        return false;
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
    <div style="width: 20%; float:left">
        <div class="sidenav">
            <div class="login-main-text">
                <h2 class="main-header">Daily Bell</h2>
                <p>Register from here to access.</p>
                <img src="../assets/images/login.png" class="left-img" alt="">
            </div>
        </div>
    </div>

    <div style="width: 80%; float:right">
        <div class="main">
            <div class="container-fluid">
                <div class="col-md-6 col-sm-12">
                    <div class="signup-form">
                        <h3 class="form-header">Sign Up</h3>
                        <form name="signup" id="signupform" onsubmit="return false">
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
                            </div>
                            <button type="submit" name="signup" class="btn btn-primary">Next</button>
                        </form>
                    </div>
                    <div class="modal fade" tabindex="-1" id="myModal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form name="modalform" id="modalform" onsubmit="return false">
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control w-100" name="name" placeholder="Full Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPhone">Phone</label>
                                                <input type="phone" class="form-control w-100" name="phone" id="inputPhone" placeholder="Phone" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control w-100" name="address" id="address" placeholder="Address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputCity">City</label>
                                                <input type="text" class="form-control w-100" name="city" id="inputCity" placeholder="City" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputState">State</label>
                                                <select id="inputState" class="form-control w-100" name="state" required>
                                                    <option selected>Choose...</option>
                                                    <option>Andaman and Nicobar Islands</option>
                                                    <option>Andhra Pradesh</option>
                                                    <option>Arunachal Pradesh</option>
                                                    <option>Assam</option>
                                                    <option>Bihar</option>
                                                    <option>Chandigarh</option>
                                                    <option>Chhattisgarh</option>
                                                    <option>Dadra and Nagar Haveli</option>
                                                    <option>Daman and Diu</option>
                                                    <option>Delhi</option>
                                                    <option>Goa</option>
                                                    <option>Gujarat</option>
                                                    <option>Haryana</option>
                                                    <option>Himachal Pradesh</option>
                                                    <option>Jammu and Kashmir</option>
                                                    <option>Jharkhand</option>
                                                    <option>Karnataka</option>
                                                    <option>Kerala</option>
                                                    <option>Ladakh</option>
                                                    <option>Lakshadweep</option>
                                                    <option>Madhya Pradesh</option>
                                                    <option>Maharashtra</option>
                                                    <option>Manipur</option>
                                                    <option>Meghalaya</option>
                                                    <option>Mizoram</option>
                                                    <option>Nagaland</option>
                                                    <option>Odisha</option>
                                                    <option>Puducherry</option>
                                                    <option>Punjab</option>
                                                    <option>Rajasthan</option>
                                                    <option>Sikkim</option>
                                                    <option>Tamil Nadu</option>
                                                    <option>Telangana</option>
                                                    <option>Tripura</option>
                                                    <option>Uttar Pradesh</option>
                                                    <option>Uttarakhand</option>
                                                    <option>West Bengal</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputZip">Zip</label>
                                                <input type="text" class="form-control w-100" name="zip" id="inputZip" placeholder="Zipcode" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="signup-form" class="btn btn-primary">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="userexist" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ops!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Account with this email already exsits!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="$('#userexist').modal('hide')"">Ok</button>
                    <button type=" button" class="btn btn-secondary" data-dismiss="modal" onclick="document.location.href = 'login.php';">Login</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js">
    </script>
    <script src="../js/formvalidation.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
<style>
    <?php include '../css/login.css'; ?>
</style>

</html>