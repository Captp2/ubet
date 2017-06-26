<link rel="stylesheet" property="stylesheet" href="<?=WEBROOT.'stylesheets/bets.css'?>">
<?php foreach($data['events'] as $event):?>
	<div class="event">
		<h4><?=$event->name?></h4>
		<p class="team-name"><?=$event->team_a_name?><img src="<?=WEBROOT.'images/versus.png'?>" alt="versus"/><?=$event->team_b_name?></p>
		<p class="event-end"><?=$event->team_a_cote?> : <?=$event->team_b_cote?></p>
		<p class="event-end">Ends on <?= substr($event->end, 0, 10)?></p>
		<form id="<?=$event->id?>" method="POST" class="makeABet">
			<input type="hidden" name="event" value="<?=$event->name?>"/>
			<p class="event-end">Bet on : </label>
			<select name="bet_team">
				<option value="<?=$event->team_a_id?>"><?=$event->team_a_name?></option>
				<option value="<?=$event->team_b_id?>"><?=$event->team_b_name?></option>
			</select>
			<input type="number" placeholder="Amount of uCoins" name="bet_amount" min="5" max="1000"/>
			<input type="submit" value="Validate your bet"/>
		</form>
		<button type="button" onclick="showMenu(this)" data-target="<?=$event->id?>" class="btn">Bet now !</button>
	</div>
<?php endforeach;?>