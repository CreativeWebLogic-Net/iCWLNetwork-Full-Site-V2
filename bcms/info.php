<pre>
	Hello World
<?php
	echo"<br>\ncurrent server<br>\n";
	print $_SERVER['SERVER_NAME']."-<br>";
	$host_name=gethostname();
	echo"<br>\nserver hostname<br>\n";
	print $host_name."-<br>";
	$current_dir=pathinfo(__DIR__);
	echo"<br>\ncurrent dir<br>\n";
	print_r($current_dir)."<br>";
	echo"<br>\ncurrent file<br>\n";
	print($_SERVER['PHP_SELF']);
	echo"<br>\nsession<br>\n";
	print_r($_SESSION);
?>
</pre>
<?php
	echo "hello hell";
	if (!extension_loaded('sqlite')) {
		$prefix = (PHP_SHLIB_SUFFIX === 'dll') ? 'php_' : '';
		dl($prefix . 'sqlite.' . PHP_SHLIB_SUFFIX);
	}

	phpinfo();


?>