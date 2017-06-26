<?php
class Events extends Model{

	function getAllEvents(){
		$query = $this::$pdo->prepare('SELECT * FROM events');
		$result = $query->execute();
		if(is_object($result)){
			while($row = $result->fetch()){
				$events[] = $row;
			}
			return $events;
		}
		return false;
	}

	function checkEvent($data){
		if($data['team_a'] == $data['team_b']){
			return false;
		}
		elseif(strlen($data['name']) < 5 || strlen($data['name']) > 30){
			return false;
		}
		elseif(!$this->checkDate($data)){
			return false;
		}
		else{
			return true;
		}
	}

	function checkDate($data){
		$timestampBegin = strtotime($data['begin-month'] . '/' . $data['begin-day'] . '/' . $data['begin-year']);
		$timestampEnd = strtotime($data['end-month'] . '/' . $data['end-day'] . '/' . $data['end-year']);
		$today = time();
		if($timestampBegin - $timestampEnd > -86401 || $timestampBegin <= $today){
			return false;
		}
		return true;
	}

	function addEvent($data){
		$query = $this::$pdo->prepare('INSERT INTO events (start, end, team_a_id, team_b_id, name) VALUES (?, ?, ?, ?, ?)');
		$query->execute([$data['start'], $data['end'], $data['team_a'], $data['team_b'], $data['name']]);
	}

	function getEvent($name){
		$query = $this::$pdo->prepare('SELECT * FROM events WHERE name=?');
		$query->execute([$name]);
		$result = $query->fetch();
		return $result;
	}
}