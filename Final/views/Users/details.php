<?
require_once (__DIR__ . '/../../models/Users.php');
$row = Users::Get($_REQUEST['id']);
?>


				<dl>
					<dt>First Name:</dt>
					<dd><?=$row['FirstName']?></dd>
				</dl>
				<dl>
					<dt>First Name:</dt>
					<dd><?=$row['LastName']?></dd>
				</dl>
				<dl>
					<dt>Created At:</dt>
					<dd><?=$row['created_at']?></dd>
				</dl>
				<dl>
					<dt>Updated AT:</dt>
					<dd><?=$row['updated_at']?></dd>
				</dl>
				<dl>
					<dt>Keyword_id:</dt>
					<dd><?=$row['Keyword_id']?></dd>
				</dl>
							
			
