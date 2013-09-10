<!DOCTYPE html>
<html>
<head>
	<title>URL shortener</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
	<meta name="robots" content="noindex, nofollow">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(function () {
			$('#shortener').submit(function () {
				$.ajax({data: {longurl: $('#longurl').val()}, url: 'shorten.php', complete: function (XMLHttpRequest, textStatus) {
					$('#longurl').val(XMLHttpRequest.responseText);
				}});
				return false;
			});
		});
	</script>
</head>

<body>
<div class="header">
	<div id="logo">
		<a href="http://s.mcgrath.net.nz/">
		<img alt="logo" src="images/logo.png">
		</a>
	</div>
</div>


<div id="body-wrapper" class="clearfix">
	<div id="shortenform">
	<h1 style="font-size:30px; line-height:35px;">Shorten that URL</h1>
		<form method="post" action="shorten.php" id="shortener">
			<input type="text" name="longurl" id="longurl" class="urlshorten"> <input type="submit" value="Shorten" class="button black">
		</form>
	</div>
</div>

</body>
</html>