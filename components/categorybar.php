<?php
require_once(realpath(dirname(__FILE__)."/../services/connect_db.php"));
?>
<style>
    <?php include './css/catbar.css'; ?>
</style>
<div class="cat-bar">
    <div class="cat">

        <div class="row justify-content-center">
            <?php
            $sql = "SELECT * from tbl_category";
            $result = $connect->query($sql);
            while ($row = $result->fetch_array()) {
                echo "<a href='views/category.php?id=". $row[0]."'><div class='col-md-0 cat-col-single'><div class='col'>" . "<img class='cat-image' src='" . $row[3] . "'>" . "<p class='cat-name-head'>" . $row[1] . "</p>" . "</div></div></a>";
            }
            ?>
        </div>
    </div>
</div>