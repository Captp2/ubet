<?php
class Bet extends Controller{
	function __construct(){
		if(empty($_SESSION)){
			$this->setlayout('denied');
		}
		elseif($_SESSION['auth']->rights == 1){
			$this->setlayout('admin');
		}
		else{
			$this->setlayout('loggedin');
		}
	}

	function index(){
		$eventsModel = $this->loadModel('Bet_m');
		$data['events'] = $eventsModel->getAll('events');
		$data['events'] = $this->organizeData($data['events']);
		if(isset($_POST['bet_team'])){
			$this->getBetData($_POST, $_SESSION['auth']->id);
		}
		$this->render('index', $data);
	}

	function organizeData($events){
		$teamsModel = $this->loadModel('Teams');
		foreach($events as $event){
			$event->team_a_name = $teamsModel->getTeamName($event->team_a_id);
			$event->team_b_name = $teamsModel->getTeamName($event->team_b_id);
			$event->team_a_cote = explode(':', $event->cote)[0];
			$event->team_b_cote = explode(':', $event->cote)[1];
		}
		return $events;
	}

	function getBetData($data, $user_id){
		$eventsModel = $this->loadModel('Bet_m');
		$data['cote'] = $this->calculateCote($data);
		$eventsModel->sendBet($data, $user_id);
	}

	function calculateCote($data){
		$eventsModel = $this->loadModel('Events');
		$event = $eventsModel->getEvent($data['event']);
		$team_a_sum = $event->team_a_sum;
		$team_b_sum = $event->team_b_sum;
		if($data['bet_team'] == $event->team_a_id){
			$team_a_sum += (int) $data['bet_amount']; 
		}
		else{
			$team_b_sum += (int) $data['bet_amount'];
		}
		// var_dump($team_a_sum);
		// var_dump($team_b_sum);
		$team_a_betters = ceil(strlen($event->team_a_betters) / 2);
		$team_b_betters = ceil(strlen($event->team_b_betters) / 2);
		$diff = abs($team_a_sum - $team_b_sum);
		$diff_percent = ($diff - $data['bet_amount']) / $data['bet_amount'] * 100;
		echo $diff_percent;
	}
}


// $biggest_total = $total_a > $total_b ? $total_a : $total_b;
// $biggest_betters = $betters_a > $betters_b ? $betters_b : $betters_b;
// $diff = $total_a - $total_b);
// $cote = $diff / $biggets_betters;

// $diff = 210 - 80 = 130;
// $percent = 