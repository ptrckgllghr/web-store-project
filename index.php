
<!DOCTYPE html PUBLIC>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Auto Complete Input box</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />



</head>
<body>
	
<label>Zip Code:</label>
<input name="tag" type="text" id="tag" size="20" align="center"/>

	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

<script>
 $(document).ready(function(){
  $("#tag").autocomplete({
  		source: "autocomplete.php"
  });
 });
 </script>

</body>
</html>