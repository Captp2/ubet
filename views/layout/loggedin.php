<!DOCTYPE html>
<html>
<head>
	<title>uBet</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="<?=WEBROOT.'stylesheets/reset_css.css'?>"/>
	<link rel="stylesheet" type="text/css" href="<?=WEBROOT.'stylesheets/main.css'?>"/>
	<link rel="stylesheet" type="text/css" href="<?=WEBROOT.'stylesheets/classes.css'?>"/>
	<script
	src="http://code.jquery.com/jquery-3.1.1.js"
	integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
	crossorigin="anonymous"></script>
</head>
<body>
	<nav id="navbar">
		<a href="<?=WEBROOT?>"><img alt="logo uBet" src="<?=WEBROOT.'images/logo.png'?>"/></a>
		<ul id="navbar-login">
			<li><a href="<?=WEBROOT.'bet/index'?>">Bets</a></li>
			<li><a href="<?=WEBROOT.'user/account'?>">My account</a></li>
			<li><a href="<?=WEBROOT.'wallet/index'?>">My wallet</a></li>
			<li><a href="<?=WEBROOT.'user/logout'?>">Logout</a></li>
		</ul>
	</nav>
	<div class="fill"></div>
	<div onclick="hideMenu()" id="content">
		<?php if(isset($content_for_layout)){echo $content_for_layout;}?>
	</div>
	<nav id="footer">

	</nav>
	<script type="text/javascript" src="<?=WEBROOT.'scripts/menus.js'?>"></script>
</body>
</html>