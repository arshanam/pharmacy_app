 	function fetch_users(){
 		var search_term = $('#search_term').val();
		var page = $('.pager__').val();		
		$.ajax({
			type: "POST",
			url: "modules/user/searchFunctions.inc.php",
			data: "f=fetch_users&search_term="+search_term+"&page="+page,
			success: function(html){
				$('.users_fetched').html(html);
			}
   	});
 	}

function update_products(page){
	$(".pager__").val(page);
	fetch_users();
}