<?php
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50534)
	die('WebHelpers requires PHP 5.5.34 or higher');

require __DIR__.'/lib/HTTP/Exceptions.php';
require __DIR__.'/lib/HTTP/Request.php';
require __DIR__.'/lib/HTTP/Response.php';

require __DIR__.'/lib/Security/PasswordHash.php';
require __DIR__.'/lib/Security/PasswordHelper.php';

?>