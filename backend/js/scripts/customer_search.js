	//Customer search scripts

 	function fetch_customers(){
 		var group_code=$("#group_code option:selected").val();
		var region=$("#region option:selected").val();
		var search_term = $('#search_term').val();
		var page = $('.pager__').val();		
		$.ajax({
			type: "POST",
			url: "modules/customer/searchFunctions.inc.php",
			data: "f=fetch_customers&group_code="+group_code+"&region="+region+"&search_term="+search_term+"&page="+page,   
			success: function(html){
				$('.customers_fetched').html(html);
			}
   	});
 	}


function update_customers(page){
	$(".pager__").val(page);
	fetch_customers();
}