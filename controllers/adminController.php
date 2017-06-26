<?php
class Admin extends Controller{

	function __construct(){
		if(isset($_SESSION['auth']) && $_SESSION['auth']->rights == 1){
			$this->setlayout('admin');
		}
		else{
			$this->setlayout('denied');
		}
	}

	function index(){
		$modelTeam = $this->loadModel('Teams');
		$data['teams'] = $modelTeam->getAllTeams();
		if(isset($_POST['add-team'])){
			$query = 'SELECT * FROM teams WHERE name=:name';
			$params = ['name' => $_POST['team-name']];
			if(!$modelTeam->checkTeam($_POST)){
				$data['info'] = '<p class="warning">The team name must contain between 3 and 20 characters</p>';
			}
			elseif($modelTeam->exists($query, $params)){
				$data['info'] = '<p class="warning">The team you\'re trying to create already exists</p>';
			}
			else{
				$modelTeam->addTeam($_POST);
				$data['info'] = '<p class="success">Team succesfully created</p>';
			}
		}
		if(isset($_POST['delete-team'])){
			$modelTeam->deleteTeam($_POST);
			$data['info'] = '<p class="success">Team succesfully deleted</p>';
		}
		if(isset($_POST['add-event'])){
			$eventsModel = $this->loadModel('Events');
			$data['events'] = $eventsModel->getAllEvents();
			if(!$eventsModel->checkEvent($_POST)){
				$data['info'] = '<p class="warning">Please enter valid options for the event.</p>';
			}
			else{
				$eventsModel->addEvent($_POST);
				$data['info'] = '<p class="success">Event validated.</p>';
			}
		}
		$this->render('index', $data);	
	}
}