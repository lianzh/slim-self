<?php

function classLoader()
{
	static $loader = null;
	if ( is_null($loader) )
	{
		$loader = new \Composer\Autoload\ClassLoader();
		$loader->register();
	}

	return $loader;
}
