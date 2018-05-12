<?php

/** the entry point of the application that requires the autoload files, configuration files and instantiates
the Application class object which handles the logic and returns the exception messages if an Exception is caught.
**/
require './autoloader.php';
require './vendor/autoload.php';

use Classes\Application;

$config = require_once './config.php';

$application = new Application($argv, $config);

try
{
	$result = $application->handle();
	print_r($result);
}
catch(\Exception $e)
{
	echo $e->getMessage();
}

?>