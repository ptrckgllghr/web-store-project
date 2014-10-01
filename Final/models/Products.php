<?php
require_once (__DIR__ . '/../inc/functions.php');

class Products
{
	static function GetAll()
	{
		$conn = GetConnection();
		return $conn->query('SELECT * FROM 2012Grad_Products P');
	}
	
	static function Get($id)
	{
		$conn = GetConnection();
		$sql = "SELECT * FROM 2012Grad_Products P WHERE P.id=$id";
		//echo $sql;
		$results = $conn->query($sql);
		$row = $results->fetch_assoc();
		$conn->close();
		return $row;
	}

	static function Blank()
	{
		return array();
	}
	
	static function Insert(&$row)
	{
		$conn = GetConnection();
		$row2 = EscapeRow($row, $conn);
		$sql = 	"Insert 2012Grad_Products (FirstName, LastName, created_at, Keyword_id) "
			.	"Values ('$row2[FirstName]','$row2[LastName]',Now(),'$row2[Keyword_id]') ";
		//echo $sql;
		$conn->query($sql);
		$error = $conn->error;
		if(empty($error))
			$row['id'] = $conn->insert_id;
		$conn->close();
		
		return $error != '' ? array('Server Error' => $error) : true;		
	}
	
	static function Update($row)
	{
		$conn = GetConnection();
		$row2 = EscapeRow($row, $conn);
		$sql = 	"UPDATE 2012Grad_Products "
			.	"Set FirstName='$row2[FirstName]',LastName='$row2[LastName]',Keyword_id='$row2[Keyword_id]' "
			.	"WHERE id=$row2[id] ";
		//echo $sql;
		$conn->query($sql);
		$error = $conn->error;
		$conn->close();
		
		return $error != '' ? array('Server Error' => $error) : true;		
	}
	
	static function Delete($id)
	{
		$conn = GetConnection();
		$sql = 	"DELETE FROM 2012Grad_Products WHERE id=$id ";
		//echo $sql;
		$conn->query($sql);
		$error = $conn->error;
		$conn->close();
		
		return $error != '' ? array('Server Error' => $error) : true;		
	}
	
	static function Validate($row)
	{
		$results = array();
		
		return count($results) > 0 ? $results : true;
	}
}
