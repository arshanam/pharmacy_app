 	function fetch_logs(){
 		var search_term = $('#search_term').val();
		var page = $('.pager__').val();		
		var user = $('#user').val();
		$.ajax({
			type: "POST",
			url: "modules/log/searchFunctions.inc.php",
			data: "f=fetch_logs&search_term="+search_term+"&page="+page+"&user="+user,  
			success: function(html){
				$('.logs_fetched').html(html);
			}
   	});
 	}

function update_logs(page){
	$(".pager__").val(page);
	fetch_logs();
}