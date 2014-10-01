<?php
require_once (__DIR__ . '/../inc/functions.php');
	if(isset($_REQUEST['ajax'])):
		include(__DIR__ . "/$_GET[controller]/$_GET[action].php");
	else:
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<? include(__DIR__ . '/../inc/head.php'); ?>
	</head>
	
	<body>
		<div>
			<? include(__DIR__ . '/../inc/nav.php'); ?>

			<div id="content">
				<?
					$controller = empty($_GET['controller']) ? 'Home' : $_GET['controller'];
					$action = empty($_GET['action']) ? 'index' : $_GET['action'];
					include(__DIR__ . "/$controller/$action.php");
				?>
			<footer>
				</div>
					<? include(__DIR__ . '/../inc/footer.php'); ?>
				</div>
			</footer>
	</body>
</html>
<? endif; ?>