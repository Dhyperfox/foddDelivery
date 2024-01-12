
<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 80%;
  border-collapse: collapse;

}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: center;}
</style>
</head>
<body>

<?php

require("db_config.php");
$q = "";
$q = $_GET['q'];
	

if($q == "1" ){
	$sql = "SELECT category_id, category_name FROM categories ";
	$stmt = $db_pdo->prepare($sql);		
		$stmt->execute();
		$data1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//generate table
		echo "<form method='post' action=".$_SERVER['REQUEST_URI']." ?>
<table class='table'>
<thead>
<tr>
    
	<th>Categor id</th>
	<th>Category name</th>
	<th><input type='checkbox' id='checkAl'>Összes</th>

</tr>
</thead>";

		write($data1,'category_id', 'category_name');
	
		echo "</table>" .'<br>' .'<div class="upname">
	<label for="new_name">New category name:</label>
	<input type="text" name="new_name"></div>
	<div class="image">
		<label for="image">Image location path:</label>
		<input type="text" name="image">
	</div>
</div><p align="center">
	<button type="submit"  name="delete">DELETE</button>
	<button type="submit"  name="new">NEW</button>
	<button type="submit"  name="update">UPDATE</button>
	<button type="submit"  name="limit">LIST</button>
</p>
</form>';
	
	//insert new category
if(isset($_POST['new'])){

		if(isset($_POST["new_name"]) and isset( $_POST["image"]) and $_POST["new_name"]!="" and $_POST["image"]!= "")
		{
	 		$name = $_POST["new_name"];
	 		$category_image =  $_POST["image"];
			
			$sql = "INSERT INTO categories (category_name,category_img)	VALUES ( :name, :image)";
		
		$stmt = $db_pdo->prepare($sql);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':image', $category_image);	
		$stmt->execute();
			
			header("location: admin.php");
		}
	else
		
		header("location: admin.php?");
		
}
	
	
}
	
	elseif($q == "2"){
			$sql = "SELECT food_id, food_name, food_desc FROM foods limit 10";
			$stmt = $db_pdo->prepare($sql);		
			$stmt->execute();
			$data1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			echo "<table>
			<tr>
			<th>ID</th>
			<th>Food name</th>
			<th>Food description</th>
			<th><input type='checkbox' id='checkAl'>Összes</th>
			</tr>";

			write($data1,'food_id', 'food_name','food_desc');
			echo "</table>";
}
	elseif($q == "3"){
			$sql = "SELECT order_id, user_id, email, date FROM orders limit 10";
			$stmt = $db_pdo->prepare($sql);		
			$stmt->execute();
			$data1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			echo "<table>
			<tr>
			<th>Order id</th>
			<th>User id</th>
			<th>email</th>
			<th>Date</th>
			<th><input type='checkbox' id='checkAl'>Összes</th>
			</tr>";

			write($data1,'order_id', 'user_id','email','date');
			echo "</table>";
}
	else
		echo("nono");

function write($data1,$column_name1,$column_name2, $column_name3=null, $column_name4=null){
	if(isset($column_name4)){
		$i =0;
		foreach($data1 as $data2 => $data2_value) {
			
			  echo "<tr>";
			  echo "<td>" . $data2_value[$column_name1] . "</td>";
			  echo "<td>" . $data2_value[$column_name2] . "</td>";
			  echo "<td>" . $data2_value[$column_name3] . "</td>";
			  echo "<td>" . $data2_value[$column_name4] . "</td>";
			  
			  echo"<td><input type='checkbox' id='checkItem' name='check[]'value=".$data2_value[$column_name1]." </td>";
			  echo "</tr>";
			$i++;
			}
	}
	elseif(isset($column_name3)){
		foreach($data1 as $data2 => $data2_value) {
			  echo "<tr>";
			  echo "<td>" . $data2_value[$column_name1] . "</td>";
			  echo "<td>" . $data2_value[$column_name2] . "</td>";
			  echo "<td>" . $data2_value[$column_name3] . "</td>";
			echo"<td><input type='checkbox' id='checkItem' name='check[]'value=".$data2_value[$column_name1]." </td>";
			  echo "</tr>";
			}
	}
	else{
		foreach($data1 as $data2 => $data2_value) {
			  echo "<tr>";
			  echo "<td>" . $data2_value[$column_name1] . "</td>";
			  echo "<td>" . $data2_value[$column_name2] . "</td>";
			echo"<td><input type='checkbox' id='checkItem' name='check[]' value=".$data2_value[$column_name1]." </td>";
			  echo "</tr>";
			}
	}
}
		
?>
</table>


</body>
</html>