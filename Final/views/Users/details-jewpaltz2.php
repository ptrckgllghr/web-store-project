<?
require_once (__DIR__ . '/../../models/Users.php');
$row = Users::Get($_REQUEST['id']);
?>

			<div class="dl-horizontal">
				<dl>
					<dt>First Name:</dt>
					<dd><?=$row['FirstName']?></dd>
				</dl>
				<dl>
					<dt>First Name:</dt>
					<dd><?=$row['LastName']?></dd>
				</dl>
				<dl>
					<dt>First Name:</dt>
					<dd><?=$row['created_at']?></dd>
				</dl>
				<dl>
					<dt>First Name:</dt>
					<dd><?=$row['updated_at']?></dd>
				</dl>
				<dl>
					<dt>Keyword_id:</dt>
					<dd><?=$row['Keyword_id']?></dd>
				</dl>
			</div>				
			
