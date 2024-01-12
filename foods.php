<?php
$page_title = "Foods";
require("head.php");
require("db_config.php");
echo "<link rel='stylesheet' href='assets/css/cleanplate.foods.css' type='text/css'>
<script src='assets/js/cleanplate.loadfoods.js'></script>";

if (isset($_GET['cat'])==true and isset($_GET['fid'])==true) {
    include("selected.php");
}
if (isset($_GET['cat'])){
    if(!isset($_GET['fid'])){
        include("foodselection.php");
    }


}
if (isset($_GET['cat'])==false and (isset($GET_['fid'])==false)){
    include("categories.php");
}
require("footer.php");
?>
