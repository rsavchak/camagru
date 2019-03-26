<?php
spl_autoload_register('autoload');
function autoload($class_name){
	$array_path = array(
		'/model/',
		'/components/'
	);

	foreach ($array_path as $path){
		$path = ROOT . $path . $class_name . '.php';
		if (is_file($path))
			include_once $path;
	}
}