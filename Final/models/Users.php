<?php
require_once (__DIR__ . '/../inc/functions.php');

class Users
{
	static function GetAll()
	{
		$conn = GetConnection();
		return $conn->query('SELECT U.*, K.Name FROM 2012Grad_Users U Join 2012Grad_Keywords K ON U.Keyword_id=K.id');
	}
	
	static function Get($id)
	{
		$conn = GetConnection();
		$sql = "SELECT U.*, K.Name FROM 2012Grad_Users U Join 2012Grad_Keywords K ON U.Keyword_id=K.id WHERE U.id=$id";
		echo $sql;
		$results = $conn->query($sql);
		$row = $results->fetch_assoc();
		$conn->close();
		return $row;
	}

	static function Blank()
	{
		return array('FirstName'=>null,'LastName'=>null,'created_at'=>null,'updated_at'=>null,'Keyword_id'=>null,'id'=>null,);
	}
	
	static function Insert(&$row)
	{
		$conn = GetConnection();
		$row2 = EscapeRow($row, $conn);
		$sql = 	"Insert 2012Grad_Users (FirstName, LastName, created_at, Keyword_id) "
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
		$sql = 	"UPDATE 2012Grad_Users "
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
		$sql = 	"DELETE FROM 2012Grad_Users WHERE id=$id ";
		//echo $sql;
		$conn->query($sql);
		$error = $conn->error;
		$conn->close();
		
		return $error != '' ? array('Server Error' => $error) : true;		
	}
	
	static function Validate($row)
	{
		$results = array();
		if(!is_numeric($row['Keyword_id'])) $results['Keyword_id'] = 'Keyword id needs to be a number';
		if(empty($row['Keyword_id'])) $results['Keyword_id'] = 'Keyword is required';
		if(empty($row['FirstName'])) $results['FirstName'] = 'FirstName is required';
		if(empty($row['LastName'])) $results['LastName'] = 'LastName is required';
		
		return count($results) > 0 ? $results : true;
	}
}
