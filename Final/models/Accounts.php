<?php
session_start();
require_once (__DIR__ . '/../inc/functions.php');

function IsLoggedIn()
{
	return UserId() != FALSE;
}

function UserId()
{
	if(!isset($_SESSION['User']))
		return FALSE;
	$user = $_SESSION['User'];
	if(!isset($user['id']))
		return FALSE;
	
	return $user['id'];
}

function User()
{
	if(!isset($_SESSION['User']))
		return FALSE;
	$user = $_SESSION['User'];
	return $user;	
}

function RequireLogin()
{
	global $rootUrl;
	if(!IsLoggedIn())
	{
		header("Location: $rootUrl/../W/Accounts/login?returnUrl=$_SERVER[REQUEST_URI]");
		die();
	}
}

function DoLogin($email, $password)
{
	if(!empty($password))
	{
		$_SESSION['User'] = array('name'=>$email, 'id'=>$email);
		return true;
	}else{
		return array('password'=>'Wrong password');
	}
}
