<?php
/*
 * First authored by Brian Cray
 * License: http://creativecommons.org/licenses/by/3.0/
 * Contact the author at http://briancray.com/
 */


if(!preg_match('|^[0-9a-zA-Z]{1,6}$|', $_GET['url']))
{
	die('That is not a valid short url');
}

require('config.php');

$shortened_url = ($_GET['url']);

if(CACHE)
{
	$long_url = file_get_contents(CACHE_DIR . $shortened_url);
	if(empty($long_url) || !preg_match('|^https?://|', $long_url))
	{
		$get_url = mysql_query('SELECT url FROM ' . DB_TABLE . ' WHERE shortened="' . mysql_real_escape_string($shortened_url) . '"');
		if(!mysql_num_rows($get_url) == 0)
		{
			$long_url = mysql_result($get_url, 0, 0);
			@mkdir(CACHE_DIR, 0777);
			$handle = fopen(CACHE_DIR . $shortened_url, 'w+');
			fwrite($handle, $long_url);
			fclose($handle);
		}
		else
		{
			die('That is not a valid short url');
		}
	}
}
else
{
	$get_url = mysql_query('SELECT url FROM ' . DB_TABLE . ' WHERE shortened="' . mysql_real_escape_string($shortened_url) . '"');
	if(!mysql_num_rows($get_url) == 0)
	{
		$long_url = mysql_result($get_url, 0, 0);
	}
	else
	{
		die('That is not a valid short url');
	}
}



header('HTTP/1.1 301 Moved Permanently');
header('Location: ' .  $long_url);
exit;

