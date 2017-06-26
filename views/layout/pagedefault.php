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
			<li data-target="login" onclick="showMenu(this)">Login</li>
			<li data-target="subscribe" onclick="showMenu(this)">Subscribe</li>
		</ul>
	</nav>
	<form class="menus" id="login" method="POST">
		<input type="text" name="login" placeholder="Login"/>
		<input type="password" name="password" placeholder="Password"/>
		<input type="submit" value="Login !"/>
	</form>
	<form class="menus" id="subscribe" method="POST">
		<h2>Subscribe now and earn easy money...</h2>
		<input type="text" value="<?= isset($_POST) && isset($_POST['login']) ? $_POST['login'] : '' ?>" name="login" placeholder="Username"/>
		<input type="text" value="<?= isset($_POST) && isset($_POST['email']) ? $_POST['email'] : '' ?>" name="email" placeholder="Email"/>
		<input type="text" value="<?= isset($_POST) && isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" name="firstname" placeholder="Firstname"/>
		<input type="text" value="<?= isset($_POST) && isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" name="lastname" placeholder="Lastname"/>
		<label>Birthdate :</label>
		<select name="day">
			<option value="">Day</option>
			<?php $day = 1; while($day <= 31): ?>
				<option value="<?= strlen($day) < 2 ? '0'.$day : $day?>"><?= strlen($day) < 2 ? '0'.$day : $day?></option>
				<?php $day++;?>
			<?php endwhile; ?>
		</select>
		<select name="month">
			<option value="">Month</option>
			<?php $month = 1; while($month <= 12): ?>
				<option value="<?= strlen($month) < 2 ? '0'.$month : $month?>"><?= strlen($month) < 2 ? '0'.$month : $month?></option>
				<?php $month++;?>
			<?php endwhile; ?>
		</select>
		<select name="year">
			<option value="">Year</option>
			<?php $year = 1900; while($year <= 2000): ?>
				<option value="<?=$year?>"><?=$year?></option>
				<?php $year++;?>
			<?php endwhile; ?>
		</select>
		<input type="password" name="password" placeholder="Password"/>
		<input type="password" name="passwordVerify" placeholder="Verify Password"/>
		<input type="submit" value="Subscribe now !"/>
	</form>
	<div class="fill"></div>
	<div onclick="hideMenu()" id="content">
		<?php if(isset($content_for_layout)){echo $content_for_layout;}?>
	</div>
	<nav id="footer">

	</nav>
	<script type="text/javascript" src="<?=WEBROOT.'scripts/menus.js'?>"></script>
</body>
</html>