<?php
function categoryholder($f_id,$f_cat_id,$f_img, $f_name, $f_desc, $f_portion, $f_price)
{
    echo "<div class='col-sm-12 col-lg-6 p-2 text-white'>
                <div class='bg-success p-3 rounded shadow-lg' style='width: 100%;height: 100%;overflow: hidden'> 
                   
                        <img class='col-4 col-9-md float-start' style='object-fit: contain' src=$f_img>
                            <div class='col-6 float-end text-end'>
                                <h1 class='text-right'>$f_name</h1>
                                <p style='overflow:hidden;text-overflow: ellipsis;white-space:nowrap'>$f_desc</p>
                                <p>Portion : $f_portion</p>
                                <p>Price : $f_price</p>
                                
                                </div>
                                <button class='btn btn-dark float-end' style='width: 100%' onclick='selectedfood($f_cat_id,$f_id)'>Show</button>
                </div>
            </div>";
}

$category = $_GET['cat'];
$cat_sql = "SELECT * FROM foods RIGHT JOIN categories ON foods.category_id = categories.category_id WHERE foods.category_id = :category";
$cat_res = $db_pdo->prepare($cat_sql);
$cat_res->bindValue(':category', $category);
$cat_res->execute();
echo '<div class="container shadow-lg cf text-white my-5 p-3 rounded" id="container-holder">', "<div class='row'>";
foreach ($cat_res as $row) {
    $f_id = $row['food_id'];
    $f_name = $row['food_name'];
    $f_cat_id = $row['category_id'];
    $f_cat = $row['category_name'];
    $f_desc = $row['food_desc'];
    $f_portion = $row['portion'];
    $f_price = $row['price'];
    $f_img = $row['img'];
    categoryholder($f_id,$f_cat_id,$f_img, $f_name, $f_desc, $f_portion, $f_price);
}
?>
</div></div>
<div class="container mb-5">
    <div class="row justify-content-even">
        <button class='btn btn-primary' onclick=backToCat()>Back to Foods</button>
    </div>

</div>

