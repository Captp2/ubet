<?php
class Wallet extends Controller{

	function index(){
		if(isset($_SESSION['auth'])){
			$walletModel = $this->loadModel('Wallet_M');
			$data['history'] = $walletModel->getWalletHistory($_SESSION['auth']->id);
			$data['wallet'] = $walletModel->getWallet($_SESSION['auth']->id);
			$this->render('index', $data);
		}
		else{
			$this->setlayout('denied');
		}
	}

	function payment_validated(){
		$this->render('payment_validated', array());
	}

	function payment_cancelled(){
		$this->render('payment_cancelled', array());
	}

	function payment_validation(){
		$req = 'cmd=_notify-validate';
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
		$id_user = $_POST['custom'];
		if (!$fp) {
			//HTTP error
		} else {
			fputs ($fp, $header . $req);
			while (!feof($fp)) {
				$res = fgets ($fp, 1024);
				if ( $payment_status == "Completed") {
					if ( "liebkrigt@liebkrigt.me" == $receiver_email) {
						$walletModel = $this->loadModel('Wallet_m');
						$walletModel->handleTransaction($this->data);
					}
					else {
// Mauvaise adresse email paypal
					}
				}
				else {
// ID de transaction déjà utilisé
				}
			}
		}
	}
}