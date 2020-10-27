<?php
require_once "./services/connect_db.php"
?>
<style>
    <?php include './css/deals.css'; ?>
</style>
<div class="container-fluid">
    <h3 class="mt-5 dod-title">Deals Of The Week</h3>
    <div class="row row-no-gutters">
        <?php
        $sql = "SELECT item_id, item_name, item_price, item_offerprice, image FROM tbl_item WHERE featured = TRUE";
        $result = $connect->query($sql);
        while ($row = $result->fetch_array()) {
            echo '<div class="col-md-3 py-2">
            <figure class="card card-product">
                <div class="img-wrap">
                    <img src="' . $row[4] . '">
                </div>
                <figcaption class="info-wrap">
                    <h6 class="title">' . $row[1] . '
                        <span class="badge badge-success">' . intval((($row[2] - $row[3]) / $row[2]) * 100) . '%</span>
                    </h6>
                    <div class="action-wrap">
                        <button class="btn btn-success order-btn float-right" onclick="pageRedirect(' . $row["0"] . ')" >Order</button>
                        <div class=" h5 float-left">
                            <span class="price-new">₹' . $row[3] . '</span>
                            <del class="price-old">₹' . $row[2] . '</del>
                        </div> <!-- price-wrap.// -->
                    </div> <!-- action-wrap -->
                </figcaption>
            </figure>
         </div>';
        }
        ?>
    </div>
</div>
<script>
    function pageRedirect(url) {
        window.location = 'views/products.php?id=' + url;
    }
</script>