  <?php

require("db_config.php");


if(count($_POST)>0){
	if($_POST['type']==1){
		$name = $_POST["name"];
	 	$category_image =  $_POST["img"];
		
		try{
		$sql = "INSERT INTO categories (category_name,category_img)	VALUES ( :name, :image)";
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindParam(':name', $name);
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
		$id=$_POST['id'];
		$name = $_POST["name"];
	 	$category_image =  $_POST["img"];
try{
		$sql = "Update categories set category_name = :name ,category_img = :image where category_id = :id";
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':name', $name);
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
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `categories` WHERE category_id= :id ";
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		echo $id;
	}
}


if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM categories WHERE  FIND_IN_SET(category_id, :id)"; // FIND_IN_SET(category_id, :id) PDO-ban nem mukodik az "in" SQL parancs!!!
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		echo $id;
	}
}


?>