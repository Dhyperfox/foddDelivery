  <?php

require("db_config.php");


if(count($_POST)>0){
	if($_POST['type']==1){
		$user_id = $_POST['usr_id'];
	 	$address =  $_POST['address'];

$city =  $_POST['city'];
$price =  $_POST['price'];
$date =  $_POST['date'];
$email =  $_POST['email'];
		
		try{
		$sql = "INSERT INTO `orders`(`user_id`, `address`, `city`, `price`, `date`, `email`) VALUES (:user_id,:address,:city,:price,:date,:email)";
		$stmt = $db_pdo->prepare($sql);
			$stmt->bindParam(':user_id', $user_id,PDO::PARAM_INT);
			$stmt->bindParam(':address', $address,PDO::PARAM_STR);
			$stmt->bindParam(':city', $city,PDO::PARAM_STR );
			$stmt->bindParam(':price',$price, PDO::PARAM_INT);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':email', $email);
			
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
		$user_id = $_POST['usr_id_name_u'];
	 	$address =  $_POST['address_u'];

$city =  $_POST['city_u'];
$price =  $_POST['price2_u'];
$date =  $_POST['date_u'];
$email =  $_POST['email_u'];


try{
		$sql = "UPDATE `orders` SET `user_id`= :user_id,`address`= :address,`city`=:city,`price`= :price,`date`= :date,`email`= :email WHERE order_id = :id";
		$stmt = $db_pdo->prepare($sql);		
		$stmt->bindParam(':user_id', $user_id);
		$stmt->bindParam(':address', $address);
		$stmt->bindParam(':city', $city);
		$stmt->bindParam(':price', $price);
		$stmt->bindParam(':date', $date);
		$stmt->bindParam(':email', $email);
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
		$sql = "DELETE FROM `orders` WHERE order_id= :id ";
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		echo $id;
	}
}


if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM orders WHERE  FIND_IN_SET(order_id, :id)"; // FIND_IN_SET(category_id, :id) PDO-ban nem mukodik az "in" SQL parancs!!!
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		echo $id;
	}
}


?>