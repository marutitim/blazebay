<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minisite extends CI_Controller
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
        $this->load->model('Site_model');
		$this->load->library('image_lib');
		$this->load->library ( 'session' );
        $this->load->library('user_agent');
    }

    public function index($page=null,$pageId=null)
    {
        $data ['subtitle'] = "Home";
        $data ['title'] = "Home";
        $data ['name'] = "Home";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['active'] ='home';
        $this->load->view( 'minisite/index', $data );
    }


    function supplierProducts($page=null,$pageId=null){


        $data ['page'] = $pageId;
        $data ['Getpage'] = $pageId;
        $data ['active'] ='home';
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
        $this->load->view ( 'minisite/index', $data );
    }

	  public function about()
    {
		
        $data ['subtitle'] = "About";


        $this->load->view( 'minisite/aboutus', $data );
    }


	  public function contact()
    {
		
        $data ['subtitle'] = "Contact";
        $data ['title'] = "Contact";
        $data ['name'] ="Contact";
        $data ['active'] ='contact';
        $this->load->view( 'minisite/minisite-contact', $data );
    }

  public function overview()
    {
		
        $data ['subtitle'] = "company Profile";
        $data ['title'] = "company Profile";
        $data ['name'] ="company Profile";
        $data ['active'] ='overview';
        $this->load->view( 'minisite/overview', $data );
    }
	   public function newm()
    {
		
        $data ['subtitle'] = "Home";

        $this->load->view( 'minisite/minisite', $data );
    }
	
	public function trustpass(){
		$data ['subtitle'] = "Trustpass profile";
        $this->load->view( 'minisite/trustpass', $data );
	  }


 public function category($catName=null,$catId=null,$page=null,$pageId=null){
	 $data['subtitle'] =$catName;
	 $data['catId'] =$catId;
     $data ['active'] ='category';
     $data ['Getpage'] = $pageId;
     $data ['getcid'] =$pageId;
     $data ['title'] =$catName;
     $this->load->view( 'minisite/category', $data );
 }
  public function productDetails($proName,$proId){
	 $data['subtitle'] =$proName;
	 $data['proId'] =$proId;
     $this->load->view( 'minisite/product_details', $data );
 }
  public function productDetails2($proName,$proId){
	 $data['subtitle'] =$proName;
	 $data['proId'] =$proId;
     $this->load->view( 'minisite/product_details2', $data );
 }
// public function newsite()
//    {
//
//        $data ['subtitle'] = "Home";
//
//        $this->load->view( 'minisite2/index', $data );
//    }

	 public function send_inquiry()
    {
		
        $data ['subtitle'] = "Send Inquiry";

        $this->load->view( 'minisite/send_inquiry', $data );
    }
	
	
	public function cat_list($catName,$catId,$page=null,$pageId=null){
		$data['subtitle'] =$catName;
	    $data['catId'] =$catId;
		$data ['page'] = $page;
		$data ['Getpage'] = $pageId;
		
	$this->load->view ( 'minisite/category', $data );	
	}
		public function postInquiry(){
	    $data['message'] ='<div class="alert alert-success alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Success!</strong> Your Inquiry has been send successfully.
						</div>';
			
		$enq_name = $_POST['enq_name'];
		$enq_email = $_POST['enq_email'];
		$enq_phone = $_POST['enq_phone'];
		$enq_subject = htmlentities($_POST['enq_subject']);
		$enq_message = htmlentities($_POST['enq_message']);
		$supplier_id = $_POST['supplier_id'];
		
		$enq_product="";
		$user_ip="";
		  $supplier_data=$this->Mini_site_model->getDataById('bt_business',"id='$supplier_id'"); 	
	       $supplieremail=$supplier_data[0]['email'];
		   $user_id=$supplier_data[0]['user_id'];
		if(isset($_SERVER['REMOTE_ADDR'])){$user_ip=$_SERVER['REMOTE_ADDR'];}

		$enquire_data = array(
			'message'  => $enq_message,
			'email'    => $enq_email,
			'phone'    => $enq_phone,
			'prod_id'  => "",
			'receiver_id'  =>$user_id,
			'full_name'=>$enq_name,
			'subject'  => $enq_subject,
			'user_ip'  => $user_ip
		);
    
	 
      $enquired_return = $this->Mini_site_model->add('bt_enquiry', $enquire_data);
	  
	 
	  //enquiry mail
	  $orderDetails= array(

		'user_id' => "",

		'sender' => $enq_email,

		'receiver' =>$supplieremail ,

		'subject' =>$enq_subject,

		'message' => $enq_message,

		'status' =>0
		);
	 $this->Mini_site_model->add("bt_emails", $orderDetails);
		
	$this->load->view ( 'minisite/send_inquiry_success', $data );	
	}
	
	public function subscribe(){
	$data ['title'] ='';
    $data['message'] ='<div class="alert alert-success alert-dismissable">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>Success!</strong> You have subscribed successfully.
					</div>';
	$this->load->view ( 'minisite/index', $data );		
	}

}
?>