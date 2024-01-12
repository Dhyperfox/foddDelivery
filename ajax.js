
function showData(str) {
	console.log(str);
  if (str == "") {
      document.getElementById("txtHint").innerHTML = "";
	  document.getElementById("container").style.display = "none";
	  document.getElementById("container2").style.display = "none";
	  document.getElementById("container3").style.display = "none";
	  document.getElementById("container4").style.display = "none";
    return;
  }
	else if(str == "1"){
			$.getScript('category_edit.js');
		return;  
	}	
	else if(str == "2"){
		$.getScript('foods_edit.js');
		return;
	}
	else if(str == "3"){
		$.getScript('orders_edit.js');
		return;
	}
	else{
		$.getScript('couriers_edit.js');
		return;
	}

}



