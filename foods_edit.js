
		 document.getElementById("container2").style.display = "block";
		 document.getElementById("container").style.display = "none";
		 document.getElementById("container3").style.display = "none";
		  
		  
		  	$(document).on('click','#btn-add_food',function(e) {
		var data = $("#food_user_form").serialize();
				
				
		$.ajax({
			data: data,
			type: "post",
			url: "food_edit.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#addEmployeeModal2').modal('hide');
						alert('Data added successfully !'); 
                        location.reload();						
					}
					else if(dataResult.statusCode==201){
					   alert(dataResult);
					}
			}
		});
	});


	$(document).on('click','.update',function(e) {
		var id=$(this).attr("data-id");
		var name=$(this).attr("data-name");
		var img=$(this).attr("data-img");
		var price = $(this).attr("data-price");
		
		var portion=$(this).attr("data-portion");
		var desc=$(this).attr("data-desc");
		var category_id=$(this).attr("data-category_id");
		
		console.log(id);
		console.log(name);
		console.log(img);
		console.log(price);
		console.log(desc);
		console.log(category_id);
		console.log(price);
		
		
		$('#food_id_u').val(id);
		$('#food_name_u').val(name);
		$('#food_img_u').val(img);
		$('#category_id_u').val(category_id);
		$('#food_desc_u').val(desc);
		$('#portion_u').val(portion);
		$('#price_u').val(price);
		
	});
	
	$(document).on('click','#update_food',function(e) {
		var data = $("#food_update_form").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "food_edit.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#editEmployeeModal2').modal('hide');
						alert('Data updated successfully !'); 
                        location.reload();						
					}
					else if(dataResult.statusCode==201){
					   alert(dataResult);
					}
			}
		});
	});


	$(document).on("click", ".delete", function() { 
		var id=$(this).attr("data-id");
		var q = 2;
		console.log(id);
		$('id_d').val(id);
		
		
		
	});
$(document).on("click", ".delete", function() { 
		var id=$(this).attr("data-id");
		$('#food_id_d').val(id);
		
	});
	$(document).on("click", "#delete_food", function() { 
		$.ajax({
			url: "food_edit.php",
			type: "POST",
			cache: false,
			data:{
				type:3,
				id: $("#food_id_d").val()
			},
			success: function(dataResult){
					$('#deleteEmployeeModal2').modal('hide');
					$(dataResult).remove();
					location.reload();
			
			}
		});
	});
	$(document).on("click", "#delete_multiple2", function() {
		var user = [];
		var q = 2;
		$(".user_checkbox:checked").each(function() {
			user.push($(this).data('user-id'));
		});
		if(user.length <=0) {
			alert("Please select records."); 
		} 
		else { 
			WRN_PROFILE_DELETE = "Are you sure you want to delete "+(user.length>1?"these":"this")+" row?";
			var checked = confirm(WRN_PROFILE_DELETE);
			if(checked == true) {
				var selected_values = user.join(",");
				console.log(selected_values);
				$.ajax({
					type: "POST",
					url: "food_edit.php",
					cache:false,
					data:{
						type: 4,						
						id : selected_values
					},
					success: function(response) {
						var ids = response.split(",");
						for (var i=0; i < ids.length; i++ ) {	
							$(ids[i]).remove(); 
							location.reload();
						}	
					} 
				}); 
			}  
		} 
	});
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
		var checkbox = $('table tbody input[type="checkbox"]');
		var q = 2;
		$("#selectAll").click(function(){
			if(this.checked){
				checkbox.each(function(){
					this.checked = true;                        
				});
			} else{
				checkbox.each(function(){
					this.checked = false;                        
				});
			} 
		});
		checkbox.click(function(){
			if(!this.checked){
				$("#selectAll").prop("checked", false);
			}
		});
	});
		  
	  