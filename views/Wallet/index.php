<link rel="stylesheet" property="stylesheet" href="<?=WEBROOT.'stylesheets/wallet.css'?>">
<br/>
<div class="fill"></div>
<div id="wallet">
	<div id="wallet-header">
		<p id="balance">Balance : <span><?=isset($data['wallet']->balance) ? $data['wallet']->balance : '0'?><img class="ucoin" alt="logo ucoin" src="<?=WEBROOT.'images/ucoin.png'?>"></span></p>
	</div>
	<div id="paypal">
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			<input type='hidden' value="Amount" name="amount"/>
			<div id="buy">
				<select name="amount">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="50">50</option>
				</select>
				<input name="currency_code" type="hidden" value="EUR"/>
				<input name="return" type="hidden" value="http://liebkrigt.me/wallet/payment_validated"/>
				<input name="cancel_return" type="hidden" value="http://liebkrigt.me/wallet/payment_cancelled"/>
				<input name="notify_url" type="hidden" value="http://liebkrigt.me/wallet/payment_validation"/>
				<input name="cmd" type="hidden" value="_xclick"/>
				<input name="business" type="hidden" value="liebkrigt@liebkrigt.me"/>
				<input name="item_name" type="hidden" value="ucoins"/>
				<input name="no_note" type="hidden" value="1"/>
				<input name="lc" type="hidden" value="FR"/>
				<input name="bn" type="hidden" value="PP-BuyNowBF"/>
				<input name="custom" type="hidden" value="<?=$_SESSION['auth']->id?>"/>
				<input id="paypal-button" alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et sécurisée" name="submit" src="https://www.paypal.com/fr_FR/FR/i/btn/btn_buynow_LG.gif" type="image" /><img src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" border="0" alt="" width="1" height="1" />
			</div>
		</form>
	</div>
	<div class="fill"></div>
	<h2>History</h2>
	<table>
		<tr>
			<th>Date</th>
			<th>Amount</th>
		</tr>
		<?php foreach($data['history'] as $transaction):?>
			<tr>
				<td><?=$transaction->timestamp?></td>
				<td><?=$transaction->amount?><img class="ucoin" alt="logo ucoin" src="<?=WEBROOT.'images/ucoin.png'?>"></td>
			</tr>
		<?php endforeach;?>
	</table>
</div>