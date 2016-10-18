<?php

use Phalcon\Mvc\Controller;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\View;

class SuccessController extends Controller
{

    public function indexAction()
    
    {
		$this->view->step1="";
		$this->view->step2="";
		$this->view->step3="active";
		
		$status = $this->request->getQuery('orderStatusId');
		$session_id = $this->request->getQuery('paymentSessionId');
		
		
		$status_id = 0;
		
		switch($status){
			
			case "100":
				$this->view->status="success";
				$status_id = 1;
				if($this->session->get("success_url")!=""){
					echo "<script>window.parent.location='".$this->session->get("success_url")."';</script>";
					exit;
				}
			break;
			
			case "-90":
				$this->view->status="failed";
				$status_id = 2;
				if($this->session->get("fail_url")!=""){
					echo "<script>window.parent.location='".$this->session->get("fail_url")."';</script>";
					exit;
				}
			break;
			
			case "50":
				$this->view->status="pending";
				$status_id = 3;
			break;
			
			case "85":
				$this->view->status="verify";
				$status_id = 4;
			break;
			
		}
		
		
		$this->db->updateAsDict(
			"transactions",
			array(
				"status"=>$status_id
			),
			"transaction_id=$session_id"
		);
		
		
		//$this->session->destroy(); //destroy session
		$this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
    
    }

}
