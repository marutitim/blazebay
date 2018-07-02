<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    function __construct() {
        parent::__construct ();
        // load the pdo for db connection
        $this->pdo = $this->load->database ( 'pdo', true );
       $this->load->model('Site_model');
    }
	public function index()
	{

        $data ['title'] = "Blazebay";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['title'] = "Blazebay";
        $data ['tagline'] = "CALL US :";
        $data ['contact'] = "+254-741-403-640";
        $data ['inCart_count'] = "2";
        $data ['featuredProducts'] = $this->Site_model->getFeaturedProducts();
		$data ['wholesale_products_list'] = $this->Site_model->getwholesaleProducts();
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
        $where=" `p`.`approved` = 'yes' AND `m`.`suspended` = 'N' AND s.company_logo <>'' ";
        $data ['premium_supplierBrands'] = $this->Site_model->get_allActive_supplierList(30,$where);
        $where="pid = 0 AND status = \"Y\" AND trending =\"1\" ORDER BY RAND() limit 12 ";
        $data ['trade_categories_details'] = $this->Site_model->getDataById($table = "bt_categories", $where );

        $session = array(
            'username'  => 'Sajal Soni',
            'user_id'     => 1,
            'first_name' => '@sajalsoni',
            'email' => '@sajalsoni',
            'second_name' =>'test'
        );
        $user_session= $this->session->set_userdata ( 'userData', $session);

        $this->load->view ( 'index', $data );
	}

}
