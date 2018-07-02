<?php
    /*
	 * @Author Timothy
	 * Date 9-11-2017
	*/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include (APPPATH.'libraries/REST_Controller.php');
class AppApi extends REST_Controller {
	function __construct() {
		parent::__construct ();
		// load the pdo for db connection
        $this->pdo = $this->load->database ( 'pdo', true );
		$this->load->model('Site_model');
	 }
	function loginUser_post(){
		$username= $this->post('username');
		$password=md5( $this->post('password'));
		
		$username='modan3@yahoo.com';
		$password=md5('modan464011277');
		$where = "(username = '" . $username . "' OR email = '".$username."') AND password = '" . $password . "'";
		$checklogin= $this->Site_model->getDataById( 'bt_members', $where );
        if (! empty ($checklogin)) {
                $loginData ['username'] = $checklogin [0]['username'] ;
                $loginData ['role'] = $checklogin [0] ['usertype'];
                $loginData ['password'] = $checklogin [0] ['password'];
                $loginData ['firstName'] = $checklogin [0] ['firstname'];
                $loginData ['lastName'] = $checklogin [0] ['lastname'];
                $loginData ['email'] =$checklogin [0] ['email'];
                $loginData ['street'] = $checklogin [0] ['street'];
                $loginData ['country'] = $checklogin [0] ['country'];
                $loginData ['state'] = $checklogin [0] ['state'];
                $loginData ['city'] = $checklogin [0] ['city'];
                $loginData ['postal_code'] = $checklogin [0] ['address'];
				$loginData ['phone'] = $checklogin [0] ['phone'];
				$loginData ['mobile'] = $checklogin [0] ['mobile'];
                echo $this->response($resArr, 201);
        }else{
            $resArr['message']='Invalid credentials';
            echo $this->response ( $resArr, 301 );
        }

		
	}
	
}