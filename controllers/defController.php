<?php
class Def extends Controller{
	function index(){
		$data = array();
		if(!empty($this->data) && !isset($this->data['email'])){
			$modelsUser	= $this->loadModel('Users');
			$user = $modelsUser->login($this->data);
			if($user){
				$_SESSION['auth'] = $user;
			}else{
				$data['login'] = '<p class="warning">The username and the password doesn\'t match.</p>';
			}
		}
		if(!empty($this->data) && isset($this->data['email'])){
			$modelsUser	= $this->loadModel('Users');
			$data['subscription'] = $modelsUser->checkSubscription($this->data);
		}
		$this->render('index', $data);
	}
}