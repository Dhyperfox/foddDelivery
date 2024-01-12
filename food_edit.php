  <?php

require("db_config.php");


if(count($_POST)>0){
	if($_POST['type']==1){
		$name = $_POST['name'];
	 	$category_image =  $_POST['img'];

$category_id =  $_POST['category'];
$food_desc =  $_POST['desc'];
$portion =  $_POST['portion'];
$price =  $_POST['price'];

		try{
		$sql = "INSERT INTO `foods`( `food_name`, `category_id`, `food_desc`, `portion`, `price`, `img`) VALUES (:name,:category_id,:desc,:portion,:price,:image)";
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindParam(':name', $name);
			$stmt->bindParam(':category_id', $category_id);
			$stmt->bindParam(':desc', $food_desc);
			$stmt->bindParam(':portion', $portion);
			$stmt->bindParam(':price', $price);
		$stmt->bindParam(':image', $category_image);
			
		$stmt->execute();
		
			echo json_encode(array("statusCode"=>200));
		} 
		catch(Exception $e) {
			echo $e ;
		}
		
	}
}

if(count($_POST)>0){
	if($_POST['type']==2){
$id = $_POST['id'];
	$name = $_POST['name'];
	$food_image =  $_POST['img'];

$category_id =  $_POST['category'];
$food_desc =  $_POST['desc'];
$portion =  $_POST['portion'];
$price =  $_POST['price'];


try{
		$sql = "UPDATE `foods` SET `food_name`= :name,`category_id`= :category_id,`food_desc`=:desc,`portion`= :portion,`price`= :price,`img`= :image WHERE food_id = :id";
		$stmt = $db_pdo->prepare($sql);		
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':category_id', $category_id);
		$stmt->bindParam(':desc', $food_desc);
		$stmt->bindParam(':portion', $portion);
		$stmt->bindParam(':price', $price);
		$stmt->bindParam(':image', $food_image);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		
			echo json_encode(array("statusCode"=>200));
		} 
		catch(Exception $e) {
			echo $e ;
		}
	}
}


if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `foods` WHERE food_id= :id ";
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		echo $id;
	}
}


if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM foods WHERE  FIND_IN_SET(food_id, :id)"; // FIND_IN_SET(category_id, :id) PDO-ban nem mukodik az "in" SQL parancs!!!
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		echo $id;
	}
}


?>