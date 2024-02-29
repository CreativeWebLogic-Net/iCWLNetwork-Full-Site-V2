<pre>
<?php
	echo "Default Server TimeZone: ".date_default_timezone_get()."\n";
	echo date('l dS \of F Y h:i:s A')."\n";

	echo"<br>\ncurrent server ip<br>\n";
	print $_SERVER['SERVER_ADDR'];
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
	print_r($session_data);
?>
</pre>
<?php
	phpinfo();


?>