<?
	$results = array();
	require_once(__DIR__ . '/../../models/Accounts.php');
	if(isset($_REQUEST['returnUrl']))
		$_SESSION['returnUrl'] = $_REQUEST['returnUrl'];
	if(!isset($_SESSION['returnUrl']) && isset($_SERVER['HTTP_REFERER']))
		$_SESSION['returnUrl'] = $_SERVER['HTTP_REFERER'];
			
	if(isset($_POST['email']))
	{
		$row = $_POST;
		$results = DoLogin($_POST['email'], $_POST['password']);
		if($results === true)
		{
			$returnUrl = !empty($_SESSION['returnUrl']) ? $_SESSION['returnUrl'] : "$rootUrl/../W/Home/";
			header("Location: $returnUrl");
			die();
		}
	}else{
		$row = array('email'=>null, 'password'=>null);
	}
?>



            	<dl class="error">
            		<? foreach ($results as $key => $value): ?>
						<dt><?=$key?></dt>
						<dd><?=$value?></dd>
					<? endforeach; ?>
            	</dl>
            	
                <form class="form-horizontal" method="post" action="<?=$rootUrl?>/../W/Accounts/login">
                    <div class=" control-group">
                        <label class="control-label" for="email">Email or Phone Number:</label>
                        <div class="controls">
                            <input 	type="text" name="email" id="email" value="<?=$row['email']?>"
                            		 placeholder="Email or Phone Number"
									class="required  <?=isset($results['email']) ? 'error' : '' ?>"
							 />
                             <span class="error"><?=isset($results['email']) ? $results['email'] : '' ?></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">Password:</label>
                        <div class="controls">
                            <input 	type="text" name="password" id="password" value="<?=$row['password']?>"
                            		placeholder="Password"
                            		class="<?=isset($results['password']) ? 'error' : '' ?>"
                            />
                             <span class="error"><?=isset($results['password']) ? $results['password'] : '' ?></span>
                        </div>
                    </div>
                    <div class="control-group">
                    	<div class="controls">
                    		<input class="btn btn-primary" type="submit" value="Login" />
                        </div>
                    </div>
                </form>
