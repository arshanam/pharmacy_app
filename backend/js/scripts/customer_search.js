	//Customer search scripts
	function search_group(){
		var search_value = $('#group_code').val();
		$.ajax({
			type: "POST",
			url: "modules/customer/searchFunctions.inc.php",
			data: "f=search_group&"+"&group_code_value="+search_value,   
			success: function(html){
				$('.customers_res').html(html);
			}
 		});
 	}


 	function search_region(){
		var search_value = $('#region').val();
		$.ajax({
			type: "POST",
			url: "modules/customer/searchFunctions.inc.php",
			data: "f=search_region&"+"&region_value="+search_value,   
			success: function(html){
				$('.customers_res').html(html);
			}
 		});
 	}


 	function fetch_customers(){
 		var group_code=$("#group_code option:selected").val();
		var region=$("#region option:selected").val();
		var search_term = $('#search_term').val();
		
		$.ajax({
			type: "POST",
			url: "modules/customer/searchFunctions.inc.php",
			data: "f=fetch_customers&group_code="+group_code+"&region="+region+"&search_term="+search_term,   
			success: function(html){
				$('.customers_fetched').html(html);
			}
   	});
 	}