<?php

        
     
     




 
/*
function dirify($s) {
     $s = convert_high_ascii($s);  ## convert high-ASCII chars to 7bit.
     $s = strtolower($s);           ## lower-case.
     $s = strip_tags($s);       ## remove HTML tags.
     $s = preg_replace('!&[^;\s]+;!','',$s);         ## remove HTML entities.
     $s = preg_replace('![^\w\s.]!','',$s);           ## remove non-word/space/period chars.
     $s = preg_replace('!\s+!','-',$s);               ## change space chars to dashes.
     return $s;    
}
*/

//echo"xxx";


// Connecting, selecting database
/*
function test_pgsql(){
	
	$dbconn = pg_connect("host=localhost dbname=cwy0ek0e_bubblelite2 user=postgres password=DickSux5841")
    or die('Could not connect: ' . pg_last_error());
	
	// Performing SQL query
	$query = 'SELECT * FROM administrators';
	echo"43210000101-------------------|-".$query."-|----------------------------------------------------------\n\n";
	
	$result = pg_query($query);// or die('Query failed: ' . pg_last_error());
	echo $query;
	echo"432100001-------------------|-".$query."-|----------------------------------------------------------\n\n";
	// Printing results in HTML
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		echo "\t<tr>\n";
		foreach ($line as $col_value) {
			echo "\t\t<td>$col_value</td>\n";
		}
		echo "\t</tr>\n";
	}
	echo "</table>\n";

	// Free resultset
	pg_free_result($result);

	// Closing connection
	pg_close($dbconn);
	
	
}
*/

?>