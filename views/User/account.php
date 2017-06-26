<?php if(isset($data['edit'])){
	echo $data['edit'];
}?>
<div id="account">
	<h2>See your account details and modify it.</h2>
	<p class="account-title">Username : <span class="account-info"><?=$data['user']->login?></span></p>
	<p class="account-title">Email : <span class="account-info"><?=$data['user']->email?></span></p>
	<p class="account-title">Firstname : <span class="account-info"><?=$data['user']->firstname?></span></p>
	<p class="account-title">Lastname : <span class="account-info"><?=$data['user']->lastname?></span></p>
	<button class="btn" onclick="showMenu(this);hideMe(this)" data-target="editAccount" type="button">Edit your profil.</button>
</div>
<form id="editAccount" method="POST">
	<h2>Edit your profil informations</h2>
	<input type="text" name="login" value="<?=$data['user']->login?>" placeholder="Username"/>
	<input type="text" name="email" value="<?=$data['user']->email?>" placeholder="Email"/>
	<input type="text" name="firstname" value="<?=$data['user']->firstname?>" placeholder="Firstname"/>
	<input type="text" name="lastname" value="<?=$data['user']->lastname?>" placeholder="Lastname"/>
	<input type="password" name="password" placeholder="Password"/>
	<input type="password" name="password-verify" placeholder="Verify password"/>
	<button class="btn" onclick="showMenu(this);hideMe(this)" data-target="account">Save changes</button>
</form>