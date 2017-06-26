<?php
if(isset($data['info'])){
	echo $data['info'];
}?>
<div id="admin-edit">
	<div class="edit" id="admin-events" onclick="adminEvents(this)">
		<h3 class="admin-header">Add an upcoming event</h3>
		<div class="admin-body">
			<?php if(count($data['teams']) >= 2):?>
				<!-- <h3>Select the parameters for the upcoming event</h3> -->
				<form id="add-event" method="POST">
					<input type="hidden" name="add-event" value="true"/>
					<input type="text" placeholder="Name" name="name"/>
					<div id="team-select">
						<select id="team_a" onchange="selectTeam(this)" name="team_a">
							<?php foreach($data['teams'] as $team):?>
								<option value="<?=$team->id?>"><?=ucwords($team->name)?></option>
							<?php endforeach;?>
						</select>
						<p>VS</p>
						<select id="team_b" onchange="selectTeam(this)" name="team_b">
							<?php foreach($data['teams'] as $team):?>
								<option value="<?=$team->id?>"><?=ucwords($team->name)?></option>
							<?php endforeach;?>
						</select>
					</div>
					<br/>
					<label>Beggins on :</label>
					<select name="begin-day">
						<?php $i = 1; while($i <= 31): ?>
						<option value="<?= strlen($i) < 2 ? '0'.$i : $i?>"><?= strlen($i) < 2 ? '0'.$i : $i?></option>
						<?php $i++;
						endwhile;?>
					</select>
					<select name="begin-month">
						<?php $i = 1; while($i <= 12): ?>
						<option value="<?= strlen($i) < 2 ? '0'.$i : $i?>"><?= strlen($i) < 2 ? '0'.$i : $i?></option>
						<?php $i++;
						endwhile;?>
					</select>
					<select name="begin-year">
						<?php $i = 2017; while($i <= 2020): ?>
						<option value="<?= strlen($i) < 2 ? '0'.$i : $i?>"><?= strlen($i) < 2 ? '0'.$i : $i?></option>
						<?php $i++;
						endwhile;?>
					</select>
					<br/>
					<label>Ends on :</label>
					<select name="end-day">
						<?php $i = 1; while($i <= 31): ?>
						<option value="<?= strlen($i) < 2 ? '0'.$i : $i?>"><?= strlen($i) < 2 ? '0'.$i : $i?></option>
						<?php $i++;
						endwhile;?>
					</select>
					<select name="end-month">
						<?php $i = 1; while($i <= 12): ?>
						<option value="<?= strlen($i) < 2 ? '0'.$i : $i?>"><?= strlen($i) < 2 ? '0'.$i : $i?></option>
						<?php $i++;
						endwhile;?>
					</select>
					<select name="end-year">
						<?php $i = 2017; while($i <= 2020): ?>
						<option value="<?= strlen($i) < 2 ? '0'.$i : $i?>"><?= strlen($i) < 2 ? '0'.$i : $i?></option>
						<?php $i++;
						endwhile;?>
					</select>
					<input type="submit" value="Register a new event"/>
				</form>
			<?php endif?>
			<?php if(count($data['teams']) < 2):?>
				<h3>You need at least two teams to register an event.</h3>
			<?php endif;?>
		</div>
	</div>
	<div class="edit" id="admin-teams" onclick="adminTeams(this)">
		<h3 class="admin-header">Administrate teams</h3>
		<div class="admin-body">
			<h3>Add a team</h3>
			<form id="add-team" method="POST">
				<input type="hidden" name="add-team" value="true"/>
				<input type="text" name="team-name" placeholder="Name"/>
				<input id="add-team-submit" value="Add a team" type="submit"/>
			</form>
			<?php if(!empty($data['teams'])):?>
				<h3>Delete a team</h3>
				<form id="delete-team" method="POST">
					<input type="hidden" name="delete-team" value="true"/>
					<select name="team-name">
						<?php foreach($data['teams'] as $team):?>
							<option value="<?=$team->name?>"><?=$team->name?></option>
						<?php endforeach;?>
					</select>
					<input id="delete-team-submit" value="Delete this team" type="submit"/>
				</form>
			<?php endif;?>
		</div>
	</div>
	<div class="edit" id="admin-users" onclick="adminUsers(this)">
		<h3 class="admin-header">Administrate users</h3>
		<div class="admin-body">
			<p>ADMIIIIN</p>
		</div>
	</div>
</div>