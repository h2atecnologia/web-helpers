<?php

namespace HTTP;

class Request
{
	public static function is_cors()
	{
		return isset($_SERVER['HTTP_ORIGIN']);
	}
	
	public static function is_ajax()
	{
		return !empty($_SERVER["HTTP_X_REQUESTED_WITH"]) &&
			$_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest";
	}

	public static function accept_json()
	{
		if(isset($_SERVER['HTTP_ACCEPT']))
		{
			$p = explode(";", $_SERVER['HTTP_ACCEPT']);
			$pp = preg_split("/[\s,]+/", $p[0]);		
			return in_array("application/json", $pp);
		}		
		return false;
	}

	public static function accept_xml()
	{
		if(isset($_SERVER['HTTP_ACCEPT']))
		{
			$p = explode(";", $_SERVER['HTTP_ACCEPT']);
			$pp = preg_split("/[\s,]+/", $p[0]);		
			return in_array("application/xml", $pp);
		}		
		return false;
	}

	public static function is_post()
	{
		return ($_SERVER['REQUEST_METHOD']=="POST");
	}

	public static function is_get()
	{
		return ($_SERVER['REQUEST_METHOD']=="GET");
	}

	public static function is_put()
	{
		return ($_SERVER['REQUEST_METHOD']=="PUT");
	}

	public static function is_delete()
	{
		return ($_SERVER['REQUEST_METHOD']=="DELETE");
	}

	public static function is_options()
	{
		return ($_SERVER['REQUEST_METHOD']=="OPTIONS");
	}		
	
	public static function get_get_object()
	{
		unset($_GET["_"]);	// limpa jQuery cache hint
		return count($_GET) ? (object) $_GET : null;
	}
	
	public static function get_post_object()
	{
		return count($_POST) ? (object) $_POST : null;
	}
	
	public static function get_put_object()
	{
		if($_SERVER['CONTENT_LENGTH'])
		{				
			parse_str(file_get_contents('php://input', false , null, -1 , $_SERVER['CONTENT_LENGTH']), $_PUT);
			return (object) $_PUT;
		}
		return null;
	}
	
	public static function get_cookie($cookie_name)
	{
		if(isset($_COOKIE[$cookie_name]))
		{ 
			$tmparray=unserialize(stripslashes($_COOKIE[$cookie_name])); 
		} else { 
			$tmparray = array(); 
		} 
		return $tmparray; 
	}
}

?>