<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minisite2 extends CI_Controller
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
        parent::__construct ();
        $this->pdo = $this->load->database('pdo', true );
		$this->load->model('Mini_site_model');
    }

    public function index()
    {
		
        $data ['subtitle'] = "Home";

        $this->load->view( 'minisite2/index', $data );
    }

	  public function about()
    {

        $data ['subtitle'] = "About";


        $this->load->view( 'minisite2/about', $data );
    }


	  public function contact()
    {
		
        $data ['subtitle'] = "Contact";
        $this->load->view( 'minisite2/contact', $data );
    }

  public function overview()
    {
		
        $data ['subtitle'] = "Overview";
        $this->load->view( 'minisite2/overview', $data );
    }
	
	public function trustpass(){
		$data ['subtitle'] = "Trustpass profile";
        $this->load->view( 'minisite2/trustpass', $data );
	  }


 public function category($catName,$catId){
	 $data['subtitle'] =$catName;
	 $data['catId'] =$catId;
     $this->load->view( 'minisite2/productCat', $data );
 }
  public function productDetails($proName,$proId){
	 $data['subtitle'] =$proName;
	 $data['proId'] =$proId;
     $this->load->view( 'minisite2/productDetails', $data );
 }
 public function new()
    {
		
        $data ['subtitle'] = "Home";

        $this->load->view( 'minisite2/index', $data );
    }

}
?>