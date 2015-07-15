 	function fetch_products(){
 		var category=$("#category option:selected").val();
		var supplier=$("#supplier option:selected").val();
		var search_term = $('#search_term').val();
		var status = $('#status').val();
		var page = $('.pager__').val();		
		$.ajax({
			type: "POST",
			url: "modules/product/searchFunctions.inc.php",
			data: "f=fetch_products&search_term="+search_term+"&page="+page+"&supplier="+supplier+"&category="+category+"&status="+status,  
			success: function(html){
				$('.products_fetched').html(html);
			}
   	});
 	}

function update_products(page){
	$(".pager__").val(page);
	fetch_products();
}