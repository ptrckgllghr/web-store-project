<?php
if(isset($_POST['exp_date']))
{
	require_once __DIR__ . '/../../inc/anet_php_sdk/AuthorizeNet.php'; // Make sure this path is correct.
	$transaction = new AuthorizeNetAIM('26T9qWqkrC', '483NHrq443YqqRzP');
	$transaction->amount = $_POST['amount'];
	$transaction->card_num = $_POST['card_num'];
	$transaction->exp_date = $_POST['exp_date'];
	$transaction->last_name = $_POST['last_name'];
	
	$response = $transaction->authorizeAndCapture();
	
	if ($response->approved) {
		header("Location: thankyou.php");
	}	
	$errors = array('card_num' => $response->error_message);
}

?>

					<? if(isset($errors)): ?>
						<dl class="dl-horizontal error">
							<? foreach ($errors as $key => $value) { ?>
								<dt><?=$key?></dt>
								<dd><?=$value?></dd>
							<? } ?>						
						</dl>
						<pre>
							<? print_r($response); ?>
						</pre>
					<? endif; ?>
					<form class="form-horizontal" action="<?=$rootUrl?>/../W/Home/checkout" method="post">
							<div class="control-group">
								<label class="control-label" for="last_name">Name on Card:</label>
								<div class="controls">
									<input type="text" id="last_name" name="last_name" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="amount">Price:</label>
								<div class="controls">
									<input type="number" id="amount" name="amount" value="9.99" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="card_num">Card Number:</label>
								<div class="controls">
									<input type="tel" id="card_num" name="card_num" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="exp_date">Expiration Date:</label>
								<div class="controls">
									<input type="text" id="exp_date" name="exp_date" />
								</div>
							</div>
	
						
						
						<div class="control-group">
							<div class="controls">
								<input type="submit" value="Save" class="btn btn-primary" />
							</div>
						</div>
