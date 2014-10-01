<?php
require_once (__DIR__ . '/../inc/functions.php');

class Keywords
{
	static function GetAll()
	{
		$conn = GetConnection();
		return $conn->query('SELECT * FROM 2012Grad_Keywords WHERE Keyword_id=2');
	}
}