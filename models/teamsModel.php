<?php
class Teams extends Model{
	function addTeam($data){
		$query = $this::$pdo->prepare('INSERT INTO teams (name) VALUES (:name)');
		$query->execute(['name' => $data['team-name']]);
	}

	function checkTeam($data){
		if(strlen($data['team-name']) < 3 || strlen($data['team-name']) > 20){
			return false;
		}
		return true;
	}

	function getAllTeams(){
		$query = $this::$pdo->prepare('SELECT * FROM teams');
		$query->execute();
		while($row = $query->fetch()){
			$teams[] = $row;
		}
		return $teams;
	}

	function deleteTeam($data){
		$query = $this::$pdo->prepare('DELETE FROM teams WHERE name=:name');
		$query->execute(['name' => $data['team-name']]);
	}

	function getTeamName($id){
		$query = $this::$pdo->prepare('SELECT name FROM teams WHERE id=?');
		$query->execute([$id]);
		$result = $query->fetch()->name;
		return $result;
	}
}