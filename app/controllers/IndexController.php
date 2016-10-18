<?php

use Phalcon\Mvc\Controller;
use Phalcon\Di\Injectable;

class IndexController extends Controller
{

    public function indexAction()
    {
    	require APP_PATH . "/app/vendor/autoload.php";
    	$this->view->root_url = $this->base_url;
    		
    	if( $this->request->getQuery('cartItems') ) {
    		
    		$jstring = urldecode($this->request->getQuery('cartItems'));
    		$items_obj = json_decode($jstring);
    		
    		//echo "successURL=". $items_obj->successurl;
    		//echo "<br/>";
    		//echo "failedURL=". $items_obj->failurl;
    		//exit;
    		
         	$init_data = array('apikey'=>$items_obj->apikey);
			
         	$key_results = $this->db->fetchAll(
				"SELECT * FROM sites WHERE apikey=:apikey",
				Phalcon\Db::FETCH_ASSOC,
				$init_data
			);
			
			if(count($key_results) !=0) {

	    		$this->session->set("user_cart",$jstring);
	    		
	    		//callback urls
	    		$this->session->set("success_url",$items_obj->successurl);
	    		$this->session->set("fail_url",$items_obj->failurl);
	    		
				\Paynl\Config::setApiToken("10144cd1f9e2077a5169017f4107cfdbd2abc999");
				\Paynl\Config::setServiceId("SL-1227-3610");
				
				$paymentMethods = \Paynl\Paymentmethods::getList();
				$this->view->bank_list = $paymentMethods;
				
				$this->view->cart = $items_obj->cart;
				$this->view->total = $items_obj->total;
				$this->view->desc = $items_obj->description;
				
				$this->view->step1="active";
				$this->view->step2="";
				$this->view->step3=""; 
				$this->view->disablecontent = false;
			
			} else{
				
	    		$this->view->step1="";
				$this->view->step2="";
				$this->view->step3="";
				$this->view->disablecontent = true;

			}
			   		
    	}else{
    		
    		
    		$this->view->step1="";
			$this->view->step2="";
			$this->view->step3="";
			$this->view->disablecontent = true;
			
    		echo "<p>Sorry were unable to process your request.</p>";
    		
    		//$jstring = '{"cart":[{"item":"Sample Item 1","price":"10"},{"item":"Sample Item 2","price":"5"}],"total":"15","description":"Sold Items"}';
    	}
		
    	
    	
		/*
			{
				"cart": [{
						"item": "Item 1",
						"price": "10"
					}, {
						"item": "Item 2",
						"price": "5"
					}
			
				],
				"total":"15,0",
				"description":"Sold Items",
				"apikey":"c560e1a31f6c191aaefac36d9e9870b9",
				"successurl":"https://127.0.0.1/wallet/sucess",
				"failurl":"https://127.0.0.1/wallet/success"
			}	
		*/
		// encode: %7B%0D%0A%09%22cart%22%3A+%5B%7B%0D%0A%09%09%09%22item%22%3A+%22Item+1%22%2C%0D%0A%09%09%09%22price%22%3A+%2210%22%0D%0A%09%09%7D%2C+%7B%0D%0A%09%09%09%22item%22%3A+%22Item+2%22%2C%0D%0A%09%09%09%22price%22%3A+%225%22%0D%0A%09%09%7D%0D%0A%0D%0A%09%5D%2C%0D%0A%09%22total%22%3A+%2215%2C0%22%2C%0D%0A%09%22description%22%3A+%22Sold+Items%22%2C%0D%0A%09%22apikey%22%3A+%22c560e1a31f6c191aaefac36d9e9870b9%22%0D%0A%7D
		
		//echo "<pre>";
		//print_r($items_obj);
		//echo "</pre>";
		
		//exit;
    	
		//$this->response->redirect('login');
		/*		
		require 'vendor/autoload.php';
		

		\Paynl\Config::setApiToken("10144cd1f9e2077a5169017f4107cfdbd2abc999");
		\Paynl\Config::setServiceId("SL-1227-3610");
		
		$paymentMethods = \Paynl\Paymentmethods::getList();
		var_dump($paymentMethods);
		//echo "sherwin!";

		
		# Setup API URL
		$strURL =  "https://rest-api.pay.nl/v5/Transaction/start/json?";
		 
		# Add arguments
		$arrArguments['token']='10144cd1f9e2077a5169017f4107cfdbd2abc999';
		$arrArguments['serviceId']='SL-1227-3610';
		$arrArguments['amount']=123;
		$arrArguments['finishUrl']='http://www.audiotex.nl';
		$arrArguments['paymentProfileId']=706;
		$arrArguments['ipAddress']='127.0.0.1';
		$arrArguments['transaction']['description']='T-123';
		 
		# Prepare and call API URL
		$strURL .= http_build_query($arrArguments);
		$JsonResult = @file_get_contents($strURL);
		echo "sherwin!!!=".$strURL;
		//echo $JsonResult;
		$obj = json_decode($JsonResult);
		echo "url=".$obj->transaction->paymentURL;
		
		print_r($obj);
		*/

		
    }

}

