
		 document.getElementById("container2").style.display = "none";
		 document.getElementById("container").style.display = "none";
		 document.getElementById("container3").style.display = "block";
		  
		  
		  	$(document).on('click','#btn-add_order',function(e) {
		var data = $("#order_user_form").serialize();
				
				
		$.ajax({
			data: data,
			type: "post",
			url: "order_edit.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#addOrder').modal('hide');
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
		var usr_id=$(this).attr("data-user_id");
		var address=$(this).attr("data-address");
		var price = $(this).attr("data-price");
		
		var city=$(this).attr("data-city");
		var date=$(this).attr("data-date");
		var email=$(this).attr("data-email");
		
		
		
		
		$('#order_id_u').val(id);
		$('#usr_id_name_u').val(usr_id);
		$('#address_u').val(address);
		$('#city_u').val(city);
		$('#price2_u').val(price);
		$('#date_u').val(date);
		$('#email_u').val(email);
		
	});
	
	$(document).on('click','#update_order',function(e) {
		var data = $("#order_update_form").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "order_edit.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#editOrder').modal('hide');
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
		//var q = 2;
		console.log(id);
		$('id_d').val(id);
		
		
		
	});
$(document).on("click", ".delete", function() { 
		var id=$(this).attr("data-id");
		$('#order_id_d').val(id);
		
	});
	$(document).on("click", "#delete_order", function() { 
		$.ajax({
			url: "order_edit.php",
			type: "POST",
			cache: false,
			data:{
				type:3,
				id: $("#order_id_d").val()
			},
			success: function(dataResult){
					$('#deleteOrder').modal('hide');
					$(dataResult).remove();
					location.reload();
			
			}
		});
	});
	$(document).on("click", "#delete_Order_multiple", function() {
		var user = [];
		
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
					url: "order_edit.php",
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
		  
	  