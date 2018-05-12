<?php

// autoloading the classes to be used
spl_autoload_register(function($class_name)
{
	require __DIR__.'\\'.$class_name.'.php';
});