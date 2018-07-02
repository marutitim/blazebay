<?php
  
class Mpesa extends CI_Controller {

   public function __construct() { 
      parent::__construct(); 
         $this->pdo = $this->load->database('pdo', true );
		$this->load->model('Mini_site_model');
		$this->load->library('image_lib');
		$this->load->library ( 'session' );
   }
	
   public function mpesaPaymentCallBack() {
	    $url = ''; 
		$characters = json_decode($data);
	    $data = json_decode(file_get_contents('php://input'), true);
		$id = $this->input->post('productDetails');
 }
}
?>