<?php
// session_start();
require_once(realpath(dirname(__FILE__) . "/../services/connect_db.php"));
$user;
if (isset($_SESSION['user'])) {
    $sql = "select * from tbl_customer where email='" . $_SESSION['user'] . "'";
    if ($result = $connect->query($sql)) {
        $user = $result->fetch_array();
    } else {
        echo $connect->error;
    }
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-dark">

    <a class="navbar-brand" href="/miniproject">Dailybell</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <form class="form-inline search-form my-2 my-lg-0">
            <input class="form-control" id="search-bar" type="text" placeholder="Search products" aria-label="Search">
            <i class="fas fa-search text-white ml-3" aria-hidden="true"></i>
        </form>

        <ul class="navbar-nav ml-auto">
            <?php
            if (isset($user)) {
                echo '<a  href="/miniproject/views/cart.php"><div id="ex4" style="font-size: 1.3rem; color:white">
                        <span class="p1 fa-stack fa-lg has-badge" data-count="4">
                            <!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
                            <i class="p3 fa fa-shopping-cart fa-stack-1x xfa-inverse" data-count="4b"></i>
                        </span>
                    </div></a>';
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="/miniproject/views/cart.php">
                        Hi, ' . $user[1] . '<span class="sr-only">(current)</span>
                    </a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="logout()">Logout<span class="sr-only">(current)</span></a> 
                </li>';
            } else {
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="/miniproject/views/login.php">
                        Login
                        <span class="sr-only">(current)</span>
                    </a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/miniproject/views/signup.php">
                        Signup
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                ';
            }
            ?>
        </ul>
    </div>
</nav>
<script>
    function logout() {
        console.log(window.location.pathname.split('/'));
        $.ajax({
            url: "/" + window.location.pathname.split('/')[1] + '/services/logout.php'
        }).done(function(data) {
            console.log(data);
            if (data == "true") {
                location.reload();
            }
        });
    }
</script>

<style>
    .navbar-dark {
        background-color: #2d5dd9;
        box-shadow: none;
    }

    .navbar-brand {
        font-family: 'CSB';
        letter-spacing: 0.3;
        padding-left: 10px;
        font-size: 30px;
    }

    .nav-item {
        font-size: 15px;
        padding-right: 10px;
        padding-left: 10px;
    }

    .search-form {
        margin-left: 100px;
    }

    .fa-search {
        font-size: 2rem;
    }

    #search-bar {
        width: 500px;
        height: 40px;
        font-size: 13px;
        padding-left: 20px;
        /* margin-left: 20px; */
    }

    #ex4 .p1[data-count]:after {
        position: absolute;
        right: 10%;
        top: 8%;
        content: attr(data-count);
        font-size: 40%;
        padding: .2em;
        border-radius: 50%;
        line-height: 1em;
        color: white;
        background: rgba(255, 0, 0, .85);
        text-align: center;
        min-width: 1em;

    }
</style>