
<link href="css/jquery.dataTables_themeroller.css" rel="stylesheet">
<!-- Gritter -->
<link href="css/gritter/jquery.gritter.css" rel="stylesheet">

<!-- Google Code Prettify -->
<link href="css/prettify.css" rel="stylesheet">

<!-- Gritter -->
<script src="js/jquery.gritter.min.js"></script>

<!-- Google Code Prettify -->
<script src='js/uncompressed/run_prettify.js'></script>


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
	