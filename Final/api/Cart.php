<?
require_once (__DIR__ . '/../models/Accounts.php');
require_once (__DIR__ . '/../models/Products.php');
//print_r($_SERVER);
	if(!isset($_SESSION['cart']))
		$_SESSION['cart'] = array();
	$cart = $_SESSION['cart'];
	$requestMethod = isset($_REQUEST['_method']) ? $_REQUEST['_method'] : $_SERVER['REQUEST_METHOD'];
	switch ($requestMethod) {
		case 'POST':
			if(isset($cart[$_GET['id']]))
			{
				$item = $cart[$_GET['id']]['count'] += $_REQUEST['count'];
			}else{
				$cart[$_GET['id']] = array('id'=> $_GET['id'], 'count'=> $_REQUEST['count']);				
			}
			
			echo json_encode($cart[$_GET['id']]);								
			break;
		case 'PUT':
			$cart[$_GET['id']] = array('id'=> $_GET['id'], 'count'=> $_REQUEST['count']);
			echo json_encode($cart[$_GET['id']]);								
			break;
		case 'DELETE':
				echo 'success';			
			break;
		default:
			if(empty($_GET['id']))
			{
				echo json_encode($cart);				
			}else{
				echo json_encode($cart[$_GET['id']]);								
			}
			break;
	}
	$_SESSION['cart'] = $cart;