<?php
require_once(realpath(dirname(__FILE__) . "/../services/connect_db.php"));
$p;
if (isset($_GET["id"])) {
    $select = "SELECT * FROM tbl_item WHERE item_id=" . $_GET["id"];
    if ($result = $connect->query($select)) {
        $p = $result->fetch_array();
    } else {
        echo $connect->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--jQuery library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
    <!-- Bootstrap Core -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Bootstrap Glyphs -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/product.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/catbar.css">
    <title><?php echo $p["item_name"] ?></title>
</head>
<main>

    <body>
        <?php include '../components/navbar.php'; ?>
        <?php include '../components/categorybar.php'; ?>
        <section>
            <div class="container">
                <div class="d-flex flex-row align-items-center">
                    <!-- Product picture -->
                    <div class="col-6 prod-pic">
                        <div class="thumbnail">
                            <img src="<?php echo str_replace("normal", "full_screen", $p["image"]); ?>" class="img-responsive" alt="">
                        </div>
                    </div>
                    <!-- Product Description -->
                    <div class="col-sm-7">
                        <div>
                            <h4 class="prod-name"><?php echo $p["item_name"] ?></h4>
                            <div>
                                <h3 class="prod-price">MRP : <strike>₹<?php echo $p["item_price"] ?></strike> ₹<?php echo $p["item_offerprice"] ?></h3>
                                <div class="badge badge-success"><?php echo intval((($p[3]-$p[4])/$p[3])*100) ?>% OFF</div>
                                <br>
                                <br>
                                <h3 class="prod-price">Qty : 18</h3>
                            </div>
                            <div class="row avail">
                                <div class="col-sm-6">
                                    <strong>Available In</strong>
                                    <br>
                                    <button class="btn" style="color:#337ab7;border:1px dashed #337ab7;"><?php echo $p["item_qty"] ?></button>
                                </div>
                            </div>
                            <div class="buybuttons d-flex justify-content-left flex-column">
                                <button class="btn  col-sm-4 col-sm-offset-2 btn-lg" style="background-color:#36D03C; color:#fff;font-size:1em;"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;ADD TO BASKET</button>
                                <button class="btn col-sm-4 col-sm-offset-1 btn-lg" style="background-color:#2D5DD9; color:#fff;font-size:1em;"><i class="fa fa-bolt" style="font-size:1.2em;"></i> BUY NOW</button>
                            </div>
                        </div>
                        <br>
                    </div>

                </div>
                <div class="prod-desc" style="margin-top:50px;">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <h3>About The Product</h3>
                                <hr>
                                <p><?php echo $p["item_desc"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bootstrap, Popper and jQuery cdn -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>


    </body>

</main>
<?php include '../components/footer.php'; ?>

</html>