<?php

use Phalcon\Mvc\Controller;
use Phalcon\Di\Injectable;

class PaymentController extends Controller
{

    public function indexAction()
    {
		$this->view->step1="";
		$this->view->step2="active";
		$this->view->step3="";
		
		if( empty($this->session->get("user_cart")) ){
			$this->response->redirect("success");
			echo "Session Expired!";
			exit;
		}
		
		//echo $this->session->get("user_cart");
		///echo "<br/>";
		$mode_payment = explode("-",$this->request->getPost('mode_payment'));
		//echo count($mode_payment);
		//echo "<br/>";
		$payment_mode_has_bank = false;
		if( count( $mode_payment ) !=1 ){
			$payment_mode_has_bank = true;
			//echo "Payment=$mode_payment[0],Bank=$mode_payment[1]";
		}else{
			$payment_mode_has_bank = false;
			//echo "Payment=".$this->request->getPost('mode_payment');
			
		} ; //bank
		
		
		$item_obj = json_decode( $this->session->get("user_cart") );
		
		//echo "<br/>";
		//echo $item_obj->total;
		
		
		require APP_PATH . "/app/vendor/autoload.php";
		\Paynl\Config::setApiToken("10144cd1f9e2077a5169017f4107cfdbd2abc999");
		\Paynl\Config::setServiceId("SL-1227-3610");
		
	    try {
	    	
		    $result = \Paynl\Transaction::start(array(
		        // required
		        'amount' => $item_obj->total,
		        'returnUrl' => "https://wallet.audiotex.nl/success",
		        'paymentProfileId' => $this->request->getPost('mode_payment'),
		        'currency' => 'EUR',
		        'testmode' => 1,
		    	'description'=>$item_obj->description,
		    	'bank'=>$payment_mode_has_bank ? $mode_payment[1] : 0,
		        'ipaddress' => \Paynl\Helper::getIp()
			));
		
		// Save this transactionid and link it to your order
		    $transactionId = $result->getTransactionId();
			$this->view->payment_url = $result->getRedirectUrl();
		    
			$data = array(
				'transaction_id'=>$transactionId,
				'items'=>$this->session->get("user_cart"),
				'total'=>$item_obj->total,
				'status'=>0
			);
			
			$this->db->insertAsDict("transactions",$data);
			
			//echo $result->getRedirectUrl();
		    //exit;
		    //echo '<a href="' . $result->getRedirectUrl() . '">' . $result->getRedirectUrl() . '</a>';
		    //echo "<br />" . $transactionId;
	
		} catch (\Paynl\Error\Error $e) {
			
		    echo "Fout: " . $e->getMessage();
		    exit;
		
		}
	
	
	
    }

}
