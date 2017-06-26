<?php
class User extends Controller{

	function index(){
		$modelsUser	= $this->loadModel('Users');
		$data['user'] = $modelsUser->getUser(1);
		$this->render('index', $data);
	}

	function logout(){
		$data = array();
		$modelsUser = $this->loadModel('Users');
		$modelsUser->logout();
		$this->render('logout', $data);
	}

	function account(){
		if(!empty($this->data) && isset($this->data['login'])){
			$data = $this->checkProfilEdition($this->data);
		}
		if(!empty($_SESSION) && isset($_SESSION['auth'])){
			$modelsUser	= $this->loadModel('Users');
			$data['user'] = $modelsUser->getUser($_SESSION['auth']->id);
			$this->render('account', $data);
		}
		elseif(empty($_SESSION)){
			$this->setlayout('denied');
		}
	}

	function checkProfilEdition($data){
		$modelsUser	= $this->loadModel('Users');
		$check = '<p class="success">Changes validated</p>';
		$data['edit'] = $check;
		if(!$modelsUser->checkUsername($this->data['login'])){
			$data['edit'] = '<p class="warning">The username you selected isn\'t available</p>';
		}
		if(!$modelsUser->checkLength($this->data['login'])){
			$data['edit'] = '<p class="warning">Your username must contain between 3 and 20 characters.</p>';
		}
		if(!$modelsUser->checkEmail($this->data['email'])){
			$data['edit'] = '<p class="warning">Plase submit a valid email.</p>';
		}
		if(!$modelsUser->checkLength($this->data['firstname'])){
			$data['edit'] = '<p class="warning">Your firstname must contain between 3 and 20 characters.</p>';
		}
		if(!$modelsUser->checkLength($this->data['lastname'])){
			$data['edit'] = '<p class="warning">Your lastname must contain between 3 and 20 characters.</p>';
		}
		if(!$modelsUser->checkLength($this->data['password'])){
			$data['edit'] = '<p class="warning">Your password must contain between 3 and 20 characters.</p>';
		}
		if(!$modelsUser->checkPasswords($this->data['password'], $this->data['password-verify'])){
			$data['edit'] = '<p class="warning">Your passwords doesn\'t matches.</p>';
		}
		if($data['edit'] == $check){
			$modelsUser->editProfil($data);
		}
		return $data;
	}

	function validateAccount(){
		$token = explode('-', $_GET['p'])[1];
		$id = explode('-', $_GET['p'])[0];
		$id = explode('/', $id)[2];
		$usersModel = $this->loadModel('Users');
		$validate = $usersModel->validateAccount($token, $id);
		if($validate){
			$data['validate'] = 'Account validated';
		}
		else{
			$data['validate'] = 'Something went wrong, please try again';
		}
		$this->render('accountValidation', $data);
	}
}
?>