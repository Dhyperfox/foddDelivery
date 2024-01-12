<?php
$cat = "SELECT * FROM categories";
$rescat = $db_pdo->prepare($cat);
$rescat->execute();
?>
<div class="container shadow-lg cf text-white my-5 p-4" id="container-holder">
    <div class="row justify-content-even categorise bg-dark p-3 rounded">
        <h1 class="text-white">Categories</h1><br>
        <?php
        foreach ($rescat as $res_element) {
            $cat_id = $res_element['category_id'];
            $cat_name = $res_element['category_name'];
            $cat_img = $res_element['category_img'];
            echo("
            <div class='col-sm-4 col-lg-2 col-6' id='cat$cat_name'>
                <div > 
                    <img class='img-fluid rounded-circle category-holder shadow' onclick=\"loadfood('$cat_id')\"  src=$cat_img width='100%'>
                    <p class='text-center h1'>$cat_name
                    </p>
                </div>
            </div>
            ");
        }
        ?>
    </div>
</div>
