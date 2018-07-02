<?php
  
class Upload extends CI_Controller {

   public function __construct() { 
      parent::__construct(); 
      $this->load->helper(array('form', 'url')); 
   }
	
   public function index() {

      $uploads_folder = 'assets/uploadedimages/';

      $config['upload_path']   = './'.$uploads_folder; 
      $config['allowed_types'] = 'jpg|jpeg|png'; 
      $config['max_size']      = 1000; 
      $config['max_width']     = 500; 
      $config['max_height']    = 768;  
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('userfile')) {

         $error_msg = $this->upload->display_errors();

         $content = '{"error":{"status":400,"message":"'.$error_msg.'"}}';
         
      }
		
      else { 

         $data = $this->upload->data(); 
         $photo_url = base_url($uploads_folder.$data['file_name']);

         $content = '{"status_code":"200","data":{"image_url":"'.$photo_url.'"}}';
         
      }
      echo $content;

   }
}
?>