<?php
require_once(realpath(dirname(__FILE__) . "/../services/connect_db.php"));
$scatName;
$catName;
$subCats;
$products;
if (isset($_GET["id"])) {

    //fetch scat name from tbl_subcat
    $select = "SELECT scat_name, cat_id FROM tbl_subcategory WHERE scat_id=" . $_GET["id"];
    if ($result = $connect->query($select)) {
        $scatName = $result->fetch_array();
    } else {
        echo $connect->error;
    }

    $selectCatName = "SELECT cat_name FROM tbl_category WHERE cat_id=" . $scatName[1];
    if ($result = $connect->query($selectCatName)) {
        $catName = $result->fetch_array();
    } else {
        echo $connect->error;
    }


    //fetch all subcat
    $fetchSubcat = "select * from tbl_subcategory where cat_id=" . $scatName[1];
    if ($subcatRes = $connect->query($fetchSubcat)) {
        $subCats = $subcatRes->fetch_all();
    } else {
        echo $connect->error;
    }

    //fetch all products from subcat
    $fetchProducts = "select * from tbl_item where scat_id=" . $_GET["id"];
    if ($prodRes = $connect->query($fetchProducts)) {
        $products = $prodRes->fetch_all();
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
    <link rel="stylesheet" href="../css/category.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/catbar.css">
    <title><?php echo $catName[0] ?></title>
</head>
<main>

    <body>
        <?php include '../components/navbar.php'; ?>
        <div class="container top-header">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/miniproject">Home</a></li>
                            <li class="breadcrumb-item"><a href="category.php?id=<?php echo $scatName[1] ?>"><?php echo $catName[0] ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $scatName[0] ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-3">
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Sub Categories</div>
                        <ul class="list-group category_block">
                            <?php
                            for ($i = 0; $i < count($subCats); $i++) {
                                echo '<li class="list-group-item"><a href="subcategory.php?id=' . $subCats[$i][0] . '">' . $subCats[$i][2] . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <?php
                        for ($i = 0; $i < count($products); $i++) {
                            echo '
                            <a href="products.php?id=' . $products[$i][0] . '">
                                <div class="prod-card equal col-12 col-md-6 col-lg-4">
                                    <div class="card card-block d-flex" style="height: 100%">
                                        <img class="card-img-top" src="' . $products[$i][8] . '" alt="Card image cap">
                                            <div class="card-body" >
                                                <h4 class="card-title"><a href="products.php?id=' . $products[$i][0] . '" title="View Product">' . $products[$i][1] . '</a></h4>
                                                <p class="qty">' . $products[$i][2] . '</p>
                                                <p class="price">₹' . $products[$i][4] . '</p>
                                                <a href="#" class="btn btn-success btn-block atc mx-auto">Add to cart</a>
                                            </div>
                                    </div>
                                </div>
                        </a>';
                        }
                        ?>
                    </div>
                </div>
                <!-- <div class="col-12">
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div> -->
            </div>
        </div>

        </div>
        </div>

    </body>
</main>
<?php include '../components/footer.php'; ?>

</html>