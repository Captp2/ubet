<?php
class Users extends Model{
	protected $table = 'users';

	function getUser($id){
		$sql = "SELECT * FROM ".$this->table." WHERE id=:id";
		$query = self::$pdo->prepare($sql);
		$query->bindParam(":id", $id);
		$query->execute();
		return $query->fetch();
	}

	function login($data){
		$user = $this::$pdo->prepare('SELECT * FROM users WHERE login=:login OR email=:login');
		$user->execute(['login' => $data['login']]);
		$user = $user->fetch();
		if(is_object($user)){
			if(password_verify($data['password'], $user->password)){
				return $user;
			}
		}
		return false;
	}

	function logout(){
		session_destroy();
	}

	function editProfil($data){
		$password = password_hash($data['password'], PASSWORD_BCRYPT);
		$query = $this::$pdo->prepare('UPDATE users SET login=:login, password=:password, email=:email, firstname=:firstname, lastname=:lastname WHERE id=:id');
		$query->execute(['login' => $data['login'],
			'password' => $password,
			'email' => $data['email'],
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'id' => $_SESSION['auth']->id]);
	}

	function checkSubscription($data){
		foreach($data as $key => $value){
			if($key != 'day' && $key != 'month' && $key != 'year'){
				if(strlen($value) < 3){
					return '<p class="warning">The ' . $key . ' must contain at least 3 characters.</p>';
				}
			}
		}
		if(empty($data['day']) || empty($data['month']) || empty($data['year'])){
			return '<p class="warning">Please enter your birth date.</p>';
		}
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			return '<p class="warning">The email format is invalid.</p>';
		}
		if($data['password'] != $data['passwordVerify']){
			return '<p class="warning">Your passwords doesn\'t match.</p>';
		}
		if(strlen($data['password']) < 6){
			return '<p class="warning">Your password must contain at least 6 characters.</p>';
		}
		$query = $this::$pdo->prepare('SELECT * FROM users WHERE login like :login');
		$query->execute(['login' => $data['login']]);
		$user = $query->fetch();
		if($this->exists('SELECT * FROM users WHERE login LIKE :login', array('login' => $data['login']))){
			return '<p class="warning">This login is already used.</p>';
		}
		if($this->exists('SELECT * FROM users WHERE email LIKE :email', array('email' => $data['email']))){
			return '<p class="warning">This email is already used.</p>';
		}
		if(!checkdate($data['month'], $data['day'], $data['year'])){
			return '<p class="warning">Please enter a valid date.</p>';
		}
		$currentDate = getDate();
		if($currentDate['year'] - 18 <= $data['year']){
			if($currentDate['mon'] < $data['month']){
				return '<p class="warning">Sorry, our services are limited to 18+ only.</p>';
			}
			if($currentDate['mon'] == $data['month']){
				if($currentDate['mday'] < $data['day']){
					return '<p class="warning">Sorry, our services are limited to 18+ only.</p>';
				}
			}
		}
		return $this->subscribe($data);
	}

	function subscribe($data){
		$password = password_hash($data['password'], PASSWORD_BCRYPT);
		$birthdate = $data['year'] . '-' . $data['month'] . '-' . $data['day'];
		$query = $this::$pdo->prepare('INSERT INTO users (login, password, email, firstname, lastname, birthdate) VALUES(:login, :password, :email, :firstname, :lastname, :birthdate)');
		$query->execute(['login' => $data['login'],
			'password' => $password,
			'email' => $data['email'],
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'birthdate' => $birthdate]);
		$query = $this::$pdo->prepare('SELECT id FROM users WHERE login LIKE :login');
		$query->execute(['login' => $data['login']]);
		$user_id = $query->fetch()->id;
		$query = $this::$pdo->prepare('INSERT INTO wallet (user_id) VALUES (:user_id)');
		$query->execute(['user_id' => $user_id]);
		return '<p class="success">Subscription validated</p>';
	}

	function checkLength($data){
		if(strlen($data) < 3 || strlen($data) > 20){
			return false;
		}
		return true;
	}

	function checkEmail($email){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return false;
		}
		if($email != $_SESSION['auth']->email){
			if($this->exists('SELECT * FROM users WHERE email LIKE :email', array('email' => $email))){
				return false;
			}
		}
		return true;
	}

	function checkPasswords($password, $passwordVerify){
		if($password !== $passwordVerify){
			return false;
		}
		return true;
	}

	function checkUsername($username){
		if($username != $_SESSION['auth']->login){
			if($this->exists('SELECT * FROM users WHERE login LIKE :login', array('login' => $username))){
				return false;
			}
		}
		return true;
	}
}