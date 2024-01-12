<?php
function foodholder($f_id,$f_cat_id,$f_img, $f_name, $f_desc, $f_portion, $f_price)
{
    echo "<div class='p-2 text-dark'>
                <div class='bg-white p-3 rounded-top shadow' style='width: 100%;height: 100%;overflow: hidden'> 
                        <img class='col-lg-6 col-sm-12 col-12 p-sm-5' style='object-fit: contain' src=$f_img>
                            <div class='col-sm-12 col-lg-6 float-end text-start p-3 shadow rounded' style='min-height: 300px'>
                                <h1 class='text-right'>$f_name</h1>
                                <div class='alert alert-warning'>
                                  <b>Description</b><br>
                                  <p class=''>$f_desc</p>
                                </div>
                                
                                <p class='alert alert-success'>Portion : <b>$f_portion</b></p>
                                <p class='alert alert-primary'>Price/Qn. : <b>$f_price</b></p>
                               
                                <form action='cart.php' method='post'>
                                <div class='d-flex alert alert-info'>
                                    <label for='quantity'>Quantity : &nbsp;</label>
                                    <input class='form-control float p-0' id='quantity' style='width:fit-content' type='number' name='quantity' value='1' min='1' max='5' required>
                                </div>
                                    <input type='hidden' name='product_id' id='product_id' value='$f_id'><br>
                                    <div class='row p-2'>
                                        <input class='btn btn-dark' width='100%' type='submit' value='Add To Cart'>
                                    </div>
                                    
                                </form> 
                </div>
        </div>";
}
function commentholder($uname,$s,$d,$rd,$es){
    echo '<div class="media text-muted pt-3">
          <p class="media-body bg-white rounded shadow p-3 mb-0 small lh-125 border-bottom border-gray">  
            <strong class="d-block text-gray-dark">',$uname,'</strong>
            <i class="text-primary">Date : '.$d.'</i><br>';
    for($i=0;$i<$s;$i++){
        echo '<i class="bi bi-star-fill"></i>';
        $es-=1;
    }
    for($i=0;$i<$es;$i++){
        echo '<i class="bi bi-star"></i>';
    }
    echo '<br>'. $rd.' </p>
        </div>';

}
if (!isset($_GET['fid'])){
    header('location:index.php?n=6');
}
$foodid = $_GET['fid'];
$cat = $_GET['cat'];
$food_sql = "SELECT * FROM foods RIGHT JOIN categories ON foods.category_id = categories.category_id WHERE foods.food_id = :fid";
$food_res = $db_pdo->prepare($food_sql);
$food_res->bindValue(':fid', $foodid);
$food_res->execute();
echo '<div class="container shadow-lg cf text-white my-5 p-3 rounded" id="container-holder">';
foreach ($food_res as $row) {
    $f_id = $row['food_id'];
    $f_name = $row['food_name'];
    $f_cat_id = $row['category_id'];
    $f_cat = $row['category_name'];
    $f_desc = $row['food_desc'];
    $f_portion = $row['portion'];
    $f_price = $row['price'];
    $f_img = $row['img'];
    foodholder($f_id,$f_cat_id,$f_img, $f_name, $f_desc, $f_portion, $f_price);
    $page_title = $f_name;
}
$rating_sql = "SELECT users.username,rating.stars,rating.r_date,rating.rating_desc FROM rating RIGHT JOIN users ON rating.user_id = users.user_id WHERE food_id=:fid ORDER BY r_date DESC ";
$rating_res = $db_pdo->prepare($rating_sql);
$rating_res->bindValue(':fid', $foodid);
$rating_res->execute();
echo "<div class='col-12 p-3 rounded-bottom bg-white'><h2>Comments</h2>";
if (!$rating_res->rowCount() > 0) {
  echo '<div class="media text-muted pt-3">
          <p class="media-body bg-white rounded shadow p-3 mb-0 small lh-125 border-bottom border-gray"> 
            <strong class="d-block text-gray-dark">There\'s no comments yet!</strong>
            Be the first who tries this one!
          </p>
        </div>';
}

foreach ($rating_res as $row) {
    $username = $row['username'];
    $star = $row['stars'];
    $emptystars = 5;
    $date = $row['r_date'];
    $rtext = $row['rating_desc'];
    commentholder($username,$star,$date,$rtext,$emptystars);

}

?>
</div></div></div></div></div>
<div class="container mb-5">
    <div class="row justify-content-even">
       <?php echo " <button class='btn btn-primary' onclick=loadfood($cat)>Back to Category</button>";?>
    </div>
</div>
