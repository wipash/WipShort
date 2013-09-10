<?php
/*
 * First authored by Brian Cray
 * License: http://creativecommons.org/licenses/by/3.0/
 * Contact the author at http://briancray.com/
 */
 
$url_to_shorten = get_magic_quotes_gpc() ? stripslashes(trim($_REQUEST['longurl'])) : trim($_REQUEST['longurl']);
if(!empty($url_to_shorten) && preg_match('|^https?://|', $url_to_shorten))
{
	require('config.php');
	// check if the client IP is allowed to shorten
	if($_SERVER['REMOTE_ADDR'] != LIMIT_TO_IP)
	{
		die('You are not allowed to shorten URLs with this service.');
	}
	
	// check if the URL has already been shortened
	$already_shortened = mysql_query('SELECT shortened FROM ' . DB_TABLE. ' WHERE url="' . mysql_real_escape_string($url_to_shorten) . '"');
	if(!mysql_num_rows($already_shortened) == 0)
	{
		// URL has already been shortened
		$shorturl = mysql_result($already_shortened, 0, 0);
	}
	else
	{
		// URL not in database, insert
		$id=rand(10000,99999);
		$shorturl=base_convert($id,20,36);
		mysql_query('LOCK TABLES ' . DB_TABLE . ' WRITE;');
		mysql_query('INSERT INTO ' . DB_TABLE . ' (id, url, shortened) VALUES ("' . $id . '", "' . mysql_real_escape_string($url_to_shorten) . '", "' . $shorturl . '")');
		mysql_query('UNLOCK TABLES');
	}
	echo BASE_HREF . $shorturl;
}

?>

