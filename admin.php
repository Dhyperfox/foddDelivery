<?php

include 'db_config.php';
	
	session_start();
	//WE WILL CHECK IF THE USER HAS PERMISSIONS
	#if(!isset($_SESSION['user']) || !check("USR", 4) ){
		//header("location: index.php");
	#	die("NO PERMISSION TO ACCESS!");
	#}
	
	//PERMISSIONS CHECK FUNCTION
	function check ($module, $id) {
  return in_array($id, $_SESSION['user']['permissions'][$module]);
}
	

	
	
echo "Hello"." ". $_SESSION['user']['username'];	
	

function write($column_name1,$column_name2, $column_name3=null, $column_name4=null,$column_name5=null,$column_name6=null,$column_name7=null){
	
	
	 if(isset($column_name7)){
		 echo "<tr>";
			  echo "<td>" .$column_name1 . "</td>";
			  echo "<td>" .$column_name2. "</td>";
			  echo "<td>" .$column_name3. "</td>";
			  echo "<td>" .$column_name4. "</td>";
			  echo "<td>" .$column_name5. "</td>";
		 	  echo "<td>" .$column_name6. "</td>";
		 	  echo "<td>" .$column_name7. "</td>";
			  echo "<td>Action</td>";		
			  echo "</tr>";
	}
	else if(isset($column_name6)){
		 echo "<tr>";
			  echo "<td>" .$column_name1 . "</td>";
			  echo "<td>" .$column_name2. "</td>";
			  echo "<td>" .$column_name3. "</td>";
			  echo "<td>" .$column_name4. "</td>";
			  echo "<td>" .$column_name5. "</td>";
			  echo "<td>" .$column_name6. "</td>";
			  echo "<td>Action</td>";		
			  echo "</tr>";
	}
	else if(isset($column_name5)){
		 echo "<tr>";
			  echo "<td>" .$column_name1 . "</td>";
			  echo "<td>" .$column_name2. "</td>";
			  echo "<td>" .$column_name3. "</td>";
			  echo "<td>" .$column_name4. "</td>";
			  echo "<td>" .$column_name5. "</td>";
			  echo "<td>Action</td>";		
			  echo "</tr>";
	}
	else if(isset($column_name4)){
		 echo "<tr>";
			  echo "<td>" .$column_name1 . "</td>";
			  echo "<td>" .$column_name2. "</td>";
			  echo "<td>" .$column_name3. "</td>";
			  echo "<td>" .$column_name4. "</td>";
			  echo "<td>Action</td>";		
			  echo "</tr>";
	}
	elseif(isset($column_name3)){
		
			  echo "<tr>";
		
			  echo "<td>" .$column_name1 . "</td>";
			  echo "<td>" .$column_name2. "</td>";
			  echo "<td>" .$column_name3. "</td>";
			  echo "<td>Action</td>";		
			  echo "</tr>";
			
	}
	else{
		
			  echo "<tr>";
			  echo '<td class="custom-checkbox">
			  			<input type="checkbox" id="selectAll">
			  	<label for="selectAll"></label> All</td>';
			  echo "<td>" .$column_name1 . "</td>";
			  echo "<td>" .$column_name2. "</td>";
			  echo "<td>Action</td>";
			  echo "</tr>";
			
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<style>
	
		#container, #container2,#container3{
			display: none;
		}
	</style>
	
</head>
<body>
   
   <form>
<select id="sel" name="data" onchange="showData(this.value)">
  <option value="">Select an option:</option>
  <option value="1">Category</option>
  <option value="2">Foods</option>
  <option value="3">Orders</option>
  <option value="4">Courirs</option>
  </select>
</form>
<br>
<div id="txtHint"><b>Data will be listed here...</b></div>
<div class="message"><?php if(isset($message)) { echo $message; } ?>
</div>  
    
        <div id="container" class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Categories</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add NewCategory</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a>	
						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <th><?php 
					$sql = "SELECT * FROM categories ";
					$stmt = $db_pdo->prepare($sql);		
					$stmt->execute();
					$data1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
					write('Category', 'Name');					
					

					
					?>					
						</th>
						
                </thead>
				<tbody>
				
				<?php
				
				foreach($data1 as $data2 => $data2_value) {
				?>
				<tr id="<?php  echo $data2_value["category_id"]; ?>">
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $data2_value["category_id"]; ?>">
								<label for="checkbox2"><?php echo $data2_value["category_id"]; ?></label>
							</span>
						</td>
					
					<td><?php echo $data2_value["category_name"]; ?></td>
					<td><?php echo $data2_value["category_img"]; ?></td>
					<td>
						<a href="#editEmployeeModal" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $data2_value["category_id"]; ?>"
							data-name="<?php echo $data2_value["category_name"]; ?>"
							title="Edit"></i>
						</a>
						<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $data2_value["category_id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete"></i></a>
                    </td>
				</tr>
				<?php				
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>  
    
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add Categories</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>NAME</label>
							<input type="text" id="name" name="name" class="form-control" required>

						<div class="form-group">
							<label>Image</label>
							<input type="text" id="img" name="img" class="form-control" required>
						</div>	
						
							
										
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>	
	
	<!-- Edit Modal HTML -->
	  <div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Categories</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name_u" name="name" class="form-control" required>
						
						<div class="form-group">
							<label>Image</label>
							<input type="text" id="img_u" name="img" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	 <div id="container2" class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Foods</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal2" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New Food</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple2"><i class="material-icons"></i> <span>Delete</span></a>	
						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <th><?php 
						$sql = "SELECT * FROM foods ";
						$stmt = $db_pdo->prepare($sql);		
						$stmt->execute();
						$data1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
						write('Name', 'Image path');				
					?>					
						</th>
						
                </thead>
				<tbody>
				
				<?php
				
				foreach($data1 as $data2 => $data2_value) {
				?>
				<tr id="<?php  echo $data2_value["food_id"]; ?>">
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $data2_value["food_id"]; ?>">
								<label for="checkbox2"><?php echo $data2_value["food_id"]; ?></label>
							</span>
						</td>
					
					<td><?php echo $data2_value["food_name"]; ?></td>
					<td><?php echo $data2_value["img"]; ?></td>
					<td>
						<a href="#editEmployeeModal2" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $data2_value["food_id"]; ?>"
							data-name="<?php echo $data2_value["food_name"]; ?>"
							data-img="<?php echo $data2_value["img"]; ?>"
							data-category_id="<?php echo $data2_value["category_id"]; ?>"
							data-desc="<?php echo $data2_value["food_desc"]; ?>"
							data-portion="<?php echo $data2_value["portion"]; ?>"
							data-price="<?php echo $data2_value["price"]; ?>"
							title="Edit"></i>
						</a>
						<a href="#deleteEmployeeModal2" class="delete" data-id="<?php echo $data2_value["food_id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete"></i></a>
                    </td>
				</tr>
				<?php				
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>
    
     	<!-- Add Modal HTML -->
	<div id="addEmployeeModal2" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="food_user_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add foods</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="food_name" name="name" class="form-control" required>

						<div class="form-group">
							<label>Image</label>
							<input type="text" id="food_img" name="img" class="form-control" required>
						</div>
										
														
						<div class="form-group">
							<label>Category ID</label>
							<input type="text" id="category_id" name="category" class="form-control" required>
						</div>													
																						
						<div class="form-group">
							<label>Description</label>
							<input type="text" id="food_desc" name="desc" class="form-control" required>
						</div>																					
							
						<div class="form-group">
							<label>Portion</label>
							<input type="text" id="portion" name="portion" class="form-control" required>
						</div>
										
						<div class="form-group">
							<label>Price</label>
							<input type="text" id="price" name="price" class="form-control" required>
						</div>			
											
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add_food">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>	
	
	
	<!-- Edit Modal HTML -->
	  <div id="editEmployeeModal2" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="food_update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Foods</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="food_id_u" name="id" class="form-control" required>					
								<div class="form-group">
							<label>Name</label>
							<input type="text" id="food_name_u" name="name" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Image</label>
							<input type="text" id="food_img_u" name="img" class="form-control" required>
						</div>
										
														
						<div class="form-group">
							<label>Category ID</label>
							<input type="text" id="category_id_u" name="category" class="form-control" required>
						</div>													
																						
						<div class="form-group">
							<label>Description</label>
							<input type="text" id="food_desc_u" name="desc" class="form-control" required>
						</div>																					
							
						<div class="form-group">
							<label>Portion</label>
							<input type="text" id="portion_u" name="portion" class="form-control" required>
						</div>
										
						<div class="form-group">
							<label>Price</label>
							<input type="text" id="price_u" name="price" class="form-control" required>
						</div>			
											
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update_food">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal2" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="food_id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete_food">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div> 
	
	
	
	
	 <div id="container3" class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Orders</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addOrder" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add Order</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_Order_multiple"><i class="material-icons"></i> <span>Delete</span></a>	
						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <th><?php 
						$sql = "SELECT * FROM orders ";
						$stmt = $db_pdo->prepare($sql);		
						$stmt->execute();
						$data1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
						write('	order_id','	user_id',	'address','	city',	'price','date',	'email');				
					?>					
						</th>
						
                </thead>
				<tbody>
				
				<?php
				
				foreach($data1 as $data2 => $data2_value) {
				?>
				<tr id="<?php  echo $data2_value["order_id"]; ?>">
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $data2_value["order_id"]; ?>">
								<label for="checkbox2"><?php echo $data2_value["order_id"]; ?></label>
							</span>
						</td>
					
					<td><?php echo $data2_value["user_id"]; ?></td>
					<td><?php echo $data2_value["address"]; ?></td>
					<td><?php echo $data2_value["city"]; ?></td>
					<td><?php echo $data2_value["price"]; ?></td>
					<td><?php echo $data2_value["date"]; ?></td>
					<td><?php echo $data2_value["email"]; ?></td>

					<td>
						<a href="#editOrder" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $data2_value["order_id"]; ?>"
							data-user_id="<?php echo $data2_value["user_id"]; ?>"
							data-address="<?php echo $data2_value["address"]; ?>"
							data-city="<?php echo $data2_value["city"]; ?>"
							data-price="<?php echo $data2_value["price"]; ?>"
							data-date="<?php echo $data2_value["date"]; ?>"
							data-email="<?php echo $data2_value["email"]; ?>"
							title="Edit"></i>
						</a>
						<a href="#deleteOrder" class="delete" data-id="<?php echo $data2_value["order_id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete"></i></a>
                    </td>
				</tr>
				<?php				
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>
    
     	<!-- Add Modal HTML -->
	<div id="addOrder" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="order_user_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add Order</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>User Identification</label>
							<input type="text" id="user_id" name="usr_id" class="form-control" required>

						<div class="form-group">
							<label>Address</label>
							<input type="text" id="address" name="address" class="form-control" required>
						</div>
										
														
						<div class="form-group">
							<label>City</label>
							<input type="text" id="city" name="city" class="form-control" required>
						</div>													
																						
						<div class="form-group">
							<label>Price</label>
							<input type="text" id="price2" name="price" class="form-control" required>
						</div>																					
							
						<div class="form-group">
							<label>Date</label>
							<input type="text" id="date" name="date" class="form-control" required>
						</div>
										
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="email" name="email" class="form-control" required>
						</div>			
											
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add_order">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>	
	
	
	<!-- Edit Modal HTML -->
	  <div id="editOrder" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="order_update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Order</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="order_id_u" name="id" class="form-control" required>					
								<div class="form-group">
							<label>User Id</label>
							<input type="text" id="usr_id_name_u" name="usr_id_name_u" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Address</label>
							<input type="text" id="address_u" name="address_u" class="form-control" required>
						</div>
										
														
						<div class="form-group">
							<label>City</label>
							<input type="text" id="city_u" name="city_u" class="form-control" required>
						</div>													
																						
						<div class="form-group">
							<label>Price</label>
							<input type="text" id="price2_u" name="price2_u" class="form-control" required>
						</div>																					
							
						<div class="form-group">
							<label>Date</label>
							<input type="text" id="date_u" name="date_u" class="form-control" required>
						</div>
										
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="email_u" name="email_u" class="form-control" required>
						</div>			
											
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update_order">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteOrder" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete Order</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="order_id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete_order">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div> 
	
	
	
</body>
	<script src="ajax.js"></script>

</html>    