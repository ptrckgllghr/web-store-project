<?
require_once (__DIR__ . '/../../models/Accounts.php');
require_once (__DIR__ . '/../../models/Users.php');
require_once (__DIR__ . '/../../models/Keywords.php');
RequireLogin();

if(isset($_POST['id']))
{
	$row = $_POST;
	$response = Users::Validate($row);
	
	if($response === true)
		if($row['id']==null)
			$response = Users::Insert($row);		
		else
			$response = Users::Update($row);
	
	if($response === true && !isset($_REQUEST['ajax']))
		header("Location: " . $rootUrl . "/../W/Users/?inserted=$row[id]");
}
else
{
	if(!empty($_GET['id']))
		$row = Users::Get($_REQUEST['id']);
	else
		$row = Users::Blank();
}
	$keywords = Keywords::GetAll();
	if(isset($_REQUEST['ajax']))
	{
		echo json_encode(array(
			'contents' => $row,
			'status' => $response === true ? 'success' : 'failed',
			'errors' => $response 
			));
		die();
	}
	
?>
					<? if(isset($response)): ?>
						<dl class="dl-horizontal error">
							<? foreach ($response as $key => $value) { ?>
								<dt><?=$key?></dt>
								<dd><?=$value?></dd>
							<? } ?>						
						</dl>
					<? endif; ?>
					<form class="form-horizontal" action="<?=$rootUrl?>/../W/Users/edit" method="post">
						<? function RenderInput($propertyName, $inputtype){ ?>
							<? global $row, $response; ?>
							<div class="control-group">
								<label class="control-label" for="<?=$propertyName?>"><?=$propertyName?>:</label>
								<div class="controls">
									<input 	type="<?=$inputtype?>" name="<?=$propertyName?>" id="<?=$propertyName?>" value="<?=$row[$propertyName]?>"
										   	class="<?=isset($response[$propertyName]) ? 'error' : '' ?>"
									/>
									<? if(isset($response[$propertyName])): ?>
										<span class="error"><?=$response[$propertyName]?></span>
									<? endif; ?>
								</div>
							</div>
						<? } ?>
						<?
							RenderInput('FirstName', 'text');
							RenderInput('LastName', 'text');
						?>
							<div class="control-group">
								<label class="control-label" for="Keyword_id">Keyword_id:</label>
								<div class="controls">
									
									<select name="Keyword_id" id="Keyword_id" 
										   	class="<?=isset($response['Keyword_id']) ? 'error' : '' ?>"
									>
										<? while ($krow = $keywords->fetch_assoc()): ?>										
											<option
												value="<?=$krow['id']?>"
												<? if($row['Keyword_id'] == $krow['id']): ?>selected="selected"<? endif; ?>
												>
												<?=$krow['Name']?>
											</option>
										<? endwhile; ?>
									</select>
									
									
									
									<? if(isset($response['Keyword_id'])): ?>
										<span class="error"><?=$response['Keyword_id']?></span>
									<? endif; ?>
								</div>
							</div>
	
						
						
						<div class="control-group">
							<div class="controls">
								<input type="hidden" name="id" value="<?=$row['id']?>" />
								<input type="submit" value="Save" class="btn btn-primary" />
							</div>
						</div>
				
					</form>
	
			<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
			<script type="text/javascript">
				$(function(){
					
					$("form").validate(
						{
							rules: { created_at: { required: true} }
						}
					);
					
					$("input[type='datetime']").datepicker();
				});
			</script>
