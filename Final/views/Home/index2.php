	<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
	
	
	<table></table>
	<div id="chart"></div>
	<script type="text/javascript">
		$(function(){
			$('table').dataTable( {
		        "bProcessing": true,
		        "sAjaxSource": "<?=$rootUrl?>/../A/Products",
		        "aoColumns": [
		            { "mData": "Name" },
		            { "mData": "Price" },
		            { "mData": "Quantity" }
		        ]
		    } );
		})
	</script>