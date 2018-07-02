<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct()
    {
        parent::__construct();
        // load the pdo for db connection
         $this->pdo = $this->load->database ( 'pdo', true );
		$this->load->library ( 'session' );
		$this->load->model('Site_model');
    }
	
    public function allCategories(){
        $data ['title'] = "Blazebay::All Categories";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['title'] = "Blazebay";
        $data ['tagline'] = "CALL US :";
        $data ['contact'] = "+254-741-403-640";
        $data ['inCart_count'] = "2";



        $session = array(
            'username'  => 'Sajal Soni',
            'user_id'     => 1,
            'first_name' => '@sajalsoni',
            'email' => '@sajalsoni',
            'second_name' =>'test'
        );
        $user_session= $this->session->set_userdata ( 'userData', $session);

        $this->load->view ( 'pages/allCategories', $data );
    }

    public function categoryDetails(){
        $data ['title'] = "Blazebay";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['title'] = "Blazebay";
        $data ['tagline'] = "CALL US :";
        $data ['contact'] = "+254-741-403-640";
        $data ['inCart_count'] = "2";



        $session = array(
            'username'  => 'Sajal Soni',
            'user_id'     => 1,
            'first_name' => '@sajalsoni',
            'email' => '@sajalsoni',
            'second_name' =>'test'
        );
        $user_session= $this->session->set_userdata ( 'userData', $session);

        $this->load->view ( 'pages/homeWholesaleProducts', $data );
    }
    public function allincategory($group_name=null,$group_id=null){
        $data ['title'] = "Blazebay";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['title'] = "Blazebay";
        $data ['tagline'] = "CALL US :";
        $data ['contact'] = "+254-741-403-640";
        $data ['group_id'] =$group_id;
		$data ['group_name'] =$group_name;

        $this->load->view ( 'pages/categories',$data);
    }

}
?>