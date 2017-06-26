<?php
class Bet_m extends Model{
	function getEvents(){
		$query = $this::$pdo->prepare('SELECT * FROM events');
	}

	function sendBet($data, $user_id){
		// var_dump($data);
		$query = $this::$pdo->prepare('INSERT INTO bets (user_id, bet, team_id) VALUES(?, ?, ?)');
		// $query->execute([$user_id, $data['bet_amount'], $data['bet_team']]);
		$query = $this::$pdo->prepare('SELECT team_a_betters, team_b_betters FROM events WHERE name=:name');
		$query->execute(['name' => $data['event']]);
		$result = $query->fetch();
		// var_dump($result);
		$team_a_betters = $result->team_a_betters;
		$team_a_betters++;
		// var_dump($team_a_betters);
	}
}