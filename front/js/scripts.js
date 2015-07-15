
	//save category
	function save_category(){
		var category_title = j('.category_title').val();
		j.ajax({
			type: "POST",
			url: "actionController.php",
			data: "f=save_category&"+"&category_title="+category_title,   
			success: function(html){
				j('.category_res').html(html);				
				j.facebox.close();
			}
   	});
 	}


	//search box
	function get_search(){
		var search_value = j('.search_box').val();
		j.ajax({
			type: "POST",
			url: "actionController.php",
			data: "f=search_box&"+"&search_value="+search_value,   
			success: function(html){
				
			}
   		});
 	}


 	//save location
 	function save_location(){
		var city_title = j('.city_title').val();
		var location_title = j('.location_title').val();
		j.ajax({
			type: "POST",
			url: "actionController.php",
			data: "f=save_location&"+"&city_title="+city_title+"&location_title="+location_title,   
			success: function(html){
				get_locations();			
				j.facebox.close();
			}
   		});
 	}


 	//get locations based on the city (list customers)
 	function get_locations(){
 		var city = j('.city').val();
		j.ajax({
			type: "POST",
			url: "actionController.php",
			data: "f=get_locations&"+"&city="+city,   
			success: function(html){
				j('.location_res').html(html);
				load_customers();
			}
   	});

 	}



 	//load customers
 	function load_customers(){
		var location_selected=j(".location_selected option:selected").val();
		var city_selected=j(".city_selected option:selected").val();
		var category_selected=j(".category_selected option:selected").val();
		var spoke_customer=j(".spoke_customer option:selected").val();
		var calibrated=j(".calibrated option:selected").val();
		var climauto_customer=j(".climauto_customer option:selected").val();
		var page = j('.pager__').val();
		j.ajax({
			type: "POST",
			url: "actionController.php",
			data: "f=load_customers&location="+location_selected+"&city="+city_selected+"&page="+page+"&category="+category_selected+"&spoke_customer="+spoke_customer+"&climauto_customer="+climauto_customer+"&calibrated="+calibrated,   
			success: function(html){
				j('.customers_res').html(html);
			}
   	});
 	}


function update_customers(page){
	j(".pager__").val(page);
	load_customers();
}


function askForDelete(){
	return confirm ("Are you sure you want to delete this item?");
}


function autosuggest() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = j('#search-q').val();
	if (keyword.length >= min_length) {
		j.ajax({
			url: 'ajax_refresh.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				j('#results').show();
				j('#results').html(data);
			}
		});
	} else {
		j('#results').hide();
	}
}