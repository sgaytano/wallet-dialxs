<?php

use Phalcon\Mvc\Controller;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;

class AdminController extends Controller
{

    public function indexAction()
    {
    	
    	if($this->session->get("invalid_login")==true){
    		$this->view->login_alert = "";
    	}else{
    		$this->view->login_alert = "style='display:none;'";
    	}
    }
    
    public function authAction(){
         
    	if ($this->request->isPost()) {

         	$alogin_data = array('username'=>$_POST['username'],'password'=>md5($_POST['password']));
			$rsresult_users = $this->db->fetchAll(
				"SELECT * FROM users  WHERE user=:username AND password=:password",
				Phalcon\Db::FETCH_ASSOC,
				$alogin_data
			);
			
			
			if(count($rsresult_users) !=0) {
				
				$this->session->set("base_url",$this->base_url);
				$this->session->set('username', $rsresult_users[0]['username']);
				$this->session->set('user_logged_in', true);
				
				//redirect to main
				$this->response->redirect('admin/main');
				
			}else{
				
				$this->session->set("invalid_login",true);
				//redirect back
				$this->response->redirect('admin');
			}	
        }	
    }
    
    public function deletesiteAction() {
		$aurl_arr = explode("/",$this->request->getUri());
		$this->db->delete("sites","id=$aurl_arr[3]");
		$this->response->redirect("admin/main");
    }
    
    
    public function addsiteAction() {
    	
		$adata = array(
			'name'=>$this->request->getPost('sitename'),
			'apikey'=>md5(date("Y-m-d H:i:s")),
			'status'=>1
		);
		$this->db->insertAsDict('sites', $adata);
		$this->response->redirect("admin/main");
    }
    
    public function mainAction()
    {
    	if($this->session->get("user_logged_in")!=true){
    		$this->response->redirect('admin');
    	}
    	
		$rsresult_sites = $this->db->fetchAll(
			"SELECT * FROM sites",
			Phalcon\Db::FETCH_ASSOC
		);
		
		$this->view->root_url = $this->session->get("base_url");
		$this->view->sites_list = $rsresult_sites;
    	
    }
    
    
    public function changepasswordAction() {
		$this->db->updateAsDict(
			"users",
			array(
				"password"=>md5($this->request->getPost('newpassword'))
			),
			"id=1"
		);
		$this->response->redirect("admin/main");
    }
    
    public function logoutAction()
    {
    	$this->session->destroy();
    	$this->response->redirect("admin");
    }

}
