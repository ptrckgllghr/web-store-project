<?
require_once (__DIR__ . '/../models/Accounts.php');
require_once (__DIR__ . '/../models/Products.php');
//print_r($_SERVER);
	switch ($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			break;			
		case 'PUT':			
			break;
		case 'DELETE':			
			break;
		default:
			if(empty($_GET['id']))
			{
				$results = Products::GetAll();
				$data = array();
				while ($rs = $results->fetch_assoc()) {
					$data[] = $rs;				
				}
				echo json_encode(array('aaData' => $data));				
			}else{
				$data = Products::Get($_GET['id']);
				echo json_encode($data);								
			}
			break;
	}