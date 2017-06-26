<?php
class Wallet_M extends Model{
	function getWalletHistory($id_user){
		$query = $this::$pdo->prepare('SELECT * FROM wallet_history WHERE user_id = :id_user ORDER BY timestamp DESC');
		$query->execute(['id_user' => $id_user]);
		while($row = $query->fetch()){
			$history[] = $row;
		}
		if($history){
			return $history;
		}
		else{
			return false;
		}
	}

	function getWallet($id_user){
		$query = $this::$pdo->prepare('SELECT * FROM wallet WHERE user_id = :id_user');
		$query->execute(['id_user' => $id_user]);
		$wallet = $query->fetch();
		return $wallet;
	}		

	function handleTransaction($data){
		$params['transaction_id'] = $data['ipn_track_id'];
		$params['user_id'] = $data['custom'];
		$params['wallet_id'] = $this->getWallet($params['user_id'])->id;
		$params['amount'] = $data['mc_gross'];
		if(!$this->transactionExists($params['transaction_id'])){
			$query = $this::$pdo->prepare('INSERT INTO wallet_history (wallet_id, amount, user_id, transaction_id) VALUES (:wallet_id, :amount, :user_id, :transaction_id)');
			$query->execute($params);
			$wallet = $this->getWallet($params['user_id']);
			$total = $wallet->balance;
			$total += $params['amount'];
			$this->setWalletBalance($wallet->id, $total);
			$log = fopen(ROOT.'transactions_log/'.$params['transaction_id'], 'a+');
			fwrite($log, "TRANSACTION----------------------------------------------\n");
			foreach($data as $key => $data){
				fwrite($log, "$key  ::  $data\n");
			}
			fclose($log);
		}
		else{
		}
	}

	function transactionExists($id){
		$query = $this::$pdo->prepare('SELECT * from wallet_history WHERE transaction_id=:id');
		$query->execute(['id' => $id]);
		return $query->fetch();
	}

	function setWalletBalance($id, $balance){
		$query = $this::$pdo->prepare('UPDATE wallet SET balance=:balance WHERE id=:id');
		$query->execute(['balance' => $balance,
			'id' => $id]);
	}
}