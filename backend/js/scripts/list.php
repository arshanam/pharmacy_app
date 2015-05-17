
<link href="css/jquery.dataTables_themeroller.css" rel="stylesheet">

<script src='js/jquery.dataTables.min.js'></script>	

<script>
	
	$(function	()	{
		$('#dataTable').dataTable( {
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		$('#chk-all').click(function()	{
			if($(this).is(':checked'))	{
				$('#responsiveTable').find('.chk-row').each(function()	{
					$(this).prop('checked', true);
					$(this).parent().parent().parent().addClass('selected');
				});
			}
			else	{
				$('#responsiveTable').find('.chk-row').each(function()	{
					$(this).prop('checked' , false);
					$(this).parent().parent().parent().removeClass('selected');
				});
			}
		});
	});
</script>
	