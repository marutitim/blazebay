<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
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
        // load the pdo for db connection
        $this->pdo = $this->load->database ( 'pdo', true );
		$this->load->helper ( 'form' );
        $this->load->library ('session');
		 $this->load->model('Mini_site_model');
		$this->load->model('Site_model');
        $this->load->library('upload');
        $this->load->library('user_agent');

	
    }


			public function index()
            {
                $data ['active'] = 'home';
                $data ['title'] = "Online  Shopping  for Appliances ,Electronics,Fashion,Food,Drinks ,Hair and more in bulk/Wholesale only on  Blazebay.com";
                $data ['keywords'] = "Ecommerce";
                $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
                $data ['name'] = "shirt";
                $data ['featuredProducts'] = $this->Site_model->getcustomNewProducts();
              //  $data ['featuredProducts'] = $this->Site_model->getFeaturedProducts();
                $data ['ProductsOffers'] = $this->Site_model->getSellOffersProducts();
                $data ['bestsellerProducts'] = $this->Site_model->getwholesaleProducts();
                $data ['wholesale_products_list'] = $this->Site_model->getwholesaleProducts();
                $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
                $data ['premium_supplierBrands'] = $this->Site_model->premium_supplierBrands();
                $data ['newArrival'] = $this->Site_model->newArrival();
                // $data ['newProducts'] = $this->Site_model->getNewProducts();
                $data ['newProducts'] = $this->Site_model->getFeaturedProducts();
                $data ['productsUnder1000'] = $this->Site_model->productsUnder1000();



                if ($this->agent->is_mobile())
                {
                    $this->load->view ( 'mobile/home/index', $data);
                }

                else
                {
                    $this->load->view ( 'index', $data);
                }
         }
    function mobile(){
        $data ['active'] = 'home';
        $data ['title'] = "Online  Shopping  for Appliances ,Electronics,Fashion,Food,Drinks ,Hair and more in bulk/Wholesale only on  Blazebay.com";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['name'] = "shirt";
        $data ['featuredProducts'] = $this->Site_model->getcustomNewProducts();
        //  $data ['featuredProducts'] = $this->Site_model->getFeaturedProducts();
        $data ['ProductsOffers'] = $this->Site_model->getSellOffersProducts();
        $data ['bestsellerProducts'] = $this->Site_model->getwholesaleProducts();
        $data ['wholesale_products_list'] = $this->Site_model->getwholesaleProducts();
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
        $data ['premium_supplierBrands'] = $this->Site_model->premium_supplierBrands();
        $data ['newArrival'] = $this->Site_model->newArrival();
        // $data ['newProducts'] = $this->Site_model->getNewProducts();
        $data ['newProducts'] = $this->Site_model->getFeaturedProducts();
        $data ['productsUnder1000'] = $this->Site_model->productsUnder1000();
        $this->load->view ( 'mobile/home/index',$data);
    }
        public function getCountMessage()
        {
            if (isset($this->session->userdata['logged_in']['user_id'])){
                $user = $this->session->userdata['logged_in']['user_id'];
                $where = "receiver_id=$user AND msg_read=0";
                $msgcount=$this->Site_model->getDataById("bt_enquiry",$where);
                $msgs = count($msgcount);
            }else{
                $msgs=0;
            }
            echo $msgs;
        }

    public function search($page=null,$pageId=null)
    {
        $searchTearm=$_POST['searchText'];
        $category=$_POST['category'];

        if($category==''){
            $data=$this->Site_model->search($searchTearm);
            echo json_encode($data);
        } else{
           $category_name=substr($category,2);


            if($category_name=='Kenya'||$category_name=='USA'|$category_name=='India') {
                $country_id="";
                if($category_name=='Kenya'){
                    $country_id=112;
                }
                else if($category_name=='USA'){
                    $country_id=224;
                }
                else if ($category_name=='India'){
                    $country_id=100;
                }

                $data=$this->Site_model->getCompaniesByCountryId($country_id,$searchTearm);

            }else{
                $group_id="";
                if ($category_name == 'Electronics') {
                    $group_id = '163,346,409,410,942';
                } else if ($category_name == 'Clothing') {
                    $group_id = 50;
                } else if ($category_name == 'Shoes') {
                    $group_id = '239,240,241,242,243,245,246,247,248,249,254,255,256,258,259,260,261,1153';
                } else if ($category_name == 'Watches') {
                    $group_id = '138,155';
                }
                $data=$this->Site_model->getProductsByCatId($group_id,$searchTearm);
            }

            echo json_encode($data);



        }

    }



    public function login(){
        $data ['title'] = "Login";
        $data ['active'] ='Login';
        $data ['name'] ='Login';
        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/aoth/login', $data );
        }

        else
        {
            $this->load->view ( 'pages/aoth/login', $data );
        }


    }
        public function register(){
        $data ['title'] = "Register";
        $data ['active'] ='Login';
        $data ['name'] ='Register';
        if ($this->agent->is_mobile())
        {
        $this->load->view ( 'mobile/aoth/register', $data );
        }

        else
        {
            $this->load->view ( 'pages/aoth/register', $data );
        }


        }

   public function poplogin(){
        $data ['title'] = "Login";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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

       $this->load->view ( 'pages/poplogin', $data );
    }
  
  		public function processlogin($username=null,$password=null) {
		$username=$_POST['username'];
		$password=md5($_POST['password']);

		$data ['title'] = "Login";
		$where = "(username = '" . $username . "' OR email = '".$username."') AND password = '" . $password . "'";
		$rs= $this->Site_model->getDataById( 'bt_members', $where );


		if(!empty($rs)){
			
			if($rs[0]["suspended"]=="N") {
    		$where = "user_id='".$rs[0]["user_id"]."' and `usertype`=2";
			
			$data=array(
			'is_online'=>1
			 );
			 
		    $updateOnline = $this->Site_model->update( 'bt_members',  $data, $where);
       
			//-----------------------------------------------------//

			//@session_name("blazebay");			

			//$rand=random_gen('8');
			$tokenn=$this->generateRandomString();
			$usertokenId=$rs[0]["user_id"];
		   $tokenndata=array(
			'user_id'=>$usertokenId,
			'token'=>$tokenn,
			'active'=>1
			 );
		    $addtoken = $this->Site_model->add( 'bt_tokens',$tokenndata);

			$datetime 				= Date("Y-m-d H:i:s");

			$nowdate 				= $rs[0]["expiry_date"];

			$uid 					= $rs[0]["user_id"];
			$timestmp 	= time();

			//========== New Added User Session Array :Starts ==========

			$logedSESSION = array(

				'user_id' 		=> $rs[0]["user_id"],

				'username' 		=> $rs[0]["username"],

				'email'	   		=> $rs[0]["email"],

				'memtype' 	   	=> $rs[0]["memtype"],

				'usertype' 		=> $rs[0]['usertype'],

				'firstname' 	=> $rs[0]['firstname'],

				'lastname' 		=> $rs[0]['lastname'],
                'lastname' 		=> $rs[0]['lastname'],
                'lastname' 		=> $rs[0]['lastname'],

				'logged_date'	=> $datetime,

				'logged_time'	=> $timestmp,

				'used_platform'	=> "PC",
				'token'=>$tokenn

			);


			 $user_session= $this->session->set_userdata( 'logged_in', $logedSESSION);

			           $data=array(
			'lastlogin'=>date("YmdHis",time())
			);
			$where = "user_id='" . $rs[0]["user_id"]. "'";
			
            $updateUser_details= $this->Site_model->update( 'bt_members',$data,$where);

         $response=$this->session->userdata['logged_in']['usertype'];
			}
			else{
				$response="10";
			}
		}
        else{
            $response="";
        }
	   echo  $response;
	
	}
   public function admin(){
        $data ['title'] = "Login";

        $this->load->view ( 'acadmin/index', $data );
    }
  
     public function adminPages($pagename){
        $data ['title'] = "Login";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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

        $this->load->view ( 'acadmin/'.$pagename, $data );
    }
  
   public function signup(){
      $data ['title'] = "SignUp";
      $data ['name'] ="Signup";
      $data ['active'] ='buyer';
       $this->load->view ( 'pages/aoth/login', $data );
    }
	
    public function wishlist(){
        $data ['title'] = "Wishlist";
        $data ['name'] ="Wishlist";
        $data ['active'] ='buyer';
        if(!isset($this->session->userdata['logged_in']['user_id'])){
            header('location:'.base_url().'login');}
        else{
            $sbq_off="select * from  bt_favourite_list where  type='wishlist' AND
         fev_user_id=".$this->session->userdata['logged_in']['user_id']." ORDER by  fev_add_date DESC LIMIT 6";
            $data ['wishlist']= $this->Site_model->getcountRecods($sbq_off);
            $this->load->view ( 'pages/products/wishlist', $data );
        }

    }
    public function myAccount(){
        $data ['title'] = "My account";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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
    public function myOrders(){
        $data ['title'] = "My Order";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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
    public function myContacts(){
        $data ['title'] = "My Contacts";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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
    public function prod($page=null,$pageId=null){
        $data ['title'] = "Products";
        $data ['wholesell'] = "Products";
        $data ['active'] ='buyer';
        $data ['name'] = "All Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        $this->load->view ( 'pages/products/products', $data );
    }
   public function wholesell($page=null,$pageId=null){
        $data ['title'] = "Wholesellers";
       $data ['wholesell'] = "wholesell";
       $data ['active'] ='wholesale';
       $data ['name'] = "Wholesell Products";
       $data ['Getpage'] = $pageId;
       $data ['getcid'] =$pageId;
       $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
       if ($this->agent->is_mobile())
       {
           $this->load->view ( 'mobile/products/products', $data);
       }

       else
       {
           $this->load->view ( 'pages/products/products', $data );
       }




    }
    public function wholesellsearch($search=null,$page=null,$pageId=null){
        $data ['title'] = "Wholesellers";
        $data ['wholesellsearch'] = "wholesellsearch";

        $data ['wholesalesearch'] =$search;
        $data ['active'] ='wholesale';
        $data ['name'] = "Wholesell Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        $this->load->view ( 'pages/products/products', $data );
    }
    public function wholesellsearchpriceG($search=null,$page=null,$pageId=null){
        $data ['title'] = "Wholesellers";
        $data ['wholesellsearchprice'] = "wholesellsearchprice";
        $data ['price'] ='greaterthan';
        $data ['wholesalesearch'] =$search;
        $data ['active'] ='wholesale';
        $data ['name'] = "Wholesell Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        $this->load->view ( 'pages/products/products', $data );
    }
    public function wholesellsearchpriceL($search=null,$page=null,$pageId=null){
        $data ['title'] = "Wholesellers";
        $data ['wholesellsearchprice'] = "wholesellsearchprice";
        $data ['price'] ='lessthan';
        $data ['wholesalesearch'] =$search;
        $data ['active'] ='wholesale';
        $data ['name'] = "Wholesell Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/products/products', $data);
        }

        else
        {
            $this->load->view ( 'pages/products/products', $data );
        }

    }

    public function allproducts($search=null,$page=null,$pageId=null){
        $data ['title'] = "All products";
        $data ['productsearch'] = "productsearch";
        $data ['price'] ='lessthan';
        $data ['wholesalesearch'] =$search;
        $data ['active'] ='buyer';
        $data ['name'] = "Wholesell Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/products/products', $data);
        }

        else
        {
            $this->load->view ( 'pages/products/products', $data );
        }

    }
    public function allproductsL($search=null,$page=null,$pageId=null){
        $data ['title'] = "All products";
        $data ['productsearchprice'] = "productsearchprice";
        $data ['price'] ='lessthan';
        $data ['wholesalesearch'] =$search;
        $data ['active'] ='buyer';
        $data ['name'] = "Wholesell Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/products/products', $data);
        }

        else
        {
            $this->load->view ( 'pages/products/products', $data );
        }

    }
    public function allproductsG($search=null,$page=null,$pageId=null){
        $data ['title'] = "All products";
        $data ['productsearchprice'] = "productsearchprice";
        $data ['price'] ='lessthan';
        $data ['wholesalesearch'] =$search;
        $data ['active'] ='buyer';
        $data ['name'] = "Wholesell Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/products/products', $data);
        }

        else
        {
            $this->load->view ( 'pages/products/products', $data );
        }

    }

    public function sale_offers_products($search=null,$page=null,$pageId=null){
        $data ['title'] = "Sale offers products";
        $data ['saleproductsearch'] = "saleproductsearch";
        $data ['price'] ='lessthan';
        $data ['wholesalesearch'] =$search;
        $data ['active'] ='offers';
        $data ['name'] = "Wholesell Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/products/products', $data);
        }

        else
        {
            $this->load->view ( 'pages/products/products', $data );
        }

    }
    public function sale_offers_productsL($search=null,$page=null,$pageId=null){
        $data ['title'] = "Sale offers products";
        $data ['saleproductsearchprice'] = "saleproductsearchprice";
        $data ['price'] ='lessthan';
        $data ['wholesalesearch'] =$search;
        $data ['active'] ='offers';
        $data ['name'] = "Wholesell Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/products/products', $data);
        }

        else
        {
            $this->load->view ( 'pages/products/products', $data );
        }

    }
    public function sale_offers_productsG($search=null,$page=null,$pageId=null){
        $data ['title'] = "Sale offers products";
        $data ['saleproductsearchprice'] = "saleproductsearchprice";
        $data ['price'] ='lessthan';
        $data ['wholesalesearch'] =$search;
        $data ['active'] ='offers';
        $data ['name'] = "Wholesell Products";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();

        $this->load->view ( 'pages/products/products', $data );
    }
    public function all_secured_products($page=null,$pageId=null){
        $data ['title'] = "Trade Security";
        $data ['active'] ='buyer';
        $data ['name'] = "Products with Trade security";
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$pageId;
          $this->load->view ( 'trade-security/index', $data );
    }
    public function RemoveBadURLCharaters($str) {
        return mb_strtoupper(preg_replace("/[^0-9a-zA-Z]+/", "-", $str));
    }
 
 public function allcampanies($searterm=null,$company_id=null,$pageId=null){
        $data ['title'] =$this->RemoveBadURLCharaters(ucfirst($searterm));
         $data ['active'] ='buyer';
         $data ['name'] =$this-> RemoveBadURLCharaters(ucfirst($searterm));
         $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
         $data ['Getpage'] = $pageId;
         $data ['getcid'] =$pageId;
        $data ['company_id'] =$company_id;
        $data ['company'] ='company';
        $this->load->view ( 'pages/companies/company-details', $data );
    }
  
 public function searchcompanies($page=null,$pageId=null){
        $data ['title'] = "All Campanies";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['Getpage'] = $pageId;
		$data ['page'] = $page;
        $this->load->view ( 'pages/companies', $data );
    }
     
   public function contact(){
        $data ['title'] = "Contact Us";
       $data ['title'] = "contact";
       $data ['name'] ="contact";
       $data ['active'] ='buyer';

       if ($this->agent->is_mobile())
       {
           $this->load->view ( 'mobile/links/contact', $data );
       }

       else
       {
           $this->load->view ( 'pages/links/contact', $data );
       }
    }
    public function compare(){
        $data ['title'] = "Product Comparison";
        $data ['name'] ="Product Comparison";
        $data ['active'] ='buyer';
        if(!isset($this->session->userdata['logged_in']['user_id'])){
            header('location:'.base_url().'login');}
        else {
            $sbq_off = "select * from  bt_favourite_list where  type='compare' AND
         fev_user_id=" . $this->session->userdata['logged_in']['user_id']." ORDER by  fev_add_date DESC LIMIT 4";
            $data ['wishlist'] = $this->Site_model->getcountRecods($sbq_off);
            $this->load->view('pages/products/compare', $data);
        }
    }

    public function about(){
        $data ['title'] = "About Us";
        $data ['name'] ="About Us";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/links/about-blazebay', $data );
    }
	
	public function sitehelp(){
		$data ['title'] = "Site Help";
        $data ['name'] = "Site Help";
        $data ['active'] ='buyer';
        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/links/help', $data );
        }

        else
        {
            $this->load->view ( 'pages/links/site-help', $data );
        }
	}
    public function blog(){
        $data ['title'] = $this->RemoveBadURLCharaters("Ten Mistakes I Made Shopping on Online Stores");
        $data ['name'] ="Ten Mistakes I Made Shopping on Online Stores";
        $data ['active'] ='home';
        $this->load->view ( 'pages/blog/blog-details', $data );
    }
    public function blog2(){
        $data ['title'] = $this->RemoveBadURLCharaters("The Advantages of Embracing the Small Businesses");
        $data ['name'] ="The Advantages of Embracing the Small Businesses";
        $data ['active'] ='home';
        $this->load->view ( 'pages/blog/blog-details2', $data );
    }
	public function error(){
    $data ['title'] = "Error";
    $data ['name'] = "Error";
    $data ['active'] ='buyer';
	$this->output->set_status_header('404'); 
	$this->load->view ( 'pages/errorPage', $data );	
	}
    public function sellOffers(){
        $data ['title'] = "Sell Offers";
        $data ['name'] ="Sell Offers";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/products/product-offers', $data );
    }
    public function buyOffers($page=null,$pageId=null)
    {
        $data ['title'] = "Buy Offers";
        $data ['name'] =  "Buy Offers";
        $data ['active'] = 'offers';
        $data ['buyoffers'] = 'buyoffers';
        $data ['Getpage'] = $pageId;
        $data ['getcid'] = $pageId;

        $this->load->view('pages/products/products', $data);
    }
    public function buyOfferDetails(){
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
    public function postBuyOffers(){
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

        $this->load->view ( 'myaccount/post_offer', $data );
    }
    public function manageBuyOffers(){
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
    public function postSaleOffers(){
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
    public function post_buy_requirements(){
        $data ['title'] = "Post Buy Requirements";
        $data ['name'] ="Post Buy Requirements";
        $data ['active'] ='postrequirements';
        $this->load->view ( 'pages/post_buy_requirements', $data );
    }
 
    public function sitemapL(){
        $data ['title'] = "Sitemap";

        $data ['name'] ="Sitemap";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/links/sitemap', $data );
    }

    public function success($id=null){
        $data ['title'] = "Sitemap";

        $data ['name'] ="Sitemap";
        $data ['active'] ='buyer';

       $data ['productId'] =$id;
        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/contact-supplier/contact-success', $data);
        }

        else
        {
            $this->load->view ( 'pages/contact-supplier/contact-success', $data );
        }
    }
	
    public function downloads(){
		 $data ['title'] = "Downloads";
        $data ['name'] ="Downloads";
        $data ['active'] ='buyer';

        $this->load->view ( 'pages/links/downloads', $data );
	}

	
	public function successStory(){
        $data ['title'] = "Success Story";
        $data ['name'] = "Success Story";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/links/success-story', $data );
    }
    public function termsAndConditions(){
        $data ['title'] = "Terms And Conditions";
        $data ['name'] ="Terms And Conditions";
        $data ['active'] ='buyer';

        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/links/terms', $data );
        }

        else
        {
            $this->load->view ( 'pages/links/terms', $data );
        }
    }
    public function privacyPolicy(){
        $data ['title'] = "Privacy Policy";
        $data ['name'] ="Privacy Policy";
        $data ['active'] ='buyer';

        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/links/privacy', $data);
        }

        else
        {
            $this->load->view ( 'pages/links/privacy', $data );
        }
    }
    public function tradeSecurity(){
        $data ['title'] = "TradeSecurity";
        $data ['name'] ="TradeSecurity";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/links/trade-services', $data );
    }
    public function feedback(){
        $data ['title'] = "Feedback";
        $data ['name'] ="Feedback";
        $data ['active'] ='buyer';
        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/links/contact', $data );
        }

        else
        {
            $this->load->view ( 'pages/links/contact', $data );
        }
    }
   
   public function quotation(){
        $data ['title'] = "Ask for Qoute";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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

        $this->load->view ( 'pages/requestforQuotation', $data );
    }
   
   public function jobsAndCareer(){
        $data ['title'] = "Jobs And Careers";
       $data ['name'] ="Jobs and careers";
       $data ['active'] ='buyer';

        $this->load->view ( 'pages/links/job-careers', $data );
    }
    public function advertiseWithUs(){
        $data ['title'] = "Advertise with us";
        $data ['name'] ="Advertise with us";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/links/advertise-with-us', $data );
    }

    public function discover_products_and_suppliers(){
        $data ['title'] = "Industries and Suppliers";
        $data ['name'] ="Industries and Suppliers";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/companies/industries-and-suppliers', $data );
    }
    public function partner_with_us(){
        $data ['title'] = "Partner With Us";
        $data ['name'] ="Partner With Us";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/links/patner-with-us', $data );
    }
    public function learningCenter(){
        $data ['title'] = "Learning center";
        $data ['name'] ="Learning center";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/links/learning-center', $data );
    }
    public function howItWorks(){
        $data ['title'] = "How It Works";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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

        $this->load->view ( 'pages/howItWorks', $data );
    }
    public function manageOrdersOnline(){
        $data ['title'] = "Manage Orders Online";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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
    public function requestforQuotation(){
        $data ['title'] = "Request for Quotation";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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
    public function wholesale(){
        $data ['title'] = "Wholesale";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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
    public function subscription(){
        $data ['title'] = "Subscription";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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
    public function tradeDetails(){
        $data ['title'] = "TradeDetails";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
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
    public function sellerByCountry(){
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
    public function sellerByCountryAll(){
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
    function myTransactions(){
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
    function securePayment(){
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
    function faq(){
        $data ['title'] = "Faq";
        $data ['name'] = "Faq";
        $data ['active'] ='buyer';
        $this->load->view ( 'pages/links/faq', $data );
    }

    function refund_Return(){
        $data ['title'] = "Free & easy returns";
        $data ['name'] ="Free & easy returns";
        $data ['active'] ='buyer';

        $this->load->view ( 'pages/links/return-refund', $data );
    }
	     function dashboard(){
             if(!isset($this->session->userdata['logged_in'])){
                 header('location:'.base_url().'login');
             } else {
                 $data ['title'] = "My account";

                 $where= "uid=".$this->session->userdata['logged_in']['user_id'];
                 $data ['product_count']= $this->Site_model->getDataById('bt_products',$where);

                 $where= "receiver_id=".$this->session->userdata['logged_in']['user_id'];
                 $data ['enquiry_count']= $this->Site_model->getDataById('bt_enquiry',$where);

                 $where= "user_id=".$this->session->userdata['logged_in']['user_id'];
                 $data ['trade_count']= $this->Site_model->getDataById('bt_tradeshow',$where);

                 if($this->session->userdata['logged_in']['usertype']==2){
                     $where= "supplier_id=".$this->session->userdata['logged_in']['user_id'];
                     $data ['order_count']= $this->Site_model->getDataById('bt_order_supplier',$where);

                 }else if($this->session->userdata['logged_in']['usertype']==1){
                     $where= "customer_id=".$this->session->userdata['logged_in']['user_id'];
                     $data ['order_count']= $this->Site_model->getDataById('bt_order',$where);

//                     $where= "customer_id=".$this->session->userdata['logged_in']['user_id'];
//                     $data ['pendding_order_count']= $this->Site_model->getDataById('bt_order_supplier',$where);
                 }else{
                     $data ['order_count']=0;
                 }

                 $data ['name'] = "My account";
                 if ($this->session->userdata['logged_in']['usertype'] == 2) {
                     $data ['active'] = 'forsupplier';
                 } else {
                     $data ['active'] = 'myblazebay';
                 }

                 $data['active2'] = "profile";


                 if ($this->agent->is_mobile())
                 {
                     $this->load->view('mobile/dashboard/dashboard', $data);
                 }

                 else
                 {
                     $this->load->view('dashboard/index', $data);
                 }
             }
     }

	 function logout(){
		    $this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('memtype');
			$this->session->unset_userdata('usertype');
			$this->session->unset_userdata('firstname');
			$this->session->unset_userdata('lastname');
			$this->session->unset_userdata('logged_date');
			$this->session->unset_userdata('used_platform');
			$this->session->sess_destroy();

         $data=array(
             'is_online'=>0,
             'lastlogin'=>0
         );

         $where = "user_id=" . $this->session->userdata['logged_in']['user_id'];
         $updateOnline = $this->Site_model->update( 'bt_members',  $data, $where);

         redirect(base_url(),'refresh');
	 }
	 
	 function forgot_password(){
		 $data ['title'] = "Forgot Password";
         $data ['active'] = "myblazebay";
         $data ['name'] = "Forgot Password";

         if ($this->agent->is_mobile())
         {
             $this->load->view ( 'mobile/aoth/forgot-password', $data );
         }

         else
         {
             $this->load->view ( 'pages/aoth/forgot-password', $data );
         }
	 }
	 
	function reset_email(){
		 $_SESSION['captcha'] = mt_rand(10000, 99999);

     if(isset($_POST['email'])) {

   
	$where="WHERE email = '" . $_POST['email'] . "'";
	$rs_query= $this->Site_model->getDataById( 'bt_members', $where );


    if(!empty($rs_query)){
		$rs=$rs_query[0]; 
        if($rs["suspended"]=="N") {

            $key = '';

            $keys = array_merge(range(0, 9), range('a', 'z'));

            for ($i = 0; $i < 10; $i++) {

                $key .= $keys[array_rand($keys)];

            }

            $new_pass=md5($key);

            $id=$rs["user_id"];

          //  $sql = "update " . $prev. "members set `password`='".$new_pass."' WHERE user_id = '" .$id. "'" ;

			$where="WHERE email = '" . $_POST['email'] . "'";
			$data=array(
			 'password'=>$new_pass
			);
	        $rs_query= $this->Site_model->update( 'bt_members',$data, $where );

            //$rs_query=mysql_query($sql);

			//$setting = getRowData($prev.'setting',"*","id = '1'");
            $where=" id = '1'";
			$setting= $this->Site_model->getDataById( 'bt_setting', $where );
			$logo = base_url().'images/logo/'.$setting[0]['site_logo'];

			//$site_name = $setting['site_title'];

			$site_name = $dotcom;

            $site_name = strtolower($site_name);

            $to = $_POST['email'];

            $subject = "Your New Password{@SITE_NAME}";

			$subject = str_replace("{@SITE_NAME}", $site_name, $subject);

            //$txt = "Hello ".$_POST['email']." . Your new Password is ".$key;

			$msg = file_get_contents(APPPATH."/views/pages/mailtemplates/forgot_password.txt");



			$msg = str_replace("{@EMAIL}", $_POST['email'], $msg);

			$msg = str_replace("{@PASS}", $key, $msg);



			$msg = str_replace("{@SITENAME}", $site_name, $msg); 

			$msg = str_replace("{@SITELOGO_VPATH}", $logo, $msg);

			

			$headers = "MIME-Version: 1.0" . "\r\n";

			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			

            $headers .= "From: $site_name <" . $setting[0]['account_email']. ">\r\n";

			$headers .= "Cc: $site_name <" . $setting[0]['account_email'] . "> \r\n";

			

            mail($to,$subject,$msg,$headers);

            $msg="<font color=green>Please check your email inbox or spam for new password.</font>";

        } else {

            $msg="<font color=red>Your account has been suspended. Please contact " . ucwords('Blazebay.com') . " Support.</font>";

        }

    }else{

        $msg="<font color=red>Invalid Email and Password.</font>";

    } 

} 
echo  $msg;

	 }

	 
	 function reset_email_ajax(){
		 


		//$isAvailable = TRUE;

		$email = $_POST['email'];

	
     $where="email='".$email."'";
	 $rsd = $this->Site_model->getDataById($table='bt_members', $where);//returns 0 if email not already exists

	





	   	$msg1 = preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{1,})+$|i', $email);



	    	if(!empty($rsd) && $msg1 == 1){



				$isAvailable = TRUE;



			} 

			if (empty($rsd)&& $msg1 == 1) 

			{



				$isAvailable = FALSE;



			}



		echo json_encode(array(

		    'valid' => $isAvailable,

		));
	 }

	function edit_profile(){
		if(!isset($this->session->userdata['logged_in']['user_id'])){
			header('location:'.base_url().'login');}
			else{
		 $data['title'] = "Edit profile";
         $data['active'] = "myblazebay";
         $data['name'] =  "Edit profile";
         $data['active2'] = "profile";


                if ($this->agent->is_mobile())
                {
                    $this->load->view ( 'mobile/dashboard/profile', $data);
                }

                else
                {
                    $this->load->view ( 'dashboard/myaccount/editmember', $data );
                }

            }
	}
	function manage_buy_offers(){

        if(!isset($this->session->userdata['logged_in']['user_id'])){
            header('location:'.base_url().'login');}
        else {

            $data ['title'] = "Manage Buy Offers";
            $data['active'] = "myblazebay";
            $data['name'] = "Manage Buy Offers";
            $data['active2'] = "buyoffer";
            $this->load->view('dashboard/buy-offers/manage_offers_buy', $data);

        }
	}
		function post_buy_offers(){
			 $data ['title'] = "Post Buy Offers";
            $data['active'] = "myblazebay";
            $data['name'] =  "Post Buy Offers";
            $data['active2'] = "buyoffer";
            $this->load->view ( 'dashboard/buy-offers/post_offer_buy', $data );
	}
	
      function post_product(){
          if(!isset($this->session->userdata['logged_in']['user_id'])){
              header('location:'.base_url().'login');}
          else {
              $data['title'] = "Post Product";
              $data['active'] = "forsupplier";
              $data['name'] = "Post Product";
              $data['active2'] = "pproducts";

              $this->load->view('dashboard/product-mgt/post_product', $data);
          }
	  }

	function add_new_other_brand($brand_name="", $added_by_user="") {

		$prev="bt_";

		$masterBrandTable = $prev."master_brands";

		$timestamp = time();



		$returnData = 0;

		if(!empty($brand_name)){



			//added by user data

			$added_user_id = $added_by_user;

			//insert new brand as inactive

            $posted_brand_name = trim($brand_name);

			$posted_brand_slug = $posted_brand_name;

            $newBrand_data = array(

                'brand_name'    	=> $posted_brand_name,

                'brand_slug'    	=> $posted_brand_slug,

                'brand_status'		=> 'N',

                'brand_premium'		=> 'N',

                'brand_other'		=> '1',

                'brand_other_uid'	=> $added_user_id,

                'brand_created'		=> $timestamp,   

            );

            $inserted =$this->Site_model->add($masterBrandTable, $newBrand_data);

            if($inserted){

                //making slug2

                $posted_brand_slug2 = $inserted.'-'.$posted_brand_slug;

                //updating slug2

                $aftrInsrt_updt = array(

                	'brand_slug2' => $posted_brand_slug2, 

            	);

                $updated = $this->Site_model->update($masterBrandTable, $aftrInsrt_updt , "brand_id ='$inserted'");

            }

            $product_brand_id = $inserted;

            $returnData = $product_brand_id;

		} 

		

		return $returnData;

	}





   function supplier_orderlist(){
       if(!isset($this->session->userdata['logged_in']['user_id'])){
           header('location:'.base_url().'login');}
       else {
           $data ['name'] = "Supplier Orders";
           $data ['active'] = 'forsupplier';
           $data ['active2'] = 'offers';
           $this->load->view('dashboard/order-mgt/supplier_orderlist', $data);
       }
	  }
	  function sale_offers($page=null,$pageId=null){
          $data ['title'] = "Sell Offers";
          $data ['name'] ="Sell Offers";
          $data ['active'] ='offers';
          $data ['selloffers'] ='selloffers';
          $data ['Getpage'] = $pageId;
          $data ['getcid'] =$pageId;

          if ($this->agent->is_mobile())
          {
              $this->load->view ( 'mobile/products/products', $data);
          }

          else
          {
              $this->load->view ( 'pages/products/products', $data );
          }
	  }
	  
	  function buy_offers(){
		 $this->load->view ( 'pages/buyOffers'); 
	  }
	  
	  function supplier_transactions(){
		 $this->load->view ( 'myaccount/supplier_transactions');   
	  }
  function buyer_orderlist(){
      $data['title'] ="Order List";
      $data['active'] = "myblazebay";
      $data['name'] =  "Order List";
      $data['active2'] = "orders";



      if ($this->agent->is_mobile())
      {
          $this->load->view ( 'mobile/dashboard/orderList',$data);
      }

      else
      {
          $this->load->view ( 'dashboard/order-mgt/buyer_orderlist',$data);
      }

  }
  function favorite_list(){
	 $data ['title'] = "Favourite List";
       if(!isset($this->session->userdata['logged_in']['user_id'])){
			header('location:'.base_url().'login');}
			else{
         $this->load->view ( 'myaccount/favorite_list', $data );
			}		 
  }
  
  function buyer_transactions(){
      if(!isset($this->session->userdata['logged_in']['user_id'])){
          header('location:'.base_url().'login');}
      else {
          $data ['title'] = "Buyer Transactions";
          $data['active'] = "myblazebay";
          $data['name'] = "Buyer Transactions";
          $data['active2'] = "transactions";
          $this->load->view('dashboard/transaction-mgt/buyer_transactions', $data);
      }
  }

  function send_new_message(){
	  
      $data ['title'] = "Send New Message";
      $data['active'] = "myblazebay";
      $data['name'] =  "Send New Message";
      $data['active2'] = "messages";

         $this->load->view ( 'dashboard/my-messages/send_new_message', $data );
  }
  
  function check_messages(){
	  
	  	 $data ['title'] = "Check Message";
      $data['active'] = "myblazebay";
      $data['name'] =  "Check Message";
      $data['active2'] = "messages";
         $this->load->view ( 'dashboard/my-messages/show_messages', $data );
  }

  function my_contacts(){

      if(!isset($this->session->userdata['logged_in']['user_id'])){
          header('location:'.base_url().'login');}
      else {
          $data ['title'] = "My Contact";
          $data['active'] = "myblazebay";
          $data['name'] = "My Contact";
          $data['active2'] = "messages";
          $this->load->view('dashboard/my-messages/show_contacts', $data);
      }
  }

  function enquiries_received(){
      if(!isset($this->session->userdata['logged_in']['user_id'])){
          header('location:'.base_url().'login');}
      else {
          $data ['title'] = "Enquries Recieved";
          $data['active'] = "myblazebay";
          $data['name'] = "Enquries Recieved";
          $data['active2'] = "enquiries";
          $this->load->view('dashboard/my-enquiries/my_enquiries_receive_list', $data);
      }
  }
    function reply_enquiries_received($replyId){
        $data ['title'] = "Reply to Enquiries received";
        $data['active'] = "myblazebay";
        $data['name'] = "Reply to Enquiries received";
        $data['active2'] = "enquiries";
        $data['replyId'] =$replyId;
        $this->load->view ( 'dashboard/my-enquiries/enquiryreply', $data );
  }
  
  function enquiries_sent(){
      $data ['title'] = "Enquiries Sent";
      $data['active'] = "myblazebay";
      $data['name'] =  "Send New Message";
      $data['active2'] = "enquiries";
         $this->load->view ( 'dashboard/my-enquiries/my_enquiries_sent_list', $data );
  }
  
    function change_password (){
        if(!isset($this->session->userdata['logged_in']['user_id'])){
            header('location:'.base_url().'login');}
        else {
            $data ['title'] = "Change Password";
            $data['active'] = "myblazebay";
            $data['name'] = "Change Password";
            $data['active2'] = "accountchange";

            if ($this->agent->is_mobile())
            {
                $this->load->view ( 'mobile/dashboard/change-password', $data);
            }

            else
            {
                $this->load->view('dashboard/myaccount/changepassword', $data);
            }

        }
}
	 
	 function view_buyer_order($id){
		 $data['title']="Order";
		 $data['order_id']=$id;
         $data['active'] = "myblazebay";
         $data['name'] =  "Order List";
         $data['active2'] = "orders";
		 $this->load->view ('dashboard/order-mgt/order-details', $data );
	 }
	 
	 function upgrade_courier_membership(){
		$this->load->view ( 'myaccount/upgrade_courier_membership');  
	 }
	 
	 function edit_companyprofile(){
		 $data['title']="Edit companyprofile";
         $data['active'] = "forsupplier";
         $data['name'] =  "Edit companyprofile";
         $data['active2'] = "company";
			$this->load->view ( 'dashboard/company-mgt/companyprofile',$data);
	 }
	 
	 function courier_transactions(){
		  $data['title']="Transactions";
		 $this->load->view ('myaccount/courier_transactions');
	 }
	  function post_photo(){
		   $data['title']="Edit Banner";
          $data['active'] = "forsupplier";
          $data['name'] =  "Edit Banner";
          $data['active2'] = "company";
        $this->load->view ('dashboard/company-mgt/add_photo',$data);
	 }
	 
	 
	 function post_company_location(){
		 $data['title']="Edit Company location";
         $data['active'] = "forsupplier";
         $data['name'] =  "Edit Company location";
         $data['active2'] = "company";
	$this->load->view ('dashboard/company-mgt/add_com_location',$data);
	 }
	 
	 function courier_orderlist(){	
	     $data['title']="Order List";
         $data['active'] = "forcourier";
         $data['name'] =  "Order List";
         $data['active2'] = "corderlist";
	     $this->load->view ('dashboard/courier-mgt/courier_orderlist',$data);
	 }
	 function courier_view_quotation($quoteid){
		 $data['order_id']=$quoteid;
         $data['title']="View Courier Quotation";
         $data['active'] = "forcourier";
         $data['name'] =  "View Courier Quotation";
         $data['active2'] = "corderlist";
		 $this->load->view ('dashboard/courier-mgt/viewcourier_qutation',$data);
	 }
	 
	 function manage_trades(){
         $data['title']="Manage Tradeshows";
         $data ['name'] ="Manage Tradeshows";
         $data ['active'] ='buyer';
         $data ['active2'] ='trade';
         if(!isset($this->session->userdata['logged_in']['user_id'])){
             header('location:'.base_url().'login');}
         else {
             $this->load->view('dashboard/trade-mgt/manage_trades',$data);
         }
	 }
	 
	 function trade_details($name=null,$id=null){
		 $data['name']=$name;
		 $data['id']=$id;
         $data['title']=$name;
         $data ['name'] =$name;
         $data ['active'] ='buyer';

         $this->load->view ('pages/links/trade-details',$data);
	 }
	 function trade_all(){
		 $this->load->view ('myaccount/trade_all'); 
	 }

	  function post_tradeshow(){
          $data['title']="Post Tradeshows";
          $data ['name'] ="Post Tradeshows";
          $data ['active'] ='buyer';
          $data ['active2'] ='trade';
          if(!isset($this->session->userdata['logged_in']['user_id'])){
              header('location:'.base_url().'login');}
          else {
              $this->load->view('dashboard/trade-mgt/add_tradeshow',$data);
          }
	 }
	 
	   function courier_locations(){
           $data['title']="Courier location";
           $data['active'] = "forcourier";
           $data['name'] =  "Courier location";
           $data['active2'] = "cloction";
		 $this->load->view ('dashboard/courier-mgt/courier_locations',$data);
	 }
	 function upgrade_membership(){
		 $data ['title'] = "Upgrade membership";
		 $this->load->view ('myaccount/upgrade_membership',$data); 
	 }
	 function upgrade_membership_payment($premiumbutton=null){
		   $data['premiumbutton']=$premiumbutton;
		 $this->load->view ('myaccount/payment',$data); 
	 }
	 function minisite_banners(){
         if(!isset($this->session->userdata['logged_in']['user_id'])){
             header('location:'.base_url().'login');}
         else {
             $data ['title'] ="Product Comparison";
             $data ['name'] ="Product Comparison";
             $data ['active'] ='forsupplier';
             $data ['active2'] ='buyer';
             $this->load->view('dashboard/minisite-mgt/add_minisite_banners',$data);
             }
	 }
	 
	 function manage_minisite(){
         if(!isset($this->session->userdata['logged_in']['user_id'])){
             header('location:'.base_url().'login');}
         else {
             $data ['title'] ="Product Comparison";
             $data ['name'] ="Product Comparison";
             $data ['active'] ='forsupplier';
             $data ['active2'] ='buyer';
             $this->load->view('dashboard/minisite-mgt/minisite_manage',$data);
         }
	 }
	 
	 function company_logo(){
         if(!isset($this->session->userdata['logged_in']['user_id'])){
             header('location:'.base_url().'login');}
         else {
             $data ['title'] ="Company logo";
             $data ['name'] ="Company logo";
             $data ['active'] ='forsupplier';
             $data ['active2'] ='buyer';
             $this->load->view('dashboard/minisite-mgt/add_company_logo',$data);
         }
	 }
	 
	 function manage_theme(){
         if(!isset($this->session->userdata['logged_in']['user_id'])){
             header('location:'.base_url().'login');}
         else {
             $this->load->view('myaccount/manage_theme');
         }
	 }
	 
	 function manage_products(){
         if(!isset($this->session->userdata['logged_in']['user_id'])){
             header('location:'.base_url().'login');}
         else {
             $data ['title'] = "Manage products";
             $data['active'] = "forsupplier";
             $data['name'] =  "Manage Featured products";
             $data['active2'] = "products";

             $this->load->view('dashboard/product-mgt/manage_products',$data);
         }
	 }
	 
	  function manage_wholesale_products(){
		  if(!isset($this->session->userdata['logged_in']['user_id'])){
			header('location:'.base_url().'login');}
			else{
                $data['active'] = "forsupplier";
                $data['name'] =  "Manage Wholesale products";
                $data['active2'] = "products";
		        $this->load->view ('dashboard/product-mgt/wholesale-manage-products',$data);
			}
	 }
	
	 function edit_product($productId){
         if(!isset($this->session->userdata['logged_in']['user_id'])){
             header('location:'.base_url().'login');}
         else {
             $data['productId'] = $productId;
             $data['active'] = "forsupplier";
             $data['name'] =  "Edit product";
             $data['active2'] = "products";
             $this->load->view('dashboard/product-mgt/edit_product', $data);
         }
	 }
	
	  function manage_order_online(){
          if(!isset($this->session->userdata['logged_in']['user_id'])){
              header('location:'.base_url().'login');}
          else {
              $this->load->view('pages/manageOrderLine');
          }
	 }
	   function trackorderonline($tracking_number=null){
           $data['title']='Track Orders';
           $data['active'] = "myblazebay";
           $data['name'] =  'Track Orders';
           $data['active2'] = 'Track Orders';
           $data['tracking_number']=$tracking_number;
           $this->load->view ('pages/orders/order-tracking',$data);
	 }
	  function access_secure_trade_services($pageId=null){
          $data['title']='Secure Trade Searvices';
          $data['active'] = "myblazebay";
          $data['name'] =  'Secure Trade Searvices';
          $data ['Getpage'] = $pageId;
          $data ['getcid'] =$pageId;
          $data ['productsWithTradeSecurity'] = $this->Site_model->bestsellerProducts();
		$this->load->view ('trade-security/index',$data);
	 }
	 

	 function post_wholesale_product(){
			if(!isset($this->session->userdata['logged_in']['user_id'])){
			header('location:'.base_url().'login');}
			else{
                $data['active'] = "forsuplier";
                $data['name'] =  'Post Wholesale products';
                $data['active2'] = 'Post Wholesale products';
                $this->load->view ('dashboard/product-mgt/post_wholesale_product',$data);
			}
	 }
	 	  function process_post_wholesale_product(){

		              $logged_user_planid = $this->session->userdata['logged_in']['memtype'];
		              $prev='bt_';
					  $ADMIN_PERCENTAGE=10;
					  $wholesale_item=1;
                        //--getting config---------
                        $sbq_con = 'select * from ' . $prev . 'config where id=1';
                        $sbrow_con = $this->Site_model->getcountRecods($sbq_con);
						
						$getBusinessDetails =$this->Site_model-> getDataById('bt_business',"user_id = ".$this->session->userdata['logged_in']['user_id']."");
						if(!empty($getBusinessDetails)){
							$business_id = $getBusinessDetails[0]['id'];
						}

                        // $sbq_gro="select * from " . $prev. "privilage where privilage_id='".$_SESSION["memtype"]."'";
                         
                        //getting user's privious postings
                        $sbq_off = "select * from " . $prev . "products where uid=" . $this->session->userdata['logged_in']['user_id'];
                        $sbsell_count = count($this->Site_model->getcountRecods($sbq_off));
                        $USER_POSTED_PRODUCTS = count($this->Site_model->getcountRecods($sbq_off)); // TOTAL POSTED
						
						
						$logged_userid = $this->session->userdata['logged_in']['user_id'];

						// Get Plan Details
						$sbq_gro = "select * from " . $prev . "membership_plan where plan_id ='" . $logged_user_planid . "'";
						$sbrow_gro =$this->Site_model->getcountRecods($sbq_gro);
						$PLAN_ALLOWED_PRODUCTS_NO = $sbrow_gro[0]["no_of_products"];
                        
						
                        
                        // Enters When 
                        if($USER_POSTED_PRODUCTS < $PLAN_ALLOWED_PRODUCTS_NO)
                        {
                            
                            
                            $title        = $_POST["title"];
                            //Checks duplicates::
                            $duplicate_entry = $this->Site_model->getcountRecods("SELECT * FROM  bt_products WHERE uid = '$logged_userid' AND title = '$title'");
                            
							//echo 'sdsadf';
                            if(empty($duplicate_entry))
                            {
								//echo '5676587dd';
                                //--------------------
                                $cat_list = "";
                                $cid_list = "";
                                if (isset($_POST["category"]) && $_POST["category"] != "") {
                                    $cat_list = str_replace(";", ",", $_POST["category"]);
                                }
                                if (isset($_POST["cid"]) && $_POST["cid"] != ""){
                                    $cid_list = str_replace(";", ",", $_POST["cid"]);
                                }

                                $cat    = explode(",", $cid_list);
                                //  $cat_name=explode(",",$_POST["category"]);

                                $title        = $_POST["title"];
                                $description1 = $_POST["description"];
								$qty_unit= $_POST["product_units"];
                                $description  = htmlentities($description1, ENT_QUOTES);
                                $quantity     = $_POST["product_qty"];
                                $keywords     = @$_POST["keywords"];
                                $key          = explode(",", $keywords);

                                $origin       = "";
                                $material     = "";
                                $function     = "";
                                $brand_name   = "";
                                $model_number = "";
                                $quality = $_POST["weight"]; 
                                if (isset($_POST["cbrand_name"]))
                                { 
                                    $cbrand_name = $_POST["cbrand_name"]; 
                                }
                                

                                if (isset($_POST["model_number"])) {  
                                    $model_number =$_POST["model_number"];
                                } 
                                

                                $color      = $_POST["color"];
								$size      = $_POST["size"];
                                $type       = $_POST["type"];
                                $features   = $_POST["features"];

                                $expireson  = date("Y-m-d", strtotime($_POST['expireson']));
                                if ($expireson == '1970-01-01')
                                {
                                    //$expireson= DateTime.Now.ToString("yyyy-MM-dd");
                                    $expireson = date('Y-m-d', strtotime("+3000 days"));
                                } 
                                else 
                                {
                                    $expireson = date("Y-m-d", strtotime($_POST['expireson']));
                                }

                                //echo $expireson; die();
                                $location           = @$_POST["location"];
                                $min_order          = $_POST["min_order"];
                                $price_cur_id       = $_POST["price_cur_id"];

                                $minproduct_price              = $_POST["minproduct_price"];                  // SUPPLIER PRICE
                                $maxproduct_price = $_POST["maxproduct_price"];     // PRODUCT SELLING PRICE
                                $minwhole_sell_price              = $_POST["minwhole_sell_price"];                  // SUPPLIER PRICE
                                $maxwhole_sell_price = $_POST["maxwhole_sell_price"];     // PRODUCT SELLING PRICE

                                $samples_available  = $_POST["samples_available"];
                                $product_status     = $_POST["product_status"];
                                //$delivery_time= $_POST["delivery_time"];
                                $delivery_time      = "0";

                                if (isset($_POST['cash'])) {
                                    $payment_mode = implode(",", $_POST['cash']);
                                }


                                //echo $payment_mode;
                                //$other_mode = $_POST["other_mode"];
                                $other_mode = '';

                                //$shipping_cost = $_POST["shipping_cost"];
                                $shipping_cost = 0;


                                // echo $cid_list."---hello";
$errcnt = 0;
                                if ($errcnt == 0) 
                                {
                                    $min_order = (int) $min_order;
                                    $price_cur_id = (int) $price_cur_id;

                                    $price = $maxwhole_sell_price;
                                    $product_sell_price = $maxwhole_sell_price;

                                    $delivery_time = (int) $delivery_time;
                                    $shipping_cost = $shipping_cost;
                                    $postedon = date("YmdHis", time());
                                    $approved = 'yes';
                                    $uid = $this->session->userdata['logged_in']['user_id'];

                                    $sbq_con = 'select * from ' . $prev . 'config where id=1';
                                    $sbrow_con = $this->Site_model->getcountRecods($sbq_con);
                                    
                                    if ($sbrow_con[0]['approval_type_offer'] == 'auto') {
                                        $new = 'no';
                                        $approved = 'yes';
                                        //$_SESSION['after_post_msg'] = 'Your product has been posted.';
                                        $after_post_msg='<div class="alert alert-success">Your product has been posted.</div>';
                                    } 
                                    else 
                                    {
                                        $new = 'yes';
                                        $approved = 'no';
                                        //$_SESSION['after_post_msg'] ='Your product catalog has been sent for admin approval.';
                                        $after_post_msg='<div class="alert alert-success">Your product catalog has been sent for admin approval.</div>';
                                    }


                                    $multi_imgname   = $_FILES["fileToUpload"]["name"];

                                    $multi_extension = explode('.', $multi_imgname);

                                    $mimg_ext        = strtolower(end($multi_extension));

                                    //new multi image name

                                    $mimgpre       = 'PRODIMG'.rand(1000,9999);

                                    $image  = $mimgpre.time().".".$mimg_ext;
									                              
                                     move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"assets/uploadedimages/".$image);
									
                                    
                                    // $sbqi_off = "Insert into `" . $prev . "products` (uid, title, description, quantity, postedon, keywords, location, min_order, price_cur_id, price, samples_available, product_status, delivery_time, payment_mode, other_mode, shipping_cost, approved, new , image,origin,material,function,brand_name,quality,cbrand_name,model_number,color,type,featured,expireson) values (\"" . $_SESSION["user_id"] . "\", \"" . $title . "\", \"" . $description . "\", \"" . $quantity . "\",\"" . $postedon . "\", \"" . $keywords . "\", \"" . $location . "\",\"" . $min_order . "\",\"" . $price_cur_id . "\",\"" . $price . "\",\"" . $samples_available . "\",\"" . $product_status . "\",\"" . $delivery_time . "\",\"" . $payment_mode . "\",\"" . $other_mode . "\",\"" . $shipping_cost . "\",\"" . $approved . "\",\"" . $new . "\" ,\"" . $image . "\",\"" . $origin . "\",\"" . $material . "\",\"" . $function . "\",\"" . $brand_name . "\",\"" . $quality . "\",\"" . $cbrand_name . "\",\"" . $model_number . "\",\"" . $color . "\",\"" . $type . "\",\"" . $features . "\",\"" . $expireson . "\")";
                           			$data=array(
									'uid'=> $this->session->userdata['logged_in']['user_id'],
									'bid'=>$business_id, 
									'title'=>$title,
									'description'=>$description,
									'quantity'=>$quantity,
									'postedon'=>$postedon,
									'keywords'=>$keywords,
									'location'=>$location, 
									'min_order'=>$min_order,
									'price_cur_id'=>$price_cur_id, 
									'price'=>$maxwhole_sell_price,
									'samples_available'=>$samples_available,
									'product_status'=>$product_status, 
									'delivery_time'=>$delivery_time,
									'payment_mode'=>'', 
									'other_mode'=>$other_mode, 
									'shipping_cost'=>$shipping_cost , 
									'approved'=> $approved,
									'new'=>$new, 
									'image'=>$image,
									'origin'=>$origin,
									'material'=>$material,
									'function'=>$function,
									'brand_name'=>'',
									'quality'=>$quality,
									'cbrand_name'=>'',
									'model_number'=>$model_number,
									'color'=>$color,
									'qty_unit'=>$qty_unit,
									'size'=>$size,
									'type'=>$type,
									'featured'=>$features,
									'expireson'=>$expireson,
									'supplier_price'=>$maxwhole_sell_price,
									'min_price'=>$minproduct_price,
									'max_price'=>$maxproduct_price,
									'min_sell_price'=>$minwhole_sell_price,
									'max_sell_price'=>$maxwhole_sell_price,
									'admin_percent'=>$ADMIN_PERCENTAGE,
									'wholesale'=>$wholesale_item
									);
                                   $prodctid=$this->Site_model->add('bt_products',$data);
                                   // $prodctid = mysql_insert_id();
                                    
                              
                                    $ctid1 = $_POST['subctid'];
									
									$data2=array(
									'cid'=> $_POST['subctid'],
									'offer_id'=>$prodctid
									);
                                  
									 $catupdt=$this->Site_model->add('bt_product_cats',$data2);
                                     $after_post_msg = '<div class="alert alert-success">Your product  has been sent for admin approval.</div>';
                                    

                                    $res = $this->Site_model->getcountRecods("select * from " . $prev . "products order by postedon desc limit 1");
                                  $product_uid = $res[0]['uid'];
								  
						  
								  $data3=array(
									'img_url'=> $image,
									'offer_id'=>$prodctid,
									'uid'=>$product_uid,
									);
								   $data =$this->Site_model->add( "bt_product_images",$data3);

								    $slider_target_path = "assets/multimage/"; //Declaring Path for uploaded images
                                    
                                    // Send Main Product image Copy To Multimage Folder
                            
                                                for ($i = 0; $i < count($_FILES['file']['name']); $i++) 

                                                    {
                                                        $str_time = $i.time();
                                                        $image2  = $str_time .$_FILES['file']['name'][$i];
                                                        if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $slider_target_path . $image2)){
                                                            //copy($_FILES['file']['tmp_name'][$i], $target_path.basename($_FILES['file']['name'][$i]));
                                                        $multi_images=array(
															'img_url'=> $image2,
															'offer_id'=>$prodctid,
															'uid'=>$product_uid,
															);
                                                        $multi_data =$this->Site_model->add( "bt_product_images",$multi_images);

                                                        }    

                                                    }
								    if (!empty($_POST['product_qty'])) {
									$p_price =  $_POST['maxwhole_sell_price'];
									$whole_sell_price =  $_POST['whole_sell_price'];
									$data4=array(
									'bt_w_product_id'=> $prodctid,
									'bt_w_qty'=>$_POST['product_qty'],
									'bt_w_price'=>$p_price ,
									'bt_w_sell_price'=>$maxwhole_sell_price,
									);	
                                       $data =$this->Site_model->add("bt_wholesale_product_price",$data4);                                   }

                            } // dulicates check ends
                       
							}   
						  else{
							  $after_post_msg='<div class="alert alert-danger">Duplicate entry</div>';
						  }
						}

                  echo 	$after_post_msg;					
	 }
	 

	 	  function check_minisite($minisite_prefix=null){

    $minisite_prefix     = $_POST["miniurl"];
    $urlslug_found    =$this->Site_model->getDataById('bt_business',"minisite_prefix = '$minisite_prefix'");

    if(!empty($urlslug_found)){
        $return_data = "<span style='color:red;'>Already Exists! Try Different !<span>";
    }else{
        $return_data="<span style='color:green;'>Available<span>";
    }

    echo $return_data;  
	 }
	 
	  function wholesale_product_edit($id=null)
      {
          if (!isset($this->session->userdata['logged_in']['user_id'])) {
              header('location:' . base_url() . 'login');
          } else {
              $data["id"] = $id;
              $data['active'] = "forsupplier";
              $data['name'] = "Edit wholesale products";
              $data['active2'] = "products";
              $this->load->view('dashboard/product-mgt/wholesale-product-edit', $data);
          }
      }
	 
	  function manage_sell_offers(){
		   $data ['title'] = "Manage sell Offers";
          $data['active'] = "forsupplier";
          $data['name'] = "Manage sell Offers";
          $data['active2'] = "offers";
		$this->load->view ('dashboard/sale-offers/manage_offers',$data);
	 }
	 
	   function post_sell_offers(){
           if(!isset($this->session->userdata['logged_in']['user_id'])){
               header('location:'.base_url().'login');}
           else {
               $data ['title'] = "Post sell Offers";
               $data['active'] = "forsupplier";
               $data['name'] = "Manage sell Offers";
               $data['active2'] = "offers";
               $this->load->view('dashboard/sale-offers/post_offer', $data);
           }
	 }
	   function checkusername_availability($username=null){
		  $username=$_POST["username"];
			$where="username='" . $username . "'";
			$resulsts= $this->Site_model->getDataById( 'bt_members', $where );
			if(!empty($resulsts)){
				echo "<span style='color:#F00'> Username Already exists.</span> <script>document.getElementById('username').focus();</script>";
			}
			else 
			{
				echo "<span style='color:#0F0'> Username Available.</span>";
			}
	 }
	   function checkEmailAvailability($email=null){	
           $email=$_POST["email"];	   
			$where="email='" . $email . "'";
			$resulsts= $this->Site_model->getDataById( 'bt_members', $where );
			if(!empty($resulsts)){
				echo "<span style='color:#F00'> Email Already Exist</span> <script>document.getElementById('email').focus();</script>";
			}
			else 
			{
				echo "<span style='color:#0F0'></span>";
			}
	 }
    function checksupplierEmailAvailability($email=null){
        $email=$_POST["email"];
        $where="email='" . $email . "' AND usertype=2";
        $resulsts= $this->Site_model->getDataById( 'bt_members', $where );
        if(!empty($resulsts)){
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    function checkQouteAvailability($qoute_no=null){
        $qoute_no=$_POST["qoute_no"];
        $where="invoice_no='" . $qoute_no."'";
        $resulsts= $this->Site_model->getDataById( 'bt_invoices', $where );
        if(!empty($resulsts)){
            echo json_encode($resulsts);
        }
        else
        {
            echo 0;
        }
    }
	   function select_states($country_id=null){
          $prev="bt_";		   
	      $country_id=$_POST['country_id'];
		  $where="country_id = ".$country_id;
		 $country_name= $this->Site_model->getDataById( 'bt_countries', $where );

    if ($country_name[0]['state_status']==0) {
        $html['state_status'] = 0;
        $html['country_name'] = $country_name[0]['country_name'];
    } else {
        $html['state_status'] = 1;
        $html['country_name'] = $country_name[0]['country_name'];
    }

    $rowCount = $this->Site_model->getcountRecods("SELECT * FROM " . $prev. " states WHERE country_id = ".$country_id." AND status = '1' ORDER BY state_name ASC");
    
    //$rowCount = mysql_num_rows($query);
   
    
    //Display states list
    if(!empty($rowCount)){
        $html['item'] ='';
        //echo '<option value="0">Select state</option>';
        foreach($rowCount as  $key=>$row){ 
            $html['item'] .= '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
        }
    }else{
      $html['item'] = '<option value="0">State not available</option>';
    }

    echo json_encode($html);
	 }
	
function processsignup(){
	$prev="bt_";
	$ip         = $_SERVER['REMOTE_ADDR'];
	$username   = $_POST['username'];
	$first_name = $_POST['firstname'];
	$last_name  = $_POST['lastname'];
	$email      = $_POST['email'];
	$pass       = $_POST['password'];
	$pass1      = $_POST['cpassword'];
	$phone      = $_POST['phone'];

    $memtype = $_POST['usertype'];
        


	if( $username=="" || $email=="" || $first_name =="" || $last_name=="" || $pass1=="" || $pass==""  ||
		$phone=="" ) {
		$reply_msg='Please Enter All the Fields with (*) marks';
		$code=0;

		
	}else if($pass1 != $pass){
		$reply_msg='Password Mismatched. Please Try Again';
		$code=0;
	}
	else{
		$prev="bt_";
		$dotcom="www.blazebay.com";
		$check_username =$this->Site_model->getDataById($prev.'members',"username='$username'");
		$check_email =$this->Site_model->getDataById($prev.'members',"email='$email'");
		

		if($check_username[0]['user_id']>0){ $reply_msg='Username Exists.Try Different';$code=0; }
		
		else if($check_email[0]['user_id']>0){ $reply_msg='Email Already Exists.Try Different';$code=0; }
		
		else {
			$pass       = md5( $pass1 );
			//$date=date('Y-m-d:His');
			$data =array(
		    'email' =>$email,
			'username'  =>$username,
			'password'  =>$pass,
			'usertype'  =>$memtype,
			'firstname' =>$first_name,
			'lastname  '=>$last_name,
			'phone'     =>$phone,
			'memtype   '=>$memtype,
			'user_img  '=>'',
			'suspended '=>'Y'
			);
			
			
			$res=$this->Site_model->add('bt_members',$data);
			
		
			
            $new_user_id=$res;
            $token=md5($new_user_id);
			$data2 =array(
			'uid'=>$new_user_id,
			'token'=>$token,
			'date'=>date('Y-m-d'),
			'visible'=>0
			);
			$results=$this->Site_model->add('bt_activation',$data2);
			
            
			// IF User is not Buyer (Supplier & Courier)
			if($memtype == '2' || $memtype == '4') {
				$companyname      = $_POST['companyname'];
				$companyemail     = $_POST['companyemail'];
				$companyphone     = $_POST['companyphone'];
				$address1         = $_POST['address1'];
				$preferable_cat   = $_POST['preferable_cat'];
				$minisite_prefix  = trim($_POST['minisite_custom_url']);
				$ins_bu_data = array(
                             'company_name' =>$companyname,
								'email  ' =>$companyemail,
								'mobile ' =>$companyphone ,
								'user_id  ' => $new_user_id ,
								'minisite_prefix ' => $minisite_prefix ,
								'address1 ' => $_POST['address1'],
								'cat_id ' => $preferable_cat
								);
							
				$dddd =$this->Site_model->add('bt_business',$ins_bu_data);    
			}

            $content='<p>Hi,'.' '.$first_name.'</p>
                        <p>Welcome to <a href="https://wwww.blazebay.com">Blazebay</a>. Thank you for registering with us. Click <br>
						<a href="https://www.blazebay.com/activate-account/'.$token.'" target="_blank">Activate Account</a> <br> or Click the activate button.</a></p>';
			// Sending Signup Email to User
			if ($res) {

                $orderDetails= array(

                    'user_id' => "",

                    'sender' => "info@blazebay.com",

                    'receiver' =>$email,

                    'subject' =>'Activate Your Blazebay Account',

                    'message' =>$content,

                    'status' =>0
                );

                $this->Site_model->add("bt_emails", $orderDetails);
						$reply_msg='Registration Successful Please check your email to activate your account.
						You can also check the email in the Spam folder';
                        $code=1;
			} else {  
				$reply_msg='There was an error while registering your Account.Please try again after some time.';
				$code=0;
			}
		} // Else Ends
	} // Else Ends
	
        $data=array(
        'msg'=>$reply_msg,
        'code'=>$code
        );
	echo json_encode($data);
}

  function process_edit_product(){
		               $id = $_POST["id"];
                        
                        //$cat_list = str_replace(";", ",", $_POST["category"]);
                        //$cid_list = str_replace(";", ",", $_POST["cid"]);
                        
                        $cat_list ="";$cid_list="";
                        if(isset($_POST["category"])){
                            $cat_list = str_replace(";", ",", $_POST["category"]);
                        }
                        if(isset($_POST["cid"])){
                            $cid_list = str_replace(";", ",", $_POST["cid"]);
                        }
                        $wholesale_item=1;
                      $logged_user_planid = $this->session->userdata['logged_in']['memtype'];
		              $prev='bt_';
					  $ADMIN_PERCENTAGE=10;
                        $cat = explode(",", $cid_list);
                        //$cat_name=explode(",",$_POST["category"]);

                        $title = $_POST["title"];
                        $description = $_POST["description"];
                        $quantity = $_POST["quantity"];
                        $keywords = $_POST["keywords"];
                        $key = explode(",", $keywords);

                        $origin = $_POST["origin"];
                        $material = $_POST["material"];
                        $function = $_POST["function"];
                        $brand_name = $_POST["brand_name"];
                        $quality = $_POST["quality"];
                        $cbrand_name = $_POST["cbrand_name"];
                        $model_number = $_POST["model_number"];
                        $color = $_POST["color"];
                        $type = $_POST["type"];
                        $featured = $_POST["features"];
                        $expireson = date("Y-m-d", strtotime($_POST['expireson']));
                        $location = $_POST["location"];
                        $min_order = $_POST["min_order"];
                        $price_cur_id = $_POST["price_cur_id"];

                        $price              = $_POST["price"];                  // SUPPLIER PRICE
                        $minprice = $_POST["minprice"];     // PRODUCT SELLING PRICE
                        $maxprice              = $_POST["maxprice"];                  
						$min_sell_price              = $_POST["minproduct_sell_price"];                  
						$max_sell_price = $_POST["maxproduct_sell_price"];     

                        
                        $samples_available = $_POST["samples_available"];
                        $product_status = $_POST["product_status"];
                        $errcnt=0;
						 $delivery_time = 0;
						 if (!is_numeric($min_order) || ($min_order <= 0)) {
                            $message= '<div class="alert alert-danger">Minimum Order must be non-zero positive integer</div>';
                            $errcnt++;
                        }

                         if (!is_numeric($price_cur_id) || ($price_cur_id == 0)) {
                            $message = '<div class="alert alert-danger">Price currency must be selected</div>';
                            $errcnt++;
                        }
						
						   if ($errcnt == 0) 
                        {
                            $min_order = (int) $min_order;
                            $price_cur_id = (int) $price_cur_id;
                            $price = $price;

                            //$delivery_time = (int) $delivery_time;
                            $delivery_time = "";
                            $shipping_cost = $shipping_cost;

                            $uid =$this->session->userdata['logged_in']['user_id'];

                            if ($sbrow_con['approval_type_offer'] == 'auto') 
                            {
                                $approved = 'yes';
                                $message = '<div class="alert alert-success">Your product catalog has been updated.</div>';
                            } 
                            else 
                            {
                                $approved = 'no';                                                           
                            }
							
							
							 $newfile=$_FILES["fileToUpload"]["name"];
							 $mainImageNewName =$newfile ? $newfile:$_POST["change_image"];
							 if($newfile){
							 move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"assets/uploadedimages/".$image);
							 }
							 $multiimg_dataArr = array(
                                            'img_url'     => $mainImageNewName,
                                            'uid'         => $uid,
                                            'default_img' => 1,
                                        );
										$where=" offer_id=$id";
							 $upimagedata =$this->Site_model->update( "bt_product_images",$multiimg_dataArr,$where);
 
							  $product_data=array(
									 
									'title'=>$title,
									'description'=>$description,
									'quantity'=>$quantity,
									'postedon'=>$postedon,
									'keywords'=>$keywords,
									'location'=>$location, 
									'min_order'=>$min_order,
									'price_cur_id'=>$price_cur_id, 
									'price'=>$max_sell_price,
									'min_price'=>$minprice,
									'max_price'=>$maxprice,
									'min_sell_price'=>$min_sell_price,
									'max_sell_price'=>$max_sell_price,
									'samples_available'=>$samples_available,
									'product_status'=>$product_status, 
									'delivery_time'=>$delivery_time,
									'payment_mode'=>$payment_mode, 
									'other_mode'=>$other_mode, 
									'shipping_cost'=>$shipping_cost , 
									
									'new'=>$new, 
									'image'=>$mainImageNewName,
									'origin'=>$origin,
									'material'=>$material,
									'function'=>$function,
									'brand_name'=> $brand_name,
									'quality'=>$quality,
									'cbrand_name'=>$cbrand_name,
									'model_number'=>$model_number,
									'color'=>$color,
									'type'=>$type,
									'featured'=>$features,
									'expireson'=>$expireson,
									'supplier_price'=>$price,
									'admin_percent'=>$ADMIN_PERCENTAGE,
									'wholesale'=>$wholesale_item
									);
                              $where="id=" . $id . "  and uid=" . $uid;
							 
							 
							  
                              $product_update=$this->Site_model->update('bt_products',$product_data,$where);
							 $ctid1 = $_POST['ctid'];
                  
				     if (isset($_POST['subctid']) && $_POST['subctid'] != "") 
                            {
                                
								 $update_cat_data=array(
										'cid'=>$_POST['subctid']
										);
								 $where=" offer_id='" . $id . "'";
								 
								  $catupdt =$this->Site_model->update( "bt_product_cats",$update_cat_data,$where);

                            }
                            else 
                            {
								 $update_cat_data=array(
										'cid'=>$_POST['ctid']
										);
										
								  $where=" offer_id='" . $id . "'";
								  $catupdt =$this->Site_model->update( "bt_product_cats",$update_cat_data,$where);

                            }

                    if ($product_update) {

                                if (!empty($_POST['product_qty']) && !empty($_POST['product_price'])) {

                                    $delprice_cond = "bt_w_product_id = '$product_id'";
                                    $delete_price_return =$this->Site_model->delete('bt_wholesale_product_price',$delprice_cond);

                                    if($delete_price_return){
                                        foreach ($_POST['product_qty'] as $key => $value) {
                                           
                                            $p_price =  $_POST['product_price'][$key];
                                            $whole_sell_price =  $_POST['whole_sell_price'][$key];

											  $data4=array(
											'bt_w_product_id'=> $prodctid,
											'bt_w_qty'=>$_POST['product_qty'],
											'bt_w_price'=>$p_price ,
											'bt_w_sell_price'=>$whole_sell_price,
											);	
                                       $data =$this->Site_model->add("bt_wholesale_product_price",$data4);  
                                        }
                                    }
                                }
                              
                                $message = '<div class="alert alert-success">Success ,product edited successfully</div>';      
                            } else {
                                $message = '<div class="alert alert-danger">An Error occured while editing the product</div>';
                            }
						
						}
						echo $message;
  }
  
  function process_edit_wholesale_product(){
		               $id = $_POST["id"];
                        
                        //$cat_list = str_replace(";", ",", $_POST["category"]);
                        //$cid_list = str_replace(";", ",", $_POST["cid"]);
                        
                        $cat_list ="";$cid_list="";
                        if(isset($_POST["category"])){
                            $cat_list = str_replace(";", ",", $_POST["category"]);
                        }
                        if(isset($_POST["cid"])){
                            $cid_list = str_replace(";", ",", $_POST["cid"]);
                        }
                        $wholesale_item=1;
                      $logged_user_planid = $this->session->userdata['logged_in']['memtype'];
		              $prev='bt_';
					  $ADMIN_PERCENTAGE=10;
                        $cat = explode(",", $cid_list);
                        //$cat_name=explode(",",$_POST["category"]);

                        $title = $_POST["title"];
                        $description = $_POST["description"];
                        $quantity = $_POST["product_qty"];
                        $keywords = $_POST["keywords"];
                        $key = explode(",", $keywords);
                        $qty_unit= $_POST["product_units"];
                        $origin = $_POST["origin"];
                        $material = $_POST["material"];
                        $function = $_POST["function"];
                        $brand_name = $_POST["brand_name"];
                        $weight = $_POST["weight"];
                        $cbrand_name = $_POST["cbrand_name"];
                        $model_number = $_POST["model_number"];
                        $color = $_POST["color"];
						$size = $_POST["size"];
                        $type = $_POST["type"];
                        $features = $_POST["features"];
                        $expireson = date("Y-m-d", strtotime($_POST['expireson']));
                        $location = $_POST["location"];
                        $min_order = $_POST["min_order"];
                        $price_cur_id = $_POST["price_cur_id"];

                        $price              = $_POST["price"];                  // SUPPLIER PRICE
                        $product_sell_price = $_POST["product_price"];     // PRODUCT SELLING PRICE
                        
                        $samples_available = $_POST["samples_available"];
                        $product_status = $_POST["product_status"];
						$minproduct_price              = $_POST["minproduct_price"];                  // SUPPLIER PRICE
						$maxproduct_price = $_POST["maxproduct_price"];     // PRODUCT SELLING PRICE
						$minwhole_sell_price              = $_POST["minwhole_sell_price"];                  // SUPPLIER PRICE
						$maxwhole_sell_price = $_POST["maxwhole_sell_price"];     // PRODUCT SELLING PRICE

                        $errcnt=0;
						 $delivery_time = 0;
						 if (!is_numeric($min_order) || ($min_order <= 0)) {
                            $message= '<div class="alert alert-danger">Minimum Order must be non-zero positive integer</div>';
                            $errcnt++;
                        }

                         if (!is_numeric($price_cur_id) || ($price_cur_id == 0)) {
                            $message = '<div class="alert alert-danger">Price currency must be selected</div>';
                            $errcnt++;
                        }
						
						   if ($errcnt == 0) 
                        {
                            $min_order = (int) $min_order;
                            $price_cur_id = (int) $price_cur_id;
                            $price = $price;

                            //$delivery_time = (int) $delivery_time;
                            $delivery_time = "";
                            $shipping_cost = $shipping_cost;

                            $uid =$this->session->userdata['logged_in']['user_id'];

                            if ($sbrow_con['approval_type_offer'] == 'auto') 
                            {
                                $approved = 'yes';
                                $message = '<div class="alert alert-success">Your product catalog has been updated.</div>';
                            } 
                            else 
                            {
                                $approved = 'no';                                                           
                            }
							
							
							 $newfile=$_FILES["fileToUpload"]["name"];
							 
							 if($newfile){
							 move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"assets/uploadedimages/".$newfile);
						
                             $mainImageNewName =$_FILES["fileToUpload"]["name"];
							 $multiimg_dataArr = array(
                                            'img_url'     => $mainImageNewName,
											'offer_id'=>$id,
                                            'default_img' => 1,
                                        );
							$where=" offer_id=$id";
							 $upimagedata =$this->Site_model->update( "bt_product_images",$multiimg_dataArr,$where);
							  if($_FILES['file']['name']){
							   $slider_target_path = "assets/multimage/"; //Declaring Path for uploaded images

                                    // Send Main Product image Copy To Multimage Folder
                            
							for ($i = 0; $i < count($_FILES['file']['name']); $i++) 

								{
									$str_time = $i.time();
									$image2  = $str_time .$_FILES['file']['name'][$i];
									if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $slider_target_path . $image2)){
										//copy($_FILES['file']['tmp_name'][$i], $target_path.basename($_FILES['file']['name'][$i]));
									$multi_images=array(
										'img_url'=> $image2,
										'offer_id'=>$id,
										 'default_img' =>0,
										);
										//print_r($multi_images);
									$multi_data =$this->Site_model->add( "bt_product_images",$multi_images);

									}    

								}
							  }
										
							 }else{

							$mainImageNewName =$newfile ? $newfile:$_POST["change_image"];	
							 if($_FILES['file']['name']){
							   $slider_target_path = "assets/multimage/"; //Declaring Path for uploaded images

                                    // Send Main Product image Copy To Multimage Folder
                            
							for ($i = 0; $i < count($_FILES['file']['name']); $i++) 

								{
									$str_time = $i.time();
									$image2  = $str_time .$_FILES['file']['name'][$i];
									if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $slider_target_path . $image2)){
										//copy($_FILES['file']['tmp_name'][$i], $target_path.basename($_FILES['file']['name'][$i]));
									$multi_images=array(
										'img_url'=> $image2,
										'offer_id'=>$id,
										 'default_img' =>0,
										);
										
										//print_r($multi_images);
									$multi_data =$this->Site_model->add( "bt_product_images",$multi_images);

									}    

								}
							  }
	                              				
							 }
							 
										
							
							  
							   
							 
							 
								
							  $product_data=array(
									 
									'title'=>$title,
									'description'=>$description,
									'quantity'=>$quantity,
									'postedon'=>$postedon,
									'keywords'=>$keywords,
									'location'=>$location, 
									'min_order'=>$min_order,
									'price_cur_id'=>$price_cur_id, 
									'price'=>$maxwhole_sell_price,
									'samples_available'=>$samples_available,
									'product_status'=>$product_status, 
									'delivery_time'=>$delivery_time,
									'payment_mode'=>$payment_mode, 
									'other_mode'=>$other_mode, 
									'shipping_cost'=>$shipping_cost , 
									'qty_unit'=>$qty_unit,
									'new'=>$new, 
									'image'=>$mainImageNewName,
									'origin'=>$origin,
									'material'=>$material,
									'function'=>$function,
									'brand_name'=> $brand_name,
									'quality'=>$weight,
									'cbrand_name'=>$cbrand_name,
									'model_number'=>$model_number,
									'color'=>$color,
									'size'=>$size,
									'type'=>$type,
									'featured'=>$features,
									'expireson'=>$expireson,
									'supplier_price'=>$maxwhole_sell_price,
									'min_price'=>$minproduct_price,
									'max_price'=>$maxproduct_price,
									'min_sell_price'=>$minwhole_sell_price,
									'max_sell_price'=>$maxwhole_sell_price,
									'admin_percent'=>$ADMIN_PERCENTAGE,
									'wholesale'=>$wholesale_item
									);
                              $where="id=" . $id . "  and uid=" . $uid;
							
						
							 /*	 echo "<pre>";
							 print_r($product_data);
							 echo "<pre>";*/
							  
                              $product_update=$this->Site_model->update('bt_products',$product_data,$where);
							 $ctid1 = $_POST['ctid'];
                  
				     if (isset($_POST['subctid']) && $_POST['subctid'] != "") 
                            {
                                
								 $update_cat_data=array(
										'cid'=>$_POST['subctid']
										);
								 $where=" offer_id='" . $id . "'";
								 
								  $catupdt =$this->Site_model->update( "bt_product_cats",$update_cat_data,$where);

                            }
                            else 
                            {
								 $update_cat_data=array(
										'cid'=>$_POST['ctid']
										);
										
								  $where=" offer_id='" . $id . "'";
								  $catupdt =$this->Site_model->update( "bt_product_cats",$update_cat_data,$where);

                            }

                    if ($product_update) {

                                if (!empty($_POST['product_qty']) && !empty($_POST['product_price'])) {

                                    $delprice_cond = "bt_w_product_id = '$product_id'";
                                    $delete_price_return =$this->Site_model->delete('bt_wholesale_product_price',$delprice_cond);

                                    if($delete_price_return){
                                        foreach ($_POST['product_qty'] as $key => $value) {
                                           
                                            $p_price =  $_POST['product_price'][$key];
                                            $whole_sell_price =  $_POST['whole_sell_price'][$key];

											  $data4=array(
											'bt_w_product_id'=> $prodctid,
											'bt_w_qty'=>$_POST['product_qty'],
											'bt_w_price'=>$p_price ,
											'bt_w_sell_price'=>$whole_sell_price,
											);	
                                       $data =$this->Site_model->add("bt_wholesale_product_price",$data4);  
                                        }
                                    }
                                }
                              
                                $message = '<div class="alert alert-success">Success ,product edited successfully</div>';      
                            } else {
                                $message = '<div class="alert alert-danger">An Error occured while editing the product</div>';
                            }
						
						}
						echo $message;
  }
  
  public  function smart_resize_image($file,

                              $string             = null,

                              $width              = 0, 

                              $height             = 0, 

                              $proportional       = false, 

                              $output             = 'file', 

                              $delete_original    = true, 

                              $use_linux_commands = false,

  			      $quality = 100

  		 ) {

      

    if ( $height <= 0 && $width <= 0 ) return false;

    if ( $file === null && $string === null ) return false;



    # Setting defaults and meta

    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);

    $image                        = '';

    $final_width                  = 0;

    $final_height                 = 0;

    list($width_old, $height_old) = $info;

	$cropHeight = $cropWidth = 0;



    # Calculating proportionality

    if ($proportional) {

      if      ($width  == 0)  $factor = $height/$height_old;

      elseif  ($height == 0)  $factor = $width/$width_old;

      else                    $factor = min( $width / $width_old, $height / $height_old );



      $final_width  = round( $width_old * $factor );

      $final_height = round( $height_old * $factor );

    }

    else {

      $final_width = ( $width <= 0 ) ? $width_old : $width;

      $final_height = ( $height <= 0 ) ? $height_old : $height;

	  $widthX = $width_old / $width;

	  $heightX = $height_old / $height;

	  

	  $x = min($widthX, $heightX);

	  $cropWidth = ($width_old - $width * $x) / 2;

	  $cropHeight = ($height_old - $height * $x) / 2;

    }



    # Loading image to memory according to type

    switch ( $info[2] ) {

      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;

      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;

      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;

      default: return false;

    }

    

    

    # This is the resizing/resampling/transparency-preserving magic

    $image_resized = imagecreatetruecolor( $final_width, $final_height );

    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {

      $transparency = imagecolortransparent($image);

      $palletsize = imagecolorstotal($image);



      if ($transparency >= 0 && $transparency < $palletsize) {

        $transparent_color  = imagecolorsforindex($image, $transparency);

        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);

        imagefill($image_resized, 0, 0, $transparency);

        imagecolortransparent($image_resized, $transparency);

      }

      elseif ($info[2] == IMAGETYPE_PNG) {

        imagealphablending($image_resized, false);

        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

        imagefill($image_resized, 0, 0, $color);

        imagesavealpha($image_resized, true);

      }

    }

    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);

	

	

    # Taking care of original, if needed

    if ( $delete_original ) {

      if ( $use_linux_commands ) exec('rm '.$file);

      else @unlink($file);

    }



    # Preparing a method of providing result

    switch ( strtolower($output) ) {

      case 'browser':

        $mime = image_type_to_mime_type($info[2]);

        header("Content-type: $mime");

        $output = NULL;

      break;

      case 'file':

        $output = $file;

      break;

      case 'return':

        return $image_resized;

      break;

      default:

      break;

    }

    

    # Writing image according to type to the output destination and image quality

    switch ( $info[2] ) {

      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;

      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;

      case IMAGETYPE_PNG:

        $quality = 9 - (int)((0.9*$quality)/10.0);

        imagepng($image_resized, $output, $quality);

        break;

      default: return false;

    }



    return true;

  }
  	   function process_post_product(){
		   $ADMIN_PERCENTAGE=10;

		   $prev="bt_";
           $product_table          = $prev."products";
			$product_images_table   = $prev."product_images";

			$product_cats_table     = $prev."product_cats";  

			$business_table         = $prev."business"; 

			$unit_master_table      = $prev."unit_master"; 

			$membership_plan_table  = $prev."membership_plan"; 

			$masterBrandTable       = $prev."master_brands";
		   $logged_userid= $this->session->userdata['logged_in']['user_id'];
		   $count_preposted_productsq ="SELECT count(*) FROM $product_table WHERE uid ='$logged_userid'";
           $count_preposted_products= $this->Site_model->getcountRecods($count_preposted_productsq);
		  
			$logged_user_planid = $this->session->userdata['logged_in']['memtype'];
			$where ="plan_id ='$logged_user_planid'";
			$get_plan_Details= $this->Site_model->getDataById($membership_plan_table,$where);
			
			$where ="user_id ='$logged_userid'";
			$businessDetails= $this->Site_model->getDataById($business_table,$where);

			$businessId      = $businessDetails[0]['id'];

		if($get_plan_Details){

			$PLAN_ALLOWED_PRODUCTS_NO = $get_plan_Details[0]["no_of_products"];

			$allowed_to_postproduct   = $PLAN_ALLOWED_PRODUCTS_NO;

		}
		 $errcnt = 0;
		//stores posted values
		$post = $_POST; 

		if(count($count_preposted_products) < $allowed_to_postproduct)

		{  

        $title        = $_POST["title"];

        //Checks duplicates products ::

        $duplicate_entry = $this->Site_model->getDataById($prev.'products',"title = '$title' AND uid = '$logged_userid'");

        //print_r($duplicate_entry);

        if(empty($duplicate_entry))

        {

            $created_on = time(); 

            $qty_unit   = $post['product_units'];



            $cat_list = "";

            $cid_list = "";

            if (isset($_POST["category"]) && $_POST["category"] != "") 

            {

                $cat_list = str_replace(";", ",", $_POST["category"]);

            }

            if (isset($_POST["cid"]) && $_POST["cid"] != "") 

            {

                $cid_list = str_replace(";", ",", $_POST["cid"]);

            }

            $cat          = explode(",", $cid_list);

            



            $title        = $_POST["title"];

            $description1 = $_POST["description"];

            $description  = htmlentities($description1, ENT_QUOTES);

            $quantity     = $_POST["quantity"];

            $keywords     = $_POST["keywords"];

            $key          = explode(",", $keywords);



            $origin       = $_POST["origin"];

            $material     = $_POST["material"];

            $function     = $_POST["function"];

            $brand_name   = $_POST["brand_name"];

            
            $quality = $_POST["weight"]; 


            if (isset($_POST["cbrand_name"])){ 

                $cbrand_name = $_POST["cbrand_name"]; 

            }else{ 

                $brand_name = "";  

            }



            if (isset($_POST["model_number"])) {  

                $model_number = $_POST["model_number"];

            } else { 

                $model_number = ""; 

            }



            $color      = $_POST["color"];

            $type       = $_POST["type"];

            $features   = $_POST["features"];



            $expireson  = date("Y-m-d", strtotime($_POST['expireson']));

            if ($expireson == '1970-01-01') {

                $expireson = date('Y-m-d', strtotime("+3000 days"));

            } else {

                $expireson = date("Y-m-d", strtotime($_POST['expireson']));

            }



            $location           = $_POST["location"];

            $min_order          = $_POST["min_order"];

            $price_cur_id       = $_POST["price_cur_id"];



            $minprice              = $_POST["minprice"];              //supplier min price
		    $maxprice              = $_POST["maxprice"];              //supplier max price

            $minproduct_sell_price = $_POST["minproduct_sell_price"]; //product min sellig price

            $maxproduct_sell_price = $_POST["maxproduct_sell_price"]; //product max sellig price


            $samples_available  = $_POST["samples_available"];

            $product_status     = $_POST["product_status"];

            

            $delivery_time      = "0";

            if (isset($_POST['cash'])) {

                $payment_mode = implode(",", $_POST['cash']);

            }else{$payment_mode ="";}



            $other_mode    = '';

            $shipping_cost = 0;

            $product_catid = $post['subctid'];   //product under sub category id



            //=====for product brand: starts =====

            if($_POST['product_brand']=="others"){

                if(!empty($_POST['other_brand'])){

                    //insert new brand as inactive

                    $posted_brand_name = trim($post['other_brand']);

					$branddata=array(
					
					);
                    $product_brand_id =$this->add_new_other_brand($posted_brand_name, $logged_userid);

                }   

            }else{

                $product_brand_id = $_POST['product_brand'];

            }

            //=====for product brand: Ends  =====



            if ($errcnt == 0) 

            {

                $min_order      = (int) $min_order;

                $price_cur_id   = (int) $price_cur_id;



                $price          = $maxproduct_sell_price;

                $product_sell_price = $maxproduct_sell_price;



                $delivery_time = (int) $delivery_time;

                $shipping_cost = $shipping_cost;

                $postedon   = date("YmdHis", time());

                $approved   = 'yes';

                $uid        = $logged_userid;



                $new        = 'yes';

                $approved   = 'no';

                //upload product_image & multi_image folder

                $allow  = array("jpg", "jpeg", "gif", "png");

                $todir  = 'assets/uploadedimages/';

                $todir1 = 'assets/multimage/';
				//resize image height , width

				$resizeWidth = 200;

				$resizeHeight = 150;

				$resizeDir = 'multimage/img_100X100/';
                

				$multi_imgname   = $_FILES['fileToUpload']['name'];

				$multi_extension = explode('.', $multi_imgname);  

				$mimg_ext        = strtolower(end($multi_extension));

				//new multi image name 

				$mimgpre       = 'PRODIMG'.rand(1000,9999);

				$image  = $mimgpre.time().".".$mimg_ext;

				//print_r($multi_extension);
				 move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"assets/uploadedimages/".$image);
				$this->smart_resize_image($todir . basename($image) , null, $resizeWidth , $resizeHeight , true , $resizeDir . basename($image) , false , false ,100 );
				

                $productData_insert = array(

                    'uid'               => $logged_userid,

                    'bid'               => $businessId,

                    'title'             => $title,

                    'description'       => $description,

                    'quantity'          => $quantity,

                    'postedon'          => $postedon,

                    'keywords'          => $keywords,

                    'location'          => $location,

                    'min_order'         => $min_order,

                    'price_cur_id'      => $price_cur_id,

                    'min_price'             => $maxproduct_sell_price,
					'min_price'             => $minprice,
				    'max_price'             => $maxprice,
					'min_sell_price'       => $minproduct_sell_price,
				    'max_sell_price'       => $maxproduct_sell_price,
                    'supplier_price'=> $maxproduct_sell_price,
					'price'=> $maxproduct_sell_price,
                    'samples_available' => $samples_available,

                    'product_status'    => $product_status,

                    'delivery_time'     => $delivery_time,

                    'payment_mode'      => $payment_mode,

                    'other_mode'        => $other_mode,

                    'shipping_cost'     => $shipping_cost,

                    'approved'          => $approved,

                    'new'               => $new,

                    'image'             => $image,

                    'origin'            => $origin,

                    'material'          => $material,

                    'function'          => $function,

                    'quality'           => $quality,

                    'brand_name'        => $brand_name,

                    'brand_id'          => $product_brand_id ? $product_brand_id:1000,

                    'cbrand_name'       => $cbrand_name,

                    'model_number'      => $model_number,

                    'color'             => $color,

                    'type'              => $type,

                    'featured'          => $features,

                    'expireson'         => $expireson, 

                 //   'supplier_price'    => $price,

                    'admin_percent'     => $ADMIN_PERCENTAGE,

                    'qty_unit'          => $qty_unit,

                    'created_on'        => $created_on,

                );

				
                //insert product in product table

                $prodctid =$this-> Site_model->add($product_table, $productData_insert);

                

                //checks if product inserted & return last product id

                if($prodctid){

                    //===== insert product category =======
								    $slider_target_path = "assets/multimage/"; //Declaring Path for uploaded images
                                    
                                    // Send Main Product image Copy To Multimage Folder
                            
                                                for ($i = 0; $i < count($_FILES['file']['name']); $i++) 

                                                    {
                                                        $str_time = $i.time();
                                                        $image2  = $str_time .$_FILES['file']['name'][$i];
                                                        if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $slider_target_path . $image2)){
                                                        $multi_images=array(
															'img_url'=> $image2,
															'offer_id'=>$prodctid,
															'uid'=>$logged_userid,
															);
                                                        $multi_data =$this->Site_model->add( "bt_product_images",$multi_images);

                                                        }    

                                                    }
                    //=== upload products multi image & insert in table :: Ends ===



                 

                    $success_msg = "<div class='alert alert-success'>Product Posted Successfully. Product will display After Admin Approval.</div>";

                    $FlashMessages=$success_msg;

                    // if product inserted :: Ends                

                }else{

                    //if failed to insert products

                    $msg_txt = "Sorry,Due to Some Error unable to post product.";

                    $FlashMessages=$msg_txt;

                } 

               // header("location:".$current_page_link;

              //  die();

            }

            // dulicates check ends

        } else{

            $FlashMessages="<div class='alert alert-danger'>Duplicate Entry! Product Already Exists.</div>";

          //  header("location:".$current_page_link);die();

        }

        //membership plan exceeded check ends..

    } else {

        $FlashMessages="<div class='alert alert-info'>You Are Not Allowed To Post Product.</div>";

        //header("location:".$current_page_link);die();

    }

    // if form posted ends here in below brace
 
echo $FlashMessages;

	  }
	   function process_edit_featured_product(){
		               $id = $_POST["id"];
					   $sliderImage=$_FILES["file"]["name"];
           $new_product_id=$id;
           $product_uid=$this->session->userdata['logged_in']['user_id'];
                     	 if($sliderImage){
							 $slider_target_path = "assets/multimage/"; //Declaring Path for uploaded images

                                    // Send Main Product image Copy To Multimage Folder
                            
							for ($i = 0; $i < count($_FILES['file']['name']); $i++) 

								{
									$str_time = $i.time();
									$image2  = $str_time .$_FILES['file']['name'][$i];
									if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $slider_target_path . $image2)){
										//copy($_FILES['file']['tmp_name'][$i], $target_path.basename($_FILES['file']['name'][$i]));
									$multi_images=array(
										'img_url'=> $image2,
										'offer_id'=>$new_product_id,
										'uid'=>$product_uid,
										);
										
									$multi_data =$this->Site_model->add( "bt_product_images",$multi_images);

									}    

								}
							 
							 }
                        //$cat_list = str_replace(";", ",", $_POST["category"]);
                        //$cid_list = str_replace(";", ",", $_POST["cid"]);
                        
                        $cat_list ="";$cid_list="";
                        if(isset($_POST["category"])){
                            $cat_list = str_replace(";", ",", $_POST["category"]);
                        }
                        if(isset($_POST["cid"])){
                            $cid_list = str_replace(";", ",", $_POST["cid"]);
                        }
                        $wholesale_item=0;
                      $logged_user_planid = $this->session->userdata['logged_in']['memtype'];
		              $prev='bt_';
					  $ADMIN_PERCENTAGE=10;
                        $cat = explode(",", $cid_list);
                        //$cat_name=explode(",",$_POST["category"]);

                        $title = $_POST["title"];
                        $description = $_POST["description"];
                        $quantity = $_POST["quantity"];
                        $keywords = $_POST["keywords"];
                        $key = explode(",", $keywords);
                        $qty_unit= $_POST["product_units"];
                        $origin = $_POST["origin"];
                        $material = $_POST["material"];
                        $function = $_POST["function"];
                        $brand_name = $_POST["brand_name"];
                        $quality = $_POST["weight"];
                        $cbrand_name = $_POST["cbrand_name"];
                        $model_number = $_POST["model_number"];
                        $color = $_POST["color"];
                        $type = $_POST["type"];
                        $featured = $_POST["features"];
                        $expireson = date("Y-m-d", strtotime($_POST['expireson']));
                        $location = $_POST["location"];
                        $min_order = $_POST["min_order"];
                        $price_cur_id = $_POST["price_cur_id"];

                        $price              = $_POST["price"];                  // SUPPLIER PRICE
                        $product_sell_price = $_POST["product_sell_price"];     // PRODUCT SELLING PRICE
                        $minprice = $_POST["minprice"];     // PRODUCT SELLING PRICE
                        $maxprice              = $_POST["maxprice"];                  
						$min_sell_price              = $_POST["minproduct_sell_price"];                  
						$max_sell_price = $_POST["maxproduct_sell_price"];  
                        $samples_available = $_POST["samples_available"];
                        $product_status = $_POST["product_status"];
                        $errcnt=0;
						 $delivery_time = 0;
						 if (!is_numeric($min_order) || ($min_order <= 0)) {
                            $message= '<div class="alert alert-danger">Minimum Order must be non-zero positive integer</div>';
                            $errcnt++;
                        }

                         if (!is_numeric($price_cur_id) || ($price_cur_id == 0)) {
                            $message = '<div class="alert alert-danger">Price currency must be selected</div>';
                            $errcnt++;
                        }
						
						   if ($errcnt == 0) 
                        {
                            $min_order = (int) $min_order;
                            $price_cur_id = (int) $price_cur_id;
                            $price = $price;

                            //$delivery_time = (int) $delivery_time;
                            $delivery_time = "";
                            $shipping_cost = $shipping_cost;

                            $uid =$this->session->userdata['logged_in']['user_id'];

                            if ($sbrow_con['approval_type_offer'] == 'auto') 
                            {
                                $approved = 'yes';
                                $message = '<div class="alert alert-success">Your product catalog has been updated.</div>';
                            } 
                            else 
                            {
                                $approved = 'no';                                                           
                            }
							
							
							 $newfile=$_FILES["fileToUpload"]["name"];
							 
							 $mainImageNewName =$newfile ? $newfile:$_POST["change_image"];
							 if($newfile){
							 $allow  = array("jpg", "jpeg", "gif", "png");

							$todir  = 'assets/uploadedimages/';

							$todir1 = 'assets/multimage/';
							//resize image height , width

							$resizeWidth = 200;

							$resizeHeight = 150;

							$resizeDir = 'multimage/img_100X100/';
							

							$multi_imgname   = $_FILES['fileToUpload']['name'];

							$multi_extension = explode('.', $multi_imgname);  

							$mimg_ext        = strtolower(end($multi_extension));

							//new multi image name 

							$mimgpre       = 'PRODIMG'.$new_product_id.rand(1000,9999);

							$image  = $mimgpre.time().".".$mimg_ext;

							 $mainImageNewName=$image;
							//print_r($multi_extension);
							 move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"assets/uploadedimages/".$image);
							
							$this->smart_resize_image($todir . basename($image) , null, $resizeWidth , $resizeHeight , true , $resizeDir . basename($image) , false , false ,100 );
							
							$multiimg_dataArr = array(
                                            'img_url'     => $image,
                                            'uid'         => $uid,
                                            'default_img' => 1,
                                        );
										$where=" offer_id=$id";
							 $upimagedata =$this->Site_model->update( "bt_product_images",$multiimg_dataArr,$where);
							 
						
							 }
						
 
							  $product_data=array(
									 
									'title'=>$title,
									'description'=>$description,
									'quantity'=>$quantity,
									'postedon'=>$postedon,
									'keywords'=>$keywords,
									'location'=>$location, 
									'min_order'=>$min_order,
									'price_cur_id'=>$price_cur_id, 
									'price'=>$max_sell_price,
									'min_price'=>$minprice,
									'max_price'=>$maxprice,
									'min_sell_price'=>$min_sell_price,
									'max_sell_price'=>$max_sell_price,
									'samples_available'=>$samples_available,
									'product_status'=>$product_status, 
									'delivery_time'=>$delivery_time,
									'payment_mode'=>$payment_mode, 
									'other_mode'=>$other_mode, 
									'shipping_cost'=>$shipping_cost , 
									'qty_unit'=>$qty_unit,
									'new'=>$new, 
									'image'=>$mainImageNewName,
									'origin'=>$origin,
									'material'=>$material,
									'function'=>$function,
									'brand_name'=> $brand_name,
									'quality'=>$quality,
									'cbrand_name'=>$cbrand_name,
									'model_number'=>$model_number,
									'color'=>$color,
									'type'=>$type,
									'featured'=>$features,
									'expireson'=>$expireson,
									'supplier_price'=>$price,
									'admin_percent'=>$ADMIN_PERCENTAGE,
									'wholesale'=>$wholesale_item
									);
                              $where="id=" . $id . "  and uid=" . $uid;
							 
							//print_r($product_data);exit;
							  
                              $product_update=$this->Site_model->update('bt_products',$product_data,$where);
							 $ctid1 = $_POST['ctid'];
                  
				     if (isset($_POST['subctid']) && $_POST['subctid'] != "") 
                            {
                                
								 $update_cat_data=array(
										'cid'=>$_POST['subctid']
										);
								 $where=" offer_id='" . $id . "'";
								 
								  $catupdt =$this->Site_model->update( "bt_product_cats",$update_cat_data,$where);

                            }
                            else 
                            {
								 $update_cat_data=array(
										'cid'=>$_POST['ctid']
										);
										
								  $where=" offer_id='" . $id . "'";
								  $catupdt =$this->Site_model->update( "bt_product_cats",$update_cat_data,$where);

                            }

                    if ($product_update) {

                                if (!empty($_POST['product_qty']) && !empty($_POST['product_price'])) {

                                    $delprice_cond = "bt_w_product_id = '$product_id'";
                                    $delete_price_return =$this->Site_model->delete('bt_wholesale_product_price',$delprice_cond);

                                    if($delete_price_return){
                                        foreach ($_POST['product_qty'] as $key => $value) {
                                           
                                            $p_price =  $_POST['product_price'][$key];
                                            $whole_sell_price =  $_POST['whole_sell_price'][$key];

											  $data4=array(
											'bt_w_product_id'=> $prodctid,
											'bt_w_qty'=>$_POST['product_qty'],
											'bt_w_price'=>$p_price ,
											'bt_w_sell_price'=>$whole_sell_price,
											);	
                                       $data =$this->Site_model->add("bt_wholesale_product_price",$data4);  
                                        }
                                    }
                                }
                              
                                $message = '<div class="alert alert-success">Success ,product edited successfully</div>';      
                            } else {
                                $message = '<div class="alert alert-danger">An Error occured while editing the product</div>';
                            }
						
						}
						echo $message;
  }
  
  function edit_company_Info(){
	                 $prev="bt_";
	                $errcnt = 0;
                    $config = $this->Site_model->getcountRecods("select * from " . $prev . "config");



                    $sql = "Select * from " . $prev . "groups where memtype=" . $this->session->userdata['logged_in']["memtype"];

                   // $rs0_query  = mysql_query($sql);

                    $rs0        = $this->Site_model->getcountRecods($sql);



                    $cats       = $rs0["profilecat_cnt"];

                    $allowed    = $rs0["profile"];

                    $posturl    = $rs0["posturl"];

                    $posted_list1 = "";

                    $sub_cat    = "";

                    $mkt        = "";




                  

                        $companyname  = str_replace("$", "\$", $_POST["companyname"]);

                        $cemail       = str_replace("$", "\$", $_POST["cemail"]);

                        $logo         = str_replace("$", "\$", $_POST["list1"]);

                        $services     = str_replace("$", "\$", $_POST["services"]);

                        $yearestablished = str_replace("$", "\$", $_POST["yearestablished"]);

                        $othermarkets = str_replace("$", "\$", $_POST["othermarkets"]);

                        $companyprofile = str_replace("$", "\$", $_POST["companyprofile"]);

                        $cat          = str_replace("$", "\$", addslashes($_POST["cid"]));

                        $ceo          = str_replace("$", "\$", $_POST["ceo"]);

                        $phone        = str_replace("$", "\$", $_POST["phone"]);



                        $phone2       = str_replace("$", "\$", $_POST["phone2"]);



                        $fax2         = str_replace("$", "\$", $_POST["fax2"]);

                        $website      = str_replace("$", "\$", $_POST["website"]);



                        $website      = str_replace("$", "\$", addslashes($_POST["website"]));

                        $address1     = str_replace("$", "\$", addslashes($_POST["address1"]));

                        $address2     = str_replace("$", "\$", addslashes($_POST["address2"]));

                        $address3     = str_replace("$", "\$", addslashes($_POST["address3"]));

                        $about        = str_replace("$", "\$", addslashes($_POST["about"]));

                        $about        = htmlentities($about, ENT_QUOTES);



                        $mobile       = str_replace("$", "\$", addslashes($_POST["mobile"]));

                        $zip          = str_replace("$", "\$", addslashes($_POST["zip"]));



                        if (isset($_POST['posting_subcat'])) {

                            $sub_cat = implode(",", $_POST['posting_subcat']);

                        }

                        if (isset($_POST['market'])) {

                            $mkt = implode(",", $_POST['market']);

                        }

                        if (isset($_POST['type'])) {

                            $business = implode(",", $_POST['type']);

                        }


                   



                    $fax_no = "";







                    if (strlen(trim($fax2)) <> 0) {  $fax_no .= $fax2;  }



                     

                        $markets = "0";

                        $rs_query_t =$this->Site_model->getcountRecods("select * from " . $prev . "markets order by market");



                        $cnt = 1;

                        foreach ($rs_query_t as $rs_t) 

                        {

                            $indx = "market" . $cnt;

                            $cnt++;

                            if (isset($_POST[$indx])) {

                                $markets = ($markets == 0) ? $rs_t["id"] : $markets . "," . $rs_t["id"];

                            }

                        }

                        $markets_arr = explode(",", $markets);



                        if (isset($_POST["category"])) {

                            $cat_name = str_replace(";", ",", $_POST["category"]);

                        }



                        $sbcid_list = str_replace(";", ",", $_POST["cid"]);

                        $cat = explode(",", $sbcid_list);

                        $business_type = "";

                        if (isset($_POST["business_type"])) {

                            $business_type = implode(',', $_POST["business_type"]);

                        }

                        //print_r($business_type);exit;

                        if (strlen(trim($companyname)) == 0) {

                           $msg= "<div class='alert alert-danger'>Company Name must be provided</div>";

                            $errcnt++;

                        } 

                        elseif (preg_match("/[;<>&]/", $_POST["companyname"])) 

                        {

                            $msg= "<div class='alert alert-danger'>Company Name can not have any special character (e.g. & ; < >)</div>";

                            $errcnt++;

                        }



                        if ($business_type == "" )

                        {

                          $msg="<div class='alert alert-danger'>Business Type must be choosen</div>";

                          $errcnt++;

                      }





                      if ($_POST["cid"] == "") 

                      {

                        $msg = "<div class='alert alert-danger'>Atleast one Category must be provided</div>";

                        $errcnt++;

                    }



                      if ($errcnt == 0) 

                      {

                        $approved = "Y";

                       
							         //$flash_msg->success("Company Profile has been updated.");

                        if ($config["profile_approval"] == "admin") 

                        {

                            $approved = "N";

                            $msg= '<div class="alert alert-success">Company Profile has been sent for admin approval.</div>';

								        //$flash_msg->success("Company Profile has been sent for admin approval.");

                        }



                        $profile_id = $_POST["profile_id"];



                        if ($_POST["profile_id"] == 0 || $_POST["profile_id"] == "") 

                        {

                            if ($approved == "N") { $approved = "Y"; }

                                   $logo=$_FILES['list1']['name'];
                                if ($logo == '') {

                                    $image = $_POST['change_image'];

                                } else {

                            $multi_imgname   = $_FILES['list1']['name'];

							$multi_extension = explode('.', $multi_imgname);  

							$mimg_ext        = strtolower(end($multi_extension));

							//new multi image name 

							$mimgpre       = 'Logo'.rand(1000,9999);

							$image  = $mimgpre.time().".".$mimg_ext;

							 $mainImageNewName=$image;
							//print_r($multi_extension);
							 move_uploaded_file($_FILES['list1']['tmp_name'],"assets/uploadedimages/".$image);
							
                                }


                            $bizdata = array( 
							'company_name'=>$companyname,
							'email'=>$cemail,
							'services'=>$services,
							'companyprofile'=>$companyprofile,
							'about'=>$about,
							'address1'=>$address1,
							'address2'=>$address2,
							'address3'=>$address3,
							'city'=>$city,
							'state'=>$state,
                            'country'=>$country,
							'zip'=>$zip,
							'phone'=>$_POST['phone'],
							'phone2'=>$_POST['phone2'],
							'fax'=>$fax_no,
							'mobile'=>$mobile,
							'website'=>$website,
							'cat_id'=>$_POST['cid'],
							'sub_cat_id'=>$sub_cat,
							'user_id'=>$this->session->userdata['logged_in']['user_id'],
							'date'=>date("Y-m-d"),
							'company_logo'=>$_FILES['list1']['name'],
							'ceo'=>$ceo,
							'employees'=>$_POST["employees"],
							'year_established'=>$yearestablished,
							'othermarkets'=>$othermarkets,
							'markets'=>$mkt,
							'productfocus'=>$_POST["productfocus"],
							'reg_date'=>date("Y-m-d"),
							'last_modified'=>date("Y-m-d"),
							'last_login'=>date("Y-m-d h:i:s"),
							'approved'=>'Y',
							'businesstypes'=>$business_type
							);

		
                         $inserted =$this->Site_model->add('bt_business set', $bizdata);
                            //mysql_query($insert_query);
						}
						
                                $approved = "Y";

                                $msg = 'Company Profile has been updated.';

                                $config = $this->Site_model->getcountRecods("select * from " . $prev . "config");

                                if ($config["profile_approval"] == "admin") {

                                    //$approved = "N";

                                    //$msg = 'Company Profile has been sent for admin approval.';

                                }


                                $logo=$_FILES['list1']['name'];
                                if ($logo == '') {

                                    $image = $_POST['change_image'];

                                } else {

                                    $multi_imgname   = $_FILES['list1']['name'];

									$multi_extension = explode('.', $multi_imgname);  

									$mimg_ext        = strtolower(end($multi_extension));

									//new multi image name 

									$mimgpre       = 'Logo'.rand(1000,9999);

									$image  = $mimgpre.time().".".$mimg_ext;

									 $mainImageNewName=$image;
									//print_r($multi_extension);
									 move_uploaded_file($_FILES['list1']['tmp_name'],"assets/uploadedimages/".$image);
									

                                }


								//print_r($image);exit;
                           $bizUpdata = array( 
							'company_name'=>$companyname,
							'email'=>$cemail,
							'services'=>$services,
							'companyprofile'=>$companyprofile,
							'about'=>$about,
							'address1'=>$address1,
							'address2'=>$address2,
							'address3'=>$address3,
							'city'=>$city,
							'state'=>$state,
                            'country'=>$country,
							'zip'=>$zip,
							'phone'=>$_POST['phone'],
							'phone2'=>$_POST['phone2'],
							'fax'=>$fax_no,
							'mobile'=>$mobile,
							'website'=>$website,
							'cat_id'=>$_POST['cid'],
							'sub_cat_id'=>$sub_cat,
							'date'=>date("Y-m-d"),
							'company_logo'=>$image,
							'ceo'=>$ceo,
							'employees'=>$_POST["employees"],
							'year_established'=>$yearestablished,
							'othermarkets'=>$othermarkets,
							'markets'=>$mkt,
							'productfocus'=>$_POST["productfocus"],
							'reg_date'=>date("Y-m-d"),
							'last_modified'=>date("Y-m-d"),
							'last_login'=>date("Y-m-d h:i:s"),
							'filled_updated'=>1,
							'approved'=>'Y',
							'businesstypes'=>$business_type
							);

                          $where="user_id='" . $this->session->userdata['logged_in']['user_id'] . "'";


                           $r = $this->Site_model->update($prev . "business set",$bizUpdata,$where);
                                if (!empty($r)) {
/*
                                    if ($_FILES['list1']['name'] != "") {



                                        $allowed_ext = array("jpg", "jpeg", "png", "gif");



                                        $extension = explode('.', $_FILES["list1"]["name"]);



                                        $ext = strtolower(end($extension));



                                        if (in_array($ext, $allowed_ext)) {

                                            $newname = rand(10000, 99999) . "_" . time() . "." . $ext;

                                            //$loc = "uploadedimages/" . $newname;

                                            $loc = "uploadedimages/" . $newname;

                                            move_uploaded_file($_FILES["list1"]["tmp_name"], "./" . $loc);

                                            $sql_bn = "UPDATE " . $prev . "business SET company_logo='" . $newname . "' WHERE user_id='" . $_SESSION['user_id'] . "'";

                                            mysql_query($sql_bn);

                                        }

                                    }

									*/
                               
                               $msg = '<div class="alert alert-success">Company Profile has been updated.</div>';

							   }else{
								   $msg = '<div class="alert alert-danger">An error occured when editing the Company profile</div>';
							   }


						
					 

					  }
					  
					  echo $msg;
					

  }
	  
	 function process_post_banner(){
		 
    $allow = array("jpg", "jpeg", "gif", "png");

     $todir ='assets/company_banner/';
		$info = explode('.', strtolower( $_FILES['fileToUpload']['name']) ); // whats the extension of the file
        if ( in_array( end($info), $allow) ) // is this file allowed

        {

          if ( move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $todir . basename($_FILES['fileToUpload']['name'] ) ) )

          {

          $images = $_FILES["fileToUpload"]["name"] ;



		  $uid=$_SESSION['user_id'];

		  $c_id=" SELECT id FROM `bt_business` WHERE `user_id` = ".$this->session->userdata['logged_in']['user_id'];

		  $c_id_2 = $this->Site_model->getcountRecods($c_id);

	
           $banner_arrays=array(
		   'banner_images'=>$images
		   );
		   $where="`id`='".$c_id_2[0]['id']."'";
		   $r =$this->Site_model->update("`bt_business`",$banner_arrays,$where);
          if($r){
			  $msg="<div class='alert alert-success'>Success,the banner has been changed</div>";
		  }else{
			$msg="<div class='alert alert-danger'>An error occured while editing the banner</div>";  
		  }
		  }else{
			$msg="<div class='alert alert-danger'>An error occured while uploading the image</div>";   
		  }
		  }else{
			$msg="<div class='alert alert-danger'>Please upload a correct image</div>";   
		  }
		echo $msg;

}  

 function processmapLoc(){
	
		$locaArray=array(
		'location'=>$_REQUEST['add_com_location']
		);
	      $where="user_id=".$this->session->userdata['logged_in']['user_id'];
		  $rec_com_location =$this->Site_model->update("bt_business",$locaArray,$where);
		
		  if($rec_com_location != "") {
			$msg ="<div class='alert alert-success'>Data updated successfully..</div>";
		  }else{
			$msg ="<div class='alert alert-danger'>An Error occured while updating location..</div>"; 
		  }
		
   echo $msg;
 }
 
 function process_min_banner(){
	   $allowed_file = array("jpg", "jpeg", "gif", "png");
       $upload_dir = 'assets/company_banner/';
	   $logged_userid=$this->session->userdata['logged_in']['user_id'];
	  $getBusinessData = $this->Site_model->getRowData('bt_business',"user_id ='$logged_userid'");
	  $getBusinessData=$getBusinessData[0];
	  $business_id     = $getBusinessData['id'];
  //is the file uploaded yet?  
  if ($_FILES['fileToUpload']['tmp_name'] ) 
  {
    $uploaded_filename = $_FILES['fileToUpload']['name'];

    $ext_info = explode('.', strtolower( $uploaded_filename) );
    $extension = end($ext_info); 
    //checks if this file allowed 
    if ( in_array($extension, $allowed_file) ) 
    {
      $timestmp = time();
      //new file name
      $tmp_name = "BBNR".$business_id.rand('100','999').'_';
      $newfile_name = $tmp_name.$timestmp.'.'.$extension;  
      //upload file
      if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upload_dir.$newfile_name ) )
      {
        $banner_data = array(
            'business_id'   => $business_id,
            'banner_image'  => $newfile_name,
            'banner_status' => 'N',
            'banner_addedon'=> $timestmp
          );
        $inserted_data = $this->Site_model->add('bt_business_banners', $banner_data);
        if($inserted_data){
          $flashmsg="<div class='alert alert-success'>Banner Uploaded Successfully.Please Change status to Show in website.</div>";
        }else{
          $flashmsg="<div class='alert alert-danger'>Failed to Upload due to some issues.</div>";
        }
      }
    }else{
      //if file type not allowed
      $flashmsg="<div class='alert alert-danger'>Uploaded File Format Not Allowed.</div>";
    }      
  }else{
	  $flashmsg="<div class='alert alert-danger'>Please upload the file.</div>";  
  }
 echo $flashmsg;
	 
 }
 
 function setbunner($bnr=null){
	 //======== Insert new  banner ::   Ends =========
//========  Update Banner Status :: Starts ========
if(isset($bnr) && !empty($bnr)){
  $bnr_id = $bnr;
  $prev="bt_";
  $businessTable        = $prev."business";
  $businessBannersTable = $prev."business_banners";
  $getStatus = $this->Site_model->getRowData($businessBannersTable,"banner_id='$bnr_id'");
  $getStatus=$getStatus[0];
  if($getStatus['banner_status']=='Y'){
    $newStatus = 'N';
  }else{$newStatus ='Y';}
  //update banner
  $data=array('banner_status'=> $newStatus);
  $updted = $this->Site_model->update($businessBannersTable,$data,"banner_id='$bnr_id'");
  if($updted=='DONE'){
    $flashmsg="<div class='alert alert-success'>Status Updated Successfully.</div>";
  }else{
    $flashmsg="<div class='alert alert-danger'>Failed to Update Status.</div>";
  }

}
 echo  $flashmsg;
 }

    function delete_wishlist()
    {
        $product_id = $_POST['product'];
        $deleted = $this->Site_model->delete("bt_favourite_list", "fev_id='$product_id'");
        if($deleted){
            echo 1;
        }else{
            echo 0;
        }
    }
        function delet_banner($bnrdel=null){
  $businessBannersTable ="bt_business_banners";
  $bnr_id = $bnrdel;
  $deleted =$this->Site_model->delete($businessBannersTable, "banner_id='$bnr_id'");
  
  if($deleted){
    $getBannerImage =$this->Site_model->getRowData($businessBannersTable,"banner_id='$bnr_id'");
	$getBannerImage=$getBannerImage[0];
    $oldbanner = $getBannerImage['banner_image'];
    if(file_exists('assets/company_banner/'.$oldbanner)){
      @unlink("assets/company_banner/".$oldbanner);
    }

    $flashmsg="<div class='alert alert-success'>Deleted Successfully.</div>";
  }else{
    $flashmsg="<div class='alert alert-danger'>Failed to Delete Banner.</div>";
  } 
	
echo $flashmsg;	
 }

 function update_company_Overview(){
 $business_id = $_POST['business_id'];
  $bustypes = implode(",", $_POST['business_type']);
  $buis_updt =array(
    'employees'        => $_POST['employees'], 
    'year_established' => $_POST['yearestablished'], 
    'certifications'   => $_POST['certifications'], 
    'anual_revenue'    => trim($_POST['anual_revenue']), 
    'businesstypes'    => $bustypes, 
  );
  $return = $this->Site_model->update('bt_business', $buis_updt,"id='$business_id'");
  if(!empty($return)){
        $msg="<div class='alert alert-success'>Edited  Successfully.</div>";
      }else{
        $msg="<div class='alert alert-danger'>An Error Occured during edit.</div>";
      } 
	  echo $msg;
 }
 function update_company_Certification(){
	 $prev="bt_";
	 $file_name = $_FILES['image']['name'];
	 if(isset($_FILES['image'])){
	  $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $msg="extension not allowed, please choose a JPEG or PNG file.";
		 $errors[]=$msg;
      }
      
      if($file_size > 2097152){
         $msg='File size must be excately 2 MB';
		  $errors[]=$msg;
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"assets/company_banner/minisite_images/".$file_name);
       $msg="<div class='alert alert-success'>Moved Successfully.</div>";
      }else{
       $msg="<div class='alert alert-danger'>An Error Occured while uploading certifications.</div>";
      } 
	 }
	 $busi_uid = $_POST['busi_uid'];
	  $cerifi_updt =array(
		'mini_user_id'          => $busi_uid, 
		'mini_verification_type'=> $_POST['verification_type'], 
		'mini_verification_desc'=> $_POST['verification_desc'], 
		'mini_license_no'       => $_POST['licence_number'], 
		'mini_image'            => $file_name,
		'operational_address'   => $_POST['operational_address'],  
	  );

  //$images = $_FILES["mini_certify_banner"]["name"]
  //p($cerifi_updt,1);

  $checkif_exists = $this->Site_model->getRowData($prev.'minisite_indus_certify',"mini_user_id='$busi_uid'");
  if(!empty($checkif_exists)){

    $del_return =$this->Site_model->delete($prev.'minisite_indus_certify',"mini_user_id ='$busi_uid'");
    if($del_return){
      $return =$this->Site_model-> add($prev.'minisite_indus_certify', $cerifi_updt);

      if(!empty($return)){$msg="<div class='alert alert-success'>Updated Successfully</div>";}
      else{$msg="<div class='alert alert-danger'>Failed to Update</div>";}
      
    } 
  }else{
    $return = $this->Site_model-> add($prev.'minisite_indus_certify', $cerifi_updt);
    
    if(!empty($return)){$msg="<div class='alert alert-success'>Updated Successfully</div>";}
    else{ $msg="<div class='alert alert-danger'>Failed to Update</div>";}
  }
	  echo $msg;
 }
 
 function process_edit_profile(){
	 if(!isset($this->session->userdata['logged_in']['user_id'])){
			header('location:'.base_url().'login');}
			else{
	                 $prev="bt_";
                    if (isset($_POST['upload']) && $_POST['upload'] == "Upload") {  //IF SOME FORM WAS POSTED DO VALIDATION

                        $COURIER_DOC_ID = $_POST['user_doc_id1'];

                        $COURIER_DOC_TITLE = $_POST['user_doc_title1'];

                        if ($_FILES["user_doc_upload1"]["name"] != '') {

                            $COURIER_UPLD_DOC = $_FILES["user_doc_upload1"]["name"];

                        } else {

                            $COURIER_UPLD_DOC = '';

                        }

                        if ($COURIER_UPLD_DOC != "") {

                            $UPLD_allowed_ext = array("jpg", "jpeg", "png", "gif");



                            $UPLD_extension = explode('.', $COURIER_UPLD_DOC);



                            $ext = strtolower(end($UPLD_extension));



                            if (in_array($ext, $UPLD_allowed_ext)) {

                                $docsnewname = time() . "." . $ext;

                                $loc = "assets/uploadedcourier_documents/" . $docsnewname;

                                move_uploaded_file($_FILES["user_doc_upload1"]["tmp_name"], $loc);



                                if ($COURIER_DOC_ID != "") {

								$datacurrirArray=array(
								'doc_title'=>$COURIER_DOC_TITLE 
								);
								$where="courier_id=".$this->session->userdata['logged_in']['user_id'];
								
								$courier_sql_bn=$this->Site_model->update('bt_courier_details',$datacurrirArray,$where);
                                    
                                } else {

								$insertData=array(
								'doc_title'=>$COURIER_DOC_TITLE,
								'courier_id'=>$this->session->userdata['logged_in']['user_id'],
								'doc_path'=>$docsnewname
								);
								
								$courier_sql_bn=$this->Site_model->add('bt_courier_details',$insertData);
                                 

                                }

                            }

                        }

                    }
                    $errcnt = 0;

                        $firstname = str_replace("$", "\$", $_REQUEST["firstname"]);

                        $lastname = str_replace("$", "\$", $_REQUEST["lastname"]);

                        $street = str_replace("$", "\$", $_REQUEST["street"]);

                        $city = str_replace("$", "\$", $_REQUEST["city"]);

                        $phone = str_replace("$", "\$", $_REQUEST["phone"]);

                        $fax = str_replace("$", "\$", $_REQUEST["fax"]);

                        $mobile = str_replace("$", "\$", $_REQUEST["mobile"]);

                        $email = str_replace("$", "\$", $_REQUEST["email"]);

                        $zip_code = str_replace("$", "\$", $_REQUEST["zip_code"]);

                        $address = str_replace("$", "\$", $_REQUEST["address"]);



                        $state = str_replace("$", "\$", $_REQUEST["state"]);

                        $country = str_replace("$", "\$", $_REQUEST["country"]);



                        $fax_no = "";

                        if (strlen(trim($fax)) <> 0) {

                            $fax_no .= $fax;

                        }

                        $fax_no .= "-";





                        if (strlen(trim($firstname)) == 0) {

                                   $msg= "<div class='alert alert-danger'>Firstname must be provided</div>";

                            $errcnt++;

                        } elseif (preg_match("/[;<>&]/", $_REQUEST["firstname"])) {

$msg = "<div class='alert alert-danger'>Firstname can not have any special character (e.g. & ; < >)</div>";

                            $errcnt++;

                        }



                        if (strlen(trim($lastname)) == 0) {

                            $errs[$errcnt] = "Lastname must be provided";

                           

                        } elseif (preg_match("/[;<>&]/", $_REQUEST["lastname"])) {
$msg = "<div class='alert alert-danger'>Lastname can not have any special character (e.g. & ; < >)</div>";

                           

                        }



                        if (strlen(trim($street)) == 0) {

                            $errs[$errcnt] = "Street must be provided";

                           

                        } elseif (preg_match("/[;<>&]/", $_REQUEST["street"])) {

 $msg = "<div class='alert alert-danger'>Street can not have any special character (e.g. & ; < >)</div>";

                           

                        }



                        if (strlen(trim($city)) == 0) {

                            $errs[$errcnt] = "City must be provided";

                           

                        } elseif (preg_match("/[;<>&]/", $_REQUEST["city"])) {

 $msg = "<div class='alert alert-danger'>City can not have any special character (e.g. & ; < >)</div>";

                           

                        }



                        if (strlen(trim($zip_code)) == 0) {

   $msg= "<div class='alert alert-danger'>Zip/Postal Code must be provided</div>";

                           

                        } elseif (preg_match("/[;<>&]/", $_REQUEST["zip_code"])) {

							$msg = "<div class='alert alert-danger'>Zip/Postal Code can not have any special character (e.g. & ; < >)</div>";


                           

                        }





                        if (preg_match("/[;<>&]/", $phone_no)) {

                            $msg = "<div class='alert alert-danger'>Phone No. can not have any special character (e.g. & ; < >)</div>";

                           

                        }



                        if (preg_match("/[;<>&]/", $fax_no)) {

                              $msg = "<div class='alert alert-danger'>Fax can not have any special character (e.g. & ; < >)</div>";

                           

                        }



                        if (preg_match("/[;<>&]/", $mobile)) {

                            
                          $msg = "<div class='alert alert-danger'>Mobile can not have any special character (e.g. & ; < >)</div>";

                            

                        }



                        if ($errcnt == 0) {
                            $config =  $this->Site_model->getcountRecods("select * from " . $prev . "config");
                            $config=$config[0];


                            if ($config["mem_approval"] == "admin") {

                                $suspended = "no";

                            }


							$data_member=array(
                            'firstname'=>$firstname ,

                            'lastname'=>$lastname, 

                            'street'=>$street, 

                            'city'=>$city, 

                            'state'=>$state, 

                            'country'=>$country, 

                            'zip'=>$zip_code, 

                            'phone'=>$phone_no, 

                            'fax'=>$fax_no,

                            'email'=>$email, 

                            'mobile'=>$mobile,

                            'owner_name'=>$owner_name, 

                            'oper_area '=>$op_area,

                            'address'=>$address	

							);
							
							$where ="user_id=" . $this->session->userdata['logged_in']['user_id'];
                           

						   //print_r($data_member);
                          $member_update=$this->Site_model->update($prev . "members",$data_member,$where);
    
                            if ($_FILES["user_img"]["name"] != '') {

                                $userimg = $_FILES["user_img"]["name"];

                            } else {

                                $userimg = '';

                            }
							  if ($member_update) {

                                if ($userimg != "") {

                                    $allowed_ext = array("jpg", "jpeg", "png", "gif");



                                    $extension = explode('.', $userimg);



                                    $ext = strtolower(end($extension));



                                    if (in_array($ext, $allowed_ext)) {

                                        $newname = time() . "." . $ext;
                                        $loc = "assets/uploadedimages/" . $newname;

                                        move_uploaded_file($_FILES["user_img"]["tmp_name"], $loc);

										$data=array(
										'user_img'=>$newname
										);
										$where="user_id=".$this->session->userdata['logged_in']['user_id'];
										
                                      $member_update=$this->Site_model->update($prev . "members",$data,$where);
                               

                                    }

                                }





                                $msg = "<div class='alert alert-success'>Records has been updated successfully</div>";

                            }
							else{
								  $msg = "<div class='alert alert-danger'>EArror Occured</div>";
							}

						}
					
					echo $msg;
			}


 }
 
 function process_payment(){
	

    $uid = $this->session->userdata['logged_in']['user_id'];

    $paypal_email = $_POST['paypal_email'];
    $prev="bt_";


    $payarr = array( 

        'payment_paypal_email' => $paypal_email,

        'payment_paypal_status'=>1,

        );

    $updt_payment =$this->Site_model->update($prev.'members',$payarr, "user_id = '$uid'" );

    if($updt_payment){

        $flashmsg="<div class='alert alert-success'>Payment Details Updated successfully</div>";

    }else{

        $flashmsg="<div class='alert alert-danger'>Payment Details Failed To Update</div>";

    }
echo $flashmsg;
 }
 
 function process_formpostoffers(){

 $prev="bt_";	
 $expron = date("Y-m-d", strtotime($_POST['expireson'])); 
 $uid = $this->session->userdata['logged_in']['user_id'];

 $sell_offer_rowid ="";
 $chck_exists_sql = "SELECT * FROM ".$prev."offers WHERE prod_id = '".$_POST['prod_id']."'";
 $chck_exists_qu  = $this->Site_model->getcountRecods($chck_exists_sql);

 if(empty($chck_exists_qu))
   {
  $datetime=date('Y-m-d H:i:s');
  


  $product_title =  $this->Site_model->getDataById($prev.'products',"id = '".$_POST['prod_id']."' ");
  
  
  $insert_array = array(
    'prod_id' 		 => $_POST["prod_id"],
    'title'        => $product_title[0]['title'],
    'user_id' 		 => $uid,
    'price_cur_id' => $_POST["price_cur_id"],
    'description'  => $_POST["description"],
    'quantity' 		 => $_POST["quantity"],
    'keywords' 		 => $_POST["keywords"],
    'offer_price'  => $_POST["offer_price"],
    'delivery_time'=> $_POST["delivery_time"],
    'postedon' 		 => $datetime,
    'expireson' 	 => $expron,
    'min_order' 	 => $_POST["min_order"]
    );


 $r = $this->Site_model->add( $prev.'offers',$insert_array );

  
  if($r)
  {

       $flashmsg="<div class='alert alert-success'>Offers Submitted Successfully</div>";

    }else{

        $flashmsg="<div class='alert alert-danger'>An Error occured while submitting Offers Details</div>";

    }
   }else{
	   $flashmsg="<div class='alert alert-danger'>An Error occured while submitting Offers Details</div>";
   }
   echo $flashmsg;

 }
 
 function process_form_buy_postoffers(){
   $prev="bt_";

    //print_r($_POST); die;
    $uid=$this->session->userdata['logged_in']['user_id'];
    $expron = date("Y-m-d", strtotime($_POST['expireson'])); 
    $ctid1 = $_POST['ctid'];

		if (isset($_POST['subctid']) && $_POST['subctid'] !="" ) 
    {
			$catid = $_POST['subctid'];	
			//echo "sub".$_POST['subctid'];	
		} 
    else 
    {
			$catid = $_POST['ctid'];
			//echo "prnt".$_POST['subctid'];
		}
    if(isset($_REQUEST['id'])){$id = $_REQUEST['id'];}else{$id="";}

    if($id == "")
    {

        $ins_query =array(
		'cat_id '=>$catid,
        'uid '=>$uid,
        'title '=>$_POST['title'],
        'price_cur_id '=>$_POST['price_cur_id'],
        'price '=>$_POST['price'],
        'description '=>$_POST['description'],
        'quantity '=>$_POST['quantity'],
        'keywords '=>$_POST['keywords'],
        'postedon '=>date('Y-m-d H:i:s'),
        'approved '=> 'no',
        'expireson '=>$expron 
		);
		
		$r = $this->Site_model->add( $prev.'offers_buy',$ins_query );
		$new_id =$r;

    }
    else 
    {
        $ins_query =array(
		'cat_id '=>$catid,
        'uid '=>$uid,
        'title '=>$_POST['title'],
        'price_cur_id '=>$_POST['price_cur_id'],
        'price '=>$_POST['price'],
        'description '=>$_POST['description'],
        'quantity '=>$_POST['quantity'],
        'keywords '=>$_POST['keywords'],
        'postedon '=>date('Y-m-d H:i:s'),
        'approved '=> 'no',
        'expireson '=>$expron 
		);
		$where="id='".$_REQUEST['id']."'"; 
		
        $r= $this->Site_model->update( $prev.'offers_buy',$insert_array,$where);
        $new_id = $_REQUEST['id'];

    }

    $image_upload_msg = "";
    if($r)
    {
	     
	     if($_FILES['offerimg']['name']!="")
			 {
				
					$allowed_ext=array("jpg","jpeg","png","gif");
					
					$extension=explode('.',$_FILES["offerimg"]["name"]);
					
					$ext=strtolower(end($extension));
					
					if(in_array($ext,$allowed_ext))
					{
						$newname=rand(10000,99999)."_".time().".".$ext;
						$loc= "assets/uploadedimages/buyoffer/".$newname;
						move_uploaded_file($_FILES["offerimg"]["tmp_name"],$loc);
						
						$data=array(
						'buyoffer_image'=>$newname
						);
						$WHERE="id='".$new_id."'";
						$sql_bn=$this->Site_model->update($prev."offers_buy",$data,$WHERE); 
					}
					
          else
          {
            $after_post_msg ="<div class='alert alert-danger'> Wrong File Format. File Not Uploaded.</div>";
          }

			}
      
  		if($id == '')
      {
  		    $after_post_msg= "<div class='alert alert-success'>Offers Submitted Successfully. Waiting for admin approval! ".$image_upload_msg."</div>";
  		}
      else
      {
  		    $after_post_msg= "<div class='alert alert-success'>Offers Updated Successfully. ".$image_upload_msg."</div>";
  		}
  }
  
  echo $after_post_msg;

}

function process_tradeshows(){
  $prev="bt_";
    //print_r($_POST); die;
    $expron = date("Y-m-d", strtotime($_POST['expireson'])); 
    $tradeshowdate = date("Y-m-d", strtotime($_POST['tradeshow_date'])); 
    $bus_cat = implode(",",$_POST['category']);  

    if($tradeshowdate=='1970-01-01'){
        $tradeshowdate = date("Y-m-d");
    }else{
        $tradeshowdate = date("Y-m-d",strtotime($_POST['tradeshow_date']));
    }

    if($expron=='1970-01-01'){
        $expron = date('Y-m-d', strtotime("+30 days"));
    }else{
        $expron = date("Y-m-d",strtotime($_POST['expireson'])); 
    }    

 

        //echo $_REQUEST['id']; die;
        $request_id = 0;
        if(isset($_REQUEST['id'])){ 
            $request_id = $_REQUEST['id'];
            $new_tradeid = $_REQUEST['id'];
        }

        if($tradeshowdate=='1970-01-01'){
            $tradeshowdate = date("Y-m-d");
        }else{
            $tradeshowdate = date("Y-m-d",strtotime($_POST['tradeshow_date']));
        }

        if($expron=='1970-01-01'){
            $expron = date('Y-m-d', strtotime("+30 days"));
        }else{
            $expron = date("Y-m-d",strtotime($_POST['expireson'])); 
        }   

         $data =array(
        'country_id'=>$_POST['country'],
        'state_id'=>$_POST['state'],
        'cityid'=>$_POST['city'],
        'user_id'=>$this->session->userdata['logged_in']['user_id'],
        'tradeshow_name'=>$_POST['tradeshow_name'],
        'description'=>$_POST['description'],
        'tradeshow_date'=>$tradeshowdate,
        'tradeshow_venue'=>$_POST['tradeshow_venue'],
        'frq_period'=>$_POST['frq_period'],
        'open_to'=>$_POST['open_to'],
        'show_memtype'=>$_SESSION['memtype'],
        'show_website'=>$_POST['show_website'],
        'lastfair_report'=>$_POST['lastfair_report'],
        'official_hotels'=>$_POST['official_hotels'],
        'official_airlines'=>$_POST['official_airlines'],
        'product_profile'=>$_POST['product_profile'],
        'category'=>$bus_cat,
        'visitor_profile'=>$_POST['visitor_profile'],
        'approved' => 'N',
        'postedon' =>date('Y-m-d H:i:s'),
        'enddate'=>$expron
		);
        $new_tradeid =$this->Site_model->add($prev."tradeshow",$data); 
   
  
    if($_FILES['eventlogo']['name']!=""){
                    
        $allowed_ext=array("jpg","jpeg","png","gif");
        
        $extension=explode('.',$_FILES["eventlogo"]["name"]);
        
        $ext=strtolower(end($extension));
        
        if(in_array($ext,$allowed_ext))
        {
            
            $newname=rand(10000,99999)."_".time().".".$ext;
            $loc="assets/trade/".$newname;
            move_uploaded_file($_FILES["eventlogo"]["tmp_name"],$loc);
			
			$tradata=array(
			'tradeshow_img'=>$newname
			);
			$where="tradeshow_id='".$new_tradeid."'";
	
			$tradImgUpdate =$this->Site_model->update($prev."tradeshow",$tradata,$where); 
           
        }

    }
     $msg=" <div class='alert alert-success'><b>Update Successful.Please wait for admin's approval</b></div>";
	  
 

echo $msg;

}
    function process_change_password (){
        $sbcurrent_pwd=str_replace("$","\$",$_REQUEST["sbcurrent_pwd"]);

		$sbnew_pwd=str_replace("$","\$",$_REQUEST["sbnew_pwd"]);

		$con_pwd=str_replace("$","\$",$_REQUEST["con_pwd"]);

		if(strlen(trim($_REQUEST["sbcurrent_pwd"])) ==0 )

		{

			$msg='<div class="alert alert-info">Please specify Current Password.</div>';

		}
		else if(strlen(trim($_REQUEST["sbnew_pwd"])) ==0 )

		{

			$msg='<div class="alert alert-info">Please specify New Password.</div>';


		}
			else if(strlen(trim($_REQUEST["con_pwd"])) ==0 )

		{

			$msg='<div class="alert alert-info">Please confirm the  New Password.</div>';


		}

		
		else if($sbnew_pwd<>$con_pwd)

		{

			$msg='<div class="alert alert-info">Retyped Password does not match to the New Password.</div>';


		}
		
		else

		{
        $qry="Select * from  bt_members where user_id=".$this->session->userdata['logged_in']['user_id']. " and password='".md5($sbcurrent_pwd)."'";
		$rs0=$this->Site_model->getcountRecods($qry);
		$curentpwd = md5($_REQUEST["sbcurrent_pwd"]);

		if (!($rs0[0]["password"] === $curentpwd))

		{

		$msg='<div class="alert alert-danger"><i class="fa fa-times"></i>'.'  '.'Password COULD NOT be changed because old password was incorrect.</div>';


		}



		 else{

				$sbnew_pwd = md5($_REQUEST["sbnew_pwd"]);
				
				$userdata=array(
				'password'=>$sbnew_pwd
				
				);
				
				
				 $where='user_id='.$this->session->userdata['logged_in']['user_id'];
				 $res=$this->Site_model->update("bt_members",$userdata,$where); 

			if($res)

			{

				$msg = '<div class="alert alert-success"><i class="fa  fa-check"></i>'.'  '.'Password has been changed successfully</div>';

			}

			else

			{
              $msg = '<div class="alert alert-danger"><i class="fa fa-times"></i>'.'  '.'Error occured while changing the password</div>';
			}
	          }	
		}
			echo $msg;
}
  function delete_product(){
				foreach ($_POST as $key => $value) 
			{
				if (stristr($key, "checkbox")){ $strinlist .= $value;}
			}

			$del_cond = "uid=" . $this->session->userdata['logged_in']['user_id'] . " AND id in ($strinlist)";
			$delete_price_return =$this->Site_model->delete('bt_products',$del_cond);
			
			$data=array(
			'uid'=>$this->session->userdata['logged_in']['user_id'],
			'product_id'=>$strinlist,
			'date_deleted'=>date('Y-m-d')
			);
			$delete_price_return =$this->Site_model->add('bt_deleted_products',$data);
			  if($delete_price_return){
			  $msg=1;
		  }else{
			   $msg=0;
		  }
       echo  $msg;
  }
  
  function  process_forgot_password(){
	            $email=$_POST['email'];
				$datesent=date('Y-m-d:h:i:s');
$content='<p>Hello,</p>
        <p>You have requested for a password change on Blazebay. Are you the one who made this changes? if Yes,
        Please click the link below to reset your password.</p>
        <a href="https://www.blazebay.com/reset-forgot-password/'.md5($datesent.$email).'" target="_blank">Reset Password</a> ';

      $enquiryDetails = array(
          'user_id' => 0,

          'sender' =>'no-reply@blazebay.com',

          'receiver' => $_POST['email'],

          'subject' => "Reset Password",

          'message' => $content,

          'status' => 0
      );


      $this->Site_model->add("bt_emails", $enquiryDetails);
				
			$data2 =array(
			'token'=>md5($datesent.$email),
			'date'=>date('Y-m-d'),
			'email'=>$email
			);

			$results=$this->Site_model->add('bt_forgotPwd',$data2);
			
  }
  
  function process_forgot_change_password($token){


		$sbnew_pwd=str_replace("$","\$",$_REQUEST["sbnew_pwd"]);

		$con_pwd=str_replace("$","\$",$_REQUEST["con_pwd"]);

	
		if(strlen(trim($_REQUEST["sbnew_pwd"])) ==0 )

		{

			$msg='<div class="alert alert-info">Please specify New Password.</div>';


		}
			else if(strlen(trim($_REQUEST["con_pwd"])) ==0 )

		{

			$msg='<div class="alert alert-info">Please confirm the  New Password.</div>';


		}

		
		else if($sbnew_pwd<>$con_pwd)

		{

			$msg='<div class="alert alert-info">Retyped Password does not match to the New Password.</div>';


		}
		
		else

		{


				$sbnew_pwd = md5($_REQUEST["sbnew_pwd"]);
				
				
				$tokener=$this->Site_model->getDataById("bt_forgotPwd","token = '".$token."'");
			    $email=$tokener[0]['email'];
				
				$userdata=array(
				'password'=>$sbnew_pwd
				);
				 $where="email='".$email."'";
				 $res=$this->Site_model->update("bt_members",$userdata,$where); 

			if($res)

			{

				$msg = '<div class="alert alert-success"><i class="fa  fa-check"></i>'.'  '.'Your password has been changed successfully</div>';

			}

			else

			{
              $msg = '<div class="alert alert-danger"><i class="fa fa-times"></i>'.'  '.'Error occured while changing the password</div>';
			}
	          
		}
			echo $msg;
  }
			function  reset_forgot_password($token){
			$data['title']='Reset Password';
            $data ['name'] ='Reset Password';
            $data ['active'] ='buyer';
			$data['token']=$token;
                if ($this->agent->is_mobile())
                {
                    $this->load->view ( 'mobile/aoth/forgot-password',$data);
                }

                else
                {
                    $this->load->view ( 'pages/aoth/reset_password',$data);
                }


		  }
		  
		  function activate_account($token=null){
		    	$data['title']='Activate Account';
              $data ['name'] ='Activate Account';
              $data ['active'] ='buyer';
			
			$tokener=$this->Site_model->getDataById("bt_activation","token = '".$token."' AND visible='0'");
			if(!empty($tokener)){
			$uid=$tokener[0]['uid'];
  
				
				$userdata=array(
				'suspended '=>'N',
				);
				$where='user_id='.$uid;
			    $res=$this->Site_model->update("bt_members",$userdata,$where); 
				
				$userdata2=array(
				'visible '=>1,
				);
				$where="token='".$token."'";
			    $res=$this->Site_model->update("bt_activation",$userdata2,$where); 
			
			}else{
             header('location:'.base_url());exit;
			}
         $this->load->view ( 'pages/active',$data); 			
		  }
		  
		      function process_mini_logo($id){
			
                            $multi_imgname   = $_FILES['fileToUpload']['name'];

							$multi_extension = explode('.', $multi_imgname);  

							$mimg_ext        = strtolower(end($multi_extension));

							//new multi image name 

							$mimgpre       = 'Logo'.rand(1000,9999);

							$image  = $mimgpre.time().".".$mimg_ext;

							 $mainImageNewName=$image;
							//print_r($multi_extension);
							 move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"assets/uploadedimages/".$image); 
							 
							 $userdata2=array(
								'company_logo '=>$image,
								);
								$where="id='".$id."'";
								$res=$this->Site_model->update("bt_business",$userdata2,$where); 
			if($res){
				$msg = '<div class="alert alert-success"><i class="fa  fa-check"></i>'.'  '.'Company logo uploaded successfully</div>';

			}else{
			
            $msg ="<div class='alert alert-danger'> An error occured. logo Not Uploaded.</div>";	
			}
							 
							 echo $msg;
		  }
		  
public function wholesell2(){
        $data ['title'] = "Wholesellers";

        $user_session= $this->session->set_userdata ( 'userData', $session);

        $this->load->view ( 'pages/homeWholeseller2', $data );
    }

	
public	function random_gen($length){

	  	$random= "";

	  	srand((double)microtime()*1000000);

	  	$char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

	 	// $char_list .= "abcdefghijklmnopqrstuvwxyz";

	  	$char_list .= "1234567890";

	  	// Add the special characters to $char_list if needed



	  	for($i = 0; $i < $length; $i++) {    

	 	$random .= substr($char_list,(rand()%(strlen($char_list))), 1);  

	  	}  

	  	return $random;

	}

	function getsupplierDetails($product_id){
	
        $qry = "SELECT b.minisite_prefix,company_name,p.image,p.title,p.id,m.firstname,m.lastname,m.email,m.street,m.city,m.state,
			  m.country,m.address,m.phone,m.fax,m.zip,m.usertype,m.user_id FROM bt_products as p
			  JOIN  bt_members m ON m.user_id = p.uid 
			  JOIN bt_business b ON  m.user_id=b.user_id
			  WHERE p.id ='$product_id'";
        $productDetails =$this->Site_model->execute($qry);
		$data=array('data'=>$productDetails[0]);
      echo  json_encode($data);	
	}
	
	function contactSupplier(){

        if(!isset($this->session->userdata['logged_in']['user_id'])){
            header('location:'.base_url().'login');}
        else {


            $supplierId = $_POST['supplierId'];
            $productId= $_POST['productId'];

            $where="user_id= ".$supplierId;
            $supplierData=$this->Site_model->getDataById( $table = "bt_members", $where );
            $where="id=".$productId;
            $productData=$this->Site_model->getDataById( $table = "bt_products", $where );
            $supplier_fname = $supplierData[0]['firstname'];
            $supplier_id = $supplierId;
            $supplier_lname = $supplierData[0]['lasttname'];
            $suppliername = $supplier_fname . ' ' . $supplier_lname;
            $supplier_email =$supplierData[0]['email'];
            $product_id =$productId;
            $product_name = $productData[0]['title'];
            $product_image =$productData[0]['image'];
            $subject = 'Customer Product Inquiry';
            $senderName = $_POST['name'];
            $from = $_POST['email'];
            $message = $_POST['message'];
            $company_name = $_POST['company_name'];
            $senderId = $this->session->userdata['logged_in']['user_id'];
            $content = $message;


            $enquiryDetails = array(
                'user_id' => $senderId,

                'sender' => $from,

                'receiver' => $supplier_email,

                'subject' => $subject,

                'message' => $message,

                'status' => 0
            );


            $this->Site_model->add("bt_emails", $enquiryDetails);

            $enquiryDetails = array(
                'user_id' => $senderId,

                'sender' => $from,

                'receiver' => 'info@blazebay.com',

                'subject' => $subject,

                'message' => $message,

                'status' => 0
            );
            $this->Site_model->add("bt_emails", $enquiryDetails);


            $enqdata = array(
                'enquired_product' => $product_name,
                'prod_id' => $product_id,
                'full_name' => $senderName,
                'email' => $from,
                'subject' => $subject,
                'message' => $message,
                'receiver_id' => $supplier_id,
                'user_id' => $this->session->userdata['logged_in']['user_id'],
                'user_ip' => $_SERVER['REMOTE_ADDR'],
                'msg_read' => 0
            );
            $inserted = $this->Site_model->add('bt_enquiry', $enqdata);

            $enqdata = array(
                'smsfrom' =>'+254-741-403-640',
                'smsto' =>$supplierData[0]['mobile']?$supplierData[0]['mobile']:$supplierData[0]['phone'],
                'description' =>'Hello '.$suppliername.' one customer is online enquiring about '.$product_name.' Please respond through  your blazebay account and the email sent to your email',
                'status' => $from,
                'user_id' => $subject

            );
            $inserted = $this->Site_model->add('bt_sms', $enqdata);

            if ($inserted) {
                echo 1;
            } else {
                echo 0;
            }
        }
         	
	}


    function contactSupplierView($supplier=null,$productId=null){
        $prodata= $this->Site_model->productDetails($productId);
        $data ['title'] = "Contact supplier"." ".$prodata[0]['company_name'];
        $data ['name'] ="Contact supplier"." ".$prodata[0]['company_name'];
        $data ['active'] ='buyer';

        $data ['productData']=$prodata;



        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/contact-supplier/index', $data );

        }

        else
        {
            $this->load->view ( 'pages/contact-supplier/index', $data );

        }
    }
    function postbuyoffersedit($id=null){
		
$data['title']='Edit offer';
$data['id']=$id;

	 $this->load->view ( 'myaccount/edit_offer',$data);
	}
	
	
	 function process_update_form_sell_postoffers($id=null){

      $prev="bt_";
    $uid=$this->session->userdata['logged_in']['user_id'];
    $expron = date("Y-m-d", strtotime($_POST['expireson'])); 
//    $ctid1 = $_POST['ctid'];
//
//		if (isset($_POST['subctid']) && $_POST['subctid'] !="" )
//    {
//			$catid = $_POST['subctid'];
//			//echo "sub".$_POST['subctid'];
//		}
//			else
//			{
//			$catid = $_POST['ctid'];
//			//echo "prnt".$_POST['subctid'];
//	    	}
         if(!isset($this->session->userdata['logged_in']['user_id'])){
             header('location:'.base_url().'login');}
         else {
             $update_array = array(
                 'title ' => $_POST['title'],
                 'price_cur_id ' => $_POST['price_cur_id'],
                 'price ' => $_POST['price'],
                 'offer_price ' => $_POST['price'],
                 'description ' => $_POST['description'],
                 'quantity ' => $_POST['quantity'],
                 'keywords ' => $_POST['keywords'],
                 'postedon ' => date('Y-m-d H:i:s'),
                 'expireson ' => $expron
             );


             $where = "id='" . $id . "'";

             $r = $this->Site_model->update($prev . 'offers', $update_array, $where);
             $new_id = $id;


             $image_upload_msg = "";
             if ($r) {

                 if ($id == '') {
                     $after_post_msg = "<div class='alert alert-success'>Offers Submitted Successfully. Waiting for admin approval! " . $image_upload_msg . "</div>";
                 } else {
                     $after_post_msg = "<div class='alert alert-success'>" . $_POST['title'] . " Updated Successfully. " . $image_upload_msg . "</div>";
                 }

             }

             echo $after_post_msg;
         }

}

	 function process_update_form_buy_postoffers($id=null){
   $prev="bt_";

    //print_r($_POST); die;
    $uid=$this->session->userdata['logged_in']['user_id'];
    $expron = date("Y-m-d", strtotime($_POST['expireson'])); 
    $ctid1 = $_POST['ctid'];

		if (isset($_POST['subctid']) && $_POST['subctid'] !="" ) 
    {
			$catid = $_POST['subctid'];	
			//echo "sub".$_POST['subctid'];	
		} 
			else 
			{
			$catid = $_POST['ctid'];
			//echo "prnt".$_POST['subctid'];
	    	}
   
        $update_array =array(
		'cat_id '=>$catid,
        'uid '=>$uid,
        'title '=>$_POST['title'],
        'price_cur_id '=>$_POST['price_cur_id'],
        'price '=>$_POST['price'],
        'description '=>$_POST['description'],
        'quality '=>$_POST['quantity'],
        'keywords '=>$_POST['keywords'],
        'postedon '=>date('Y-m-d H:i:s'),
        'expireson '=>$expron,
		'buyoffer_image' =>$_FILES["offerimg"]["name"]
		);
		
		
		$where="id='".$id."'"; 
		
		
        $r= $this->Site_model->update( $prev.'offers_buy',$update_array,$where);
        $new_id = $id;

   

    $image_upload_msg = "";
    if($r)
    {
	     
	     if($_FILES['offerimg']['name']!="")
			 {
				
					$allowed_ext=array("jpg","jpeg","png","gif");
					
					$extension=explode('.',$_FILES["offerimg"]["name"]);
					
					$ext=strtolower(end($extension));
					
					if(in_array($ext,$allowed_ext))
					{
						$newname=rand(10000,99999)."_".time().".".$ext;
						$loc= "assets/uploadedimages/buyoffer/".$newname;
						move_uploaded_file($_FILES["offerimg"]["tmp_name"],$loc);
						
						$data=array(
						'buyoffer_image'=>$newname
						);
						$WHERE="id='".$new_id."'";
						
						$sql_bn=$this->Site_model->update($prev."offers_buy",$data,$WHERE); 
					}
					
          else
          {
            $after_post_msg ="<div class='alert alert-danger'> Wrong File Format. File Not Uploaded.</div>";
          }

			}
      
  		if($id == '')
      {
  		    $after_post_msg= "<div class='alert alert-success'>Offers Submitted Successfully. Waiting for admin approval! ".$image_upload_msg."</div>";
  		}
      else
      {
  		    $after_post_msg= "<div class='alert alert-success'>Offers Updated Successfully. ".$image_upload_msg."</div>";
  		}
  }
  
  echo $after_post_msg;

}

 function delete_offerproduct(){
				foreach ($_POST as $key => $value) 
			{
				if (stristr($key, "checkbox")){ $strinlist .= $value;}
			}

			$del_cond = "uid=" . $this->session->userdata['logged_in']['user_id'] . " AND id in ($strinlist)";
			$delete_price_return =$this->Site_model->delete('bt_offers_buy',$del_cond);
			
			
			  if($delete_price_return){
			  $msg=1;
		  }else{
			   $msg=0;
		  }
       echo  $msg;
  }
  
  	public function makeOrder($product_id=null,$qty=null,$color=null,$size=null){
//        if(isset($this->session->userdata['logged_in']['user_id'])) {

            $data ['title'] = "Make order";
	$data ['product_id'] = $product_id;
	$data ['color'] = $color;
	$data ['size'] = $size;
	$data ['productqty'] = $qty;
    $data ['active'] ="buyer";
    $data ['name'] ="Make order";
   $data ['qty'] =$qty;


        if ($this->agent->is_mobile())
        {
            $this->load->view( 'mobile/order/order',$data );
        }

        else
        {
            $this->load->view( 'pages/orders/order',$data );
        }
	}
	public function makeOrder2($product_id=null,$qty=null,$color=null,$size=null){

//        if(isset($this->session->userdata['logged_in']['user_id'])) {

            $data ['title'] = "Make order";
            $data ['product_id'] = $product_id;
            $data ['color'] = $color;
            $data ['size'] = $size;
            $data ['productqty'] = $qty;
            $data ['active'] = "buyer";
            $data ['name'] = "Make order";
            $data ['qty'] = $qty;

            $this->load->view('trade-security/orders/order', $data);
//        } else{
//            header('location:'.base_url().'login');
//        }
	}
		public function orderaddress($product_id=null){
    $data ['title'] = "Make order";
	$data ['product_id'] = $product_id;
	$this->load->view ( 'pages/order/order_address', $data );	
	}
	
	public function delivery($product_id=null){
    $data ['title'] = "Make order";
	$data ['product_id'] = $product_id;
	$this->load->view ( 'pages/order/order_delivery', $data );	
	}
	public function orderpayment($product_id=null){
    $data ['title'] = "Make order";
	$data ['product_id'] = $product_id;
	$this->load->view ( 'pages/order/order_payment', $data );	
	}
	public function locations_pricing(){
        $data['title']="Manage Location Pricing";
        $data['active'] = "forcourier";
        $data['name'] =  "location pricing";
        $data['active2'] = "cloctionpricing";
	$this->load->view ( 'dashboard/courier-mgt/locationPricing', $data );
		
	}
	
	public function addlocation(){
        $data['title']="Add new location pricing";
        $data['active'] = "forcourier";
        $data['name'] =  "location pricing";
        $data['active2'] = "addlocationpricing";
	    $this->load->view ( 'dashboard/courier-mgt/addlocationPricing', $data );
		
	}
	public function process_location_pricing(){
		
	$where="uid = '".$this->session->userdata['logged_in']['user_id']."'
	AND  source='".$_POST['source']."' 	AND destination='".$_POST['destination']."' 
	
	AND source_state='".$_POST['sourcestate']."' AND dest_state='".$_POST['deststate']."'
	
	AND source_city='".$_POST['sourcecities']."' AND dest_city='".$_POST['destcities']."'	";
	
	$locationpricing=$this->Site_model->getDataById( $table = "bt_location_pricing", $where );

	if(!empty($locationpricing)){
		
     $msg ="<div class='alert alert-info'>Failed.You already have this location pricing.Please edit it instead</div>";	
	}else{
		
		
		$distanceKm=$_POST['distanceKm'];
		$pricekm=$_POST['pricekm'];
		
	$data=array(
		'uid'=>$this->session->userdata['logged_in']['user_id'],
		'source'=>$_POST['sourceCountry'],
		'destination'=>$_POST['destCountry'],
		'source_state'=>$_POST['sourcestate'],
		'dest_state'=>$_POST['deststate'],
		'source_city'=>$_POST['sourcecities'],
		'dest_city'=>$_POST['destcities'],
		'mode'=>$_POST['mode'],
		'price'=>$_POST['price'],
		'min_weight'=>$_POST['minweight'],
		'max_weight'=>$_POST['maxweight'],
		'min_volume'=>$_POST['minvolume'],
		'max_volume'=>$_POST['maxvolume'],
		'currency'=>$_POST['currency'],
		'active'=>1,
		'min_distance'=>$_POST['mindistanceKm'],
		'max_distance'=>$_POST['maxdistanceKm'],
		'duration'=>$_POST['duration'],
		'means'=>$_POST['means']? $_POST['means']:'',
		'otherdetails'=>$_POST['other']
		);
		$inserted =$this->Site_model->add('bt_location_pricing', $data);
 	if($inserted){
		
     $msg=" <div class='alert alert-success'><b>Success</b></div>";
	}else{
	
     $msg ="<div class='alert alert-danger'> An error occured. failed to save the location pricing.</div>";	
	}
	}
	echo $msg;
	}
	
	public function edit_location_pricing($id){
	    $data ['id'] = $id;
        $data['title']="Edit Location Pricing";
        $data['active'] = "forcourier";
        $data['name'] =  "Edit Location Pricing";
        $data['active2'] = "addlocationpricing";
	$this->load->view( 'dashboard/courier-mgt/editlocationPricing', $data );
	}
	
	public function procees_edit_location_pricing($id){
		
		
		$distanceKm=$_POST['distanceKm'];
		$weight=$_POST['weight'];
		$volume=$_POST['volume'];
	
	$data=array(
		'source'=>$_POST['sourceCountry'],
		'destination'=>$_POST['destCountry'],
		'source_state'=>$_POST['sourcestate'],
		'dest_state'=>$_POST['deststate'],
		'source_city'=>$_POST['sourcecities'],
		'dest_city'=>$_POST['destcities'],
		'mode'=>$_POST['mode'],
		'price'=>$_POST['price'],
		'currency'=>$_POST['currency'],
		'duration'=>$_POST['duration'],
		'min_weight'=>$_POST['minweight'],
		'max_weight'=>$_POST['maxweight'],
		'min_volume'=>$_POST['minvolume'],
		'max_volume'=>$_POST['maxvolume'],
		'currency'=>$_POST['currency'],
		'min_distance'=>$_POST['mindistanceKm'],
		'max_distance'=>$_POST['maxdistanceKm'],
		'means'=>$_POST['means'],
		'otherdetails'=>$_POST['other']
		);
		$locid=$_POST['locid'];
		$where="id='".$locid."' ";
		$inserted =$this->Site_model->update('bt_location_pricing', $data,$where);
 	if($inserted){
		
     $msg=" <div class='alert alert-success'><b>Success</b></div>";
	}else{
	
     $msg ="<div class='alert alert-danger'> An error occured. failed to update the location pricing.</div>";	
	
	}
	echo $msg;	
	}
public function courierDetails(
        $courierId
		){
		
	    $where="id=$courierId";
		$locationpricing=$this->Site_model->getDataById( $table = "bt_location_pricing", $where );


		$price=$locationpricing[0]['price'];	

		if($locationpricing[0]['currency']==4){
		if($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')){
							if($arr = json_decode($resp)){
								if($exc_rate = $arr->value){
									$amount = ceil($price * $exc_rate);
									$currency = 'KES';
								}
							}
						}
		}else {
			$amount = ceil($price);
		}
		$duration=$locationpricing[0]['duration'];
		$courier_id=$locationpricing[0]['uid'];
		$data=array('price'=>$amount,'duration'=>$duration,'courier_id'=>$courier_id);
		echo json_encode(
		$data
		);
}

public function my_products_list($approved=null,$page=null,$pageId=null){


    if(!isset($this->session->userdata['logged_in']['user_id'])){
        header('location:'.base_url().'login');}
    else {
        $data ['title'] = "My product List";
        $data ['approved_products'] = $approved;
        $data ['page'] = $page;
        $data ['Getpage'] = $pageId;
        $data ['show_productType'] =$approved;
        $this->load->view('dashboard/product-mgt/more-products', $data);
    }
	}

public function temporders(){
	
	 $date=date('Y-m-d');
	 $where="user_id=".$this->session->userdata['logged_in']['user_id']." AND product_id=".$_POST['productId']." AND DATE(`date`)='$date'  AND active='1'";
	 $temporder=$this->Site_model->getDataById( $table = "bt_temp_order", $where );

	 if(!empty($temporder)){
		$data=array(
		'qty'=>$_POST['qty']
		);
		
  $where="user_id=".$this->session->userdata['logged_in']['user_id']." AND product_id=".$_POST['productId']." AND DATE(`date`)='$date' AND active= '1'";
  $inserted =$this->Site_model->update('bt_temp_order', $data,$where); 
	 }else{
	$data=array(
		'user_id'=>$this->session->userdata['logged_in']['user_id'],
		'product_id'=>$_POST['productId'],
		'qty'=>$_POST['qty'],
		'active'=>1
		);
   $inserted =$this->Site_model->add('bt_temp_order', $data);
	 }
}

public function tempcuorders(){
	

	   $date=date('Y-m-d');
		$data=array(
		'curier'=>$_POST['curior'],
		'curieramount'=>$_POST['curieramount']
		);
  $where="user_id=".$this->session->userdata['logged_in']['user_id']." AND product_id=".$_POST['productId']." AND DATE(`date`)='$date' AND active= '1'";
  
  $update =$this->Site_model->update('bt_temp_order', $data,$where); 
  
}

  public function addCustomerOrders(){

      $ordr_status = 0;
      $date_added = date('Y-m-d H:i:s');
	  $date = date('Y-m-d');
	  $date_modified = "";
	  

	$ip = $_SERVER['REMOTE_ADDR'];

        $order_data = array(
        'order_id'          => "",

        'invoice_no'        => "",

        'invoice_prefix'    => "",

        'customer_id'       => $this->session->userdata['logged_in']['user_id'],

        'currency'          => $this->session->userdata['orderData']['currency'],

        'shipping_firstname' => $this->session->userdata['orderData']['shipping_firstname'],

        'shipping_lastname' => $this->session->userdata['orderData']['shipping_lastname']?$this->session->userdata['orderData']['shipping_lastname']:'-',

        'shipping_address_1'=> $this->session->userdata['orderData']['shipping_address_1'],

        'shipping_address_2'=> "",

        'shipping_city'     => $this->session->userdata['orderData']['shipping_city']?$this->session->userdata['orderData']['shipping_city']:'-',

        'shipping_postcode' => $this->session->userdata['orderData']['shipping_postcode']?$this->session->userdata['orderData']['shipping_postcode']:'-',

        'shipping_state'    => $this->session->userdata['orderData']['shipping_state']?$this->session->userdata['orderData']['shipping_state']:'-',

        'shipping_state_id' => $this->session->userdata['orderData']['shipping_state_id']?$this->session->userdata['orderData']['shipping_state_id']:'-',

        'shipping_country'  => $this->session->userdata['orderData']['shipping_country']?$this->session->userdata['orderData']['shipping_country']:'-',

        'shipping_country_id' =>$this->session->userdata['orderData']['shipping_country_id']?$this->session->userdata['orderData']['shipping_country_id']:'-',

        'shipping_zone'     => "",

        'shipping_zone_id'  => "",

        'shipping_address_format' => "",

        'shipping_method'   => "",

        'comments'          => '',

        'total'             => 0,

        'order_status_id'   => $ordr_status,

        'ip'                => $ip,

        'date_added'        => $date_added,

        'date_modified'     => $date_modified,

        'buyer_status'      => 0,

        'for_courier_id'    => $this->session->userdata['orderData']['courier_id'],

        'shipping_charge'   => $this->session->userdata['orderData']['shipping']

        );
    $order_id =$this->Site_model->add('bt_order', $order_data);
   $grandTotal=$this->session->userdata['orderData']['grandTotal'];

			
$data=array(
'orderId'=>$order_id,
'Total'=>$grandTotal
);
	echo json_encode($data);
		
	}
	
	function contactMultipleSupplier(){
		$supplier_fname = $_POST['supplier_fname'];
		$supplier_lname = $_POST['supplier_lname'];
		$suppliername=$supplier_fname.' '.$supplier_lname;
		$supplier_email = $_POST['supplier_email'];
		$supplier_id = $_POST['supplier_id'];
		$product_id= $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$product_image = $_POST['product_image'];
		$subject = 'Customer Product Inquiry';
		$senderName = $_POST['name'];
		$from = $_POST['email'];
		$message = $_POST['message'];
		$company_name = $_POST['company_name'];
		$senderId =$this->session->userdata['logged_in']['user_id'];
		$content=$message.','.$suppliername.','.$company_name.','.$product_name.','.$product_image.','.$senderName;
		
       contactsuplierMail($from, $supplier_email,$subject,$content,$supplier_email,'info@blazebay.com'); 
		
		$enqdata=array(
		'enquired_product'=>$product_name,
		'prod_id'=>$product_id,
		'full_name'=>$senderName,
		'email'=>$from,
		'subject'=>$subject,
		'message'=>$message,
		'receiver_id'=>$supplier_id,
		'user_id'=>$this->session->userdata['logged_in']['user_id'],
		'user_ip'=>$_SERVER['REMOTE_ADDR'],
		'msg_read'=>0
		);
		$inserted =$this->Site_model->add('bt_enquiry', $enqdata);
		//$inserted=0;
       if($inserted){
		  echo 1; 
	   }else{
		 echo 0;  
	   }
         	
	}

 public function percountry($country=null,$page=null,$pageId=null){

         $where="country_id=$country";
	    $countryData=$this->Site_model->getDataById( $table = "bt_countries", $where );
	    $countryName=$countryData[0]['country_name'];
        $data ['name'] = $countryName;
     $data ['Getpage'] = $page;
     $data ['page'] = $page;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
        $data ['active'] ='buyer';
        $data ['title'] = $countryName;
		$data ['country'] =$country;
		$data ['countryName'] = $countryName;
        $this->load->view ( 'pages/companies/listing', $data );
    }
  function pagingpercountry($countryName,$countryId,$searterm=null,$page=null,$pageId=null){

		$data ['title'] =  $countryName." "."Campanies";;
       		if($searterm=='page'){
			$data ['getProduct'] ='';
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
		}else{
			$data ['getProduct'] = $searterm;
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
		}
		$data ['country'] =$countryId;
		$data ['countryName'] = $countryName;
      $this->load->view ( 'pages/companies/listing', $data );
    }

	function allcampaniesPages($searterm=null,$page=null,$pageId=null){

		$data ['title'] = "Campanies";; 
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
		if($searterm=='page'){
			$data ['getProduct'] ='';
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
		}else{
			$data ['getProduct'] = $searterm;
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
		}
		$data ['country'] =$countryId;
		$data ['countryName'] = $countryName;
        $this->load->view ( 'pages/companies', $data );
    }
	function supplierProducts($campany_name=null,$userId=null,$page=null,$pageId=null){

		$data ['title'] = $campany_name;
        $data ['company_name'] =$campany_name;
        $data ['company_id'] =$userId;
        $data ['page'] = $page;
		$data ['Getpage'] = $pageId;
		$data ['userId'] = $userId;
        $data ['name'] =  $campany_name;
        $data ['active'] ='buyer';
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
        $this->load->view ( 'pages/products/products', $data );
    }
    function industryProducts($campany_name=null,$catId=null,$page=null,$pageId=null){

        $data ['title'] = $campany_name;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
        $data ['industries'] ='industries';
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$catId;
        $data ['getcategory'] =$campany_name;
        $data ['link'] = base_url().$campany_name.'/'.$catId;
        $data ['categoryName'] =$campany_name;
        $data ['name'] = $campany_name;
        $data ['active'] ='buyer';
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
        $this->load->view ( 'pages/products/products', $data );
    }
	public function reportAbuse($productId=null){
		$data ['title'] = "Report Abuse";
		$data ['productId'] = $productId;
        $this->load->view ( 'pages/reportAbuse', $data );
	}
   public function persupplier($company_name=null,$userId=null,$page=null,$pageId=null){
        $data ['title'] = $company_name;
		$data ['company_name'] =$company_name;
       $data ['company_id'] =$userId;
       $data ['Getpage'] = $pageId;
       $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
       $data ['name'] =$company_name;
       $data ['active'] ='buyer';
        $this->load->view ( 'pages/products/products', $data );
    }
	
	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

		public function categoryProducts($cName=null,$cid=null,$page=null,$pageId=null){
		    $data ['title'] = urlencode($cName)." "."Products";
		    $data ['getcid'] =$cid;
		    $data ['Getpage'] = $page;
			$data ['page'] = $page;
        $this->load->view ( 'pages/products', $data );

		}
		
		public function prod_price($prodid){
			
			
	$sql1 = "SELECT price,price_cur_id FROM  bt_products

			WHERE id = '".$prodid."'";
		$res =$this->Site_model->execute($sql1);

     $cur = $this->Site_model->execute("select sbcur_symbol from  bt_currencies where sbcur_id='".$res[0]['price_cur_id']."'");

	  echo $cur[0]['sbcur_symbol'].' '.$res[0]['price'];
		}
	public function purchase_orderlist(){
	$this->load->view ( 'myaccount/purchase_orderlist');	
	}
	
	public function quote_update($status,$qouteId){
		
		$id=$_POST['quoteId'];
		   $where = "qt_id='".$id."' ";
			
			$data=array(
			'status'=>$_POST['status']
			 );
			 
		 $updatequotes = $this->Site_model->update( 'bt_quotes',  $data, $where);
		 if($updatequotes){
			 $msg=" <div class='alert alert-success'><b>Success</b></div>";
		 }else{
			$msg ="<div class='alert alert-danger'> An error occured. failed.</div>";	
	 
		 }
		 echo $msg;
	}
	public function getCountry($id){

	$country_id=$_POST['country_id'];
    $rowCount =$this->Site_model-> execute("SELECT * FROM  bt_states WHERE country_id = '$country_id' AND status = '1' ORDER BY state_name ASC");
 
    //Display states list
    if(!empty($rowCount)){
        echo '<option value="0">Select state</option>';
        foreach($rowCount as $row){ 
            echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
        }
    }else{
        echo '<option value="0">State not available</option>';
    }

	}
 
 public function getstate($id){
		
    $state_id=$_POST['state_id'];
    $rowCount =$this->Site_model-> execute("SELECT * FROM bt_cities WHERE state_id = '$state_id' AND status = '1' ORDER BY city_name ASC");

    //Display cities list
    if(!empty($rowCount)){
        echo '<option value="0">Select city</option>';
        foreach($rowCount as $row){
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        echo '<option value="0">City not available</option>';
    }
}
		public function pesapal() {
			
		$amount=$this->session->userdata['orderData']['grandTotal'];
		$productname=$this->session->userdata['orderData']['product_name'];
		$qty=$this->session->userdata['orderData']['qty'];
		$firstname=$this->session->userdata['orderData']['shipping_firstname'];
		$lastname=$this->session->userdata['orderData']['shipping_lastname'];
		$phone=$this->session->userdata['orderData']['order_phone'];
		$email=$this->session->userdata['orderData']['email'];
		
	
        $rand			= $this->random_gen('8');
        $order_number	= 'ORD'.$rand .'B';
        $payment_number = $order_number;
		//pesapal params
		$token = $params = NULL;

		/*
		PesaPal Sandbox is at http://demo.pesapal.com. Use this to test your developement and 
		when you are ready to go live change to https://www.pesapal.com.
		*/
		$consumer_key = 'yU4chhkwrqLQrdaCuEpjam+ZQR34hMnv';//Register a merchant account on
		                   //demo.pesapal.com and use the merchant key for testing.
		                   //When you are ready to go live make sure you change the key to the live account
		                   //registered on www.pesapal.com!
		$consumer_secret = 'W2rjGRSMsqrdxZ0RFA10T7FhZbE=';// Use the secret from your test
		                   //account on demo.pesapal.com. When you are ready to go live make sure you 
		                   //change the secret to the live account registered on www.pesapal.com!
		$signature_method = new OAuthSignatureMethod_HMAC_SHA1();
		$iframelink = 'https://www.pesapal.com/API/PostPesapalDirectOrderV4';//change to      
		                   //https://www.pesapal.com/API/PostPesapalDirectOrderV4 when you are ready to go live!

		//get form details
		$amount = $amount;
		$desc = 'You are ordering '.$qty.'of '.$productname.'from blazebay';
		$type = 'MERCHANT'; //default value = MERCHANT
		$reference = $payment_number;//unique order id of the transaction, generated by merchant
		$first_name =$shipping_firstname;
		$last_name = $lastname;
		//$email = $email;
		$phonenumber = $phone?$phone:$email;//ONE of email or phonenumber is required
        $currency = 'USD';
        // Conver to amount to KES
        if($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')){
            if($arr = json_decode($resp)){
                if($exc_rate = $arr->value){
                    $amount = ceil($amount * $exc_rate);
                    $currency = 'KES';

                }
            }
        }

		$callback_url = base_url('buyer-orderlist/'); //redirect url, the page that will handle the response from pesapal.

		$post_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><PesapalDirectOrderInfo xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" Amount=\"".$amount."\" Description=\"".$desc."\" Type=\"".$type."\" Reference=\"".$reference."\" FirstName=\"".$first_name."\" LastName=\"".$last_name."\" Currency=\"".$currency."\" Email=\"".$email."\" PhoneNumber=\"".$phonenumber."\" xmlns=\"http://www.pesapal.com\" />";
		$post_xml = htmlentities($post_xml);

		$consumer = new OAuthConsumer($consumer_key, $consumer_secret);

		//post transaction to pesapal
		$iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $iframelink, $params);
		$iframe_src->set_parameter("oauth_callback", $callback_url);
		$iframe_src->set_parameter("pesapal_request_data", $post_xml);
		$iframe_src->sign_request($signature_method, $consumer, $token);

    
		//display pesapal - iframe and pass iframe_src
        $this->load->view('pages/pesapal/iframe', ['src'=>$iframe_src]);
	  // echo $iframe_src;

    }

  public function fetsubcat($groupid){
	    $data ['groupid'] =$groupid;
        $this->load->view ( 'dashboard/fetsubcat', $data );
  }
   public function removeImage(){

	   $image=$_POST['img'];
	    $res =$this->Site_model-> delete("bt_product_images","id = '$image'");
		if($res){
			echo 'success';
		}else{
		echo 'failed';
		}
   }
		 public function tradeSecurity2(){

 $this->load->view('trade/index');

  }
  		 public function ourpartners(){

             $data ['title'] = "Our Trusted Partners";
             $data ['name'] = "Our Trusted Partners";
             $data ['active'] ='partners';
			  $where=" `p`.`approved` = 'yes' AND `m`.`suspended` = 'N' AND s.company_logo <>''  ORDER BY s.id DESC ";
              $data ['premium_supplierBrands'] = $this->Site_model->get_allActive_supplierList(30,$where);
              $this->load->view('pages/ourPartners',$data);

              }
  
  function getGrandTotal($product_id){
	  
	   $date=date('Y-m-d');
 if(isset($this->session->userdata['logged_in']['user_id'])){
 $where="user_id=".$this->session->userdata['logged_in']['user_id']." AND product_id=".$product_id." AND DATE(`date`)='$date'  AND active='1'";
 $temporder=$this->Site_model->getDataById( $table = "bt_temp_order", $where );
 }
 
 $where1="id=".$temporder[0]['curier']." ";
 $curiordata=$this->Site_model->getDataById( $table = "bt_location_pricing", $where1 );
 
 if(!empty($temporder)){
$minimum_qty=$temporder[0]['qty'];	 
 }else{
$minimum_qty=$product_minimum_qty;
 }

$curiorPrice=$temporder[0]['curieramount'];
$productTotal=$proprice* $minimum_qty;
$Total=$productTotal+$curiorPrice;
$tax=(16/100)*$Total;
$grandTotal=$productTotal+$curiorPrice+$tax;

echo  $grandTotal;
  }
  	  public function fetcuriors(){
	    $data ['country'] =$_POST['country'];
		$data ['state'] =$_POST['state'];
		$data ['city'] =$_POST['city'];
		$data ['qty'] =$_POST['qty'];
		$data ['productId'] =$_POST['productId'];
		$data ['shippingstmodes'] =$_POST['shippingstmodes'];
		
        $this->load->view ( 'pages/fetcouriors', $data );
  }
  	  public function fetstates($country=null){
		$data ['country'] =$_POST['multi_country_id'];
        $this->load->view ( 'pages/fetstates', $data );
  }
  	  public function fetcities($state=null){
		$data ['state_id'] =$_POST['multi_country_id'];
        $this->load->view ( 'pages/fetcities', $data );
  }
  
  public function validateMpesa(){
	 $mpesacode=$_POST['mpesacode'];
	 $MpesaAccount=$_POST['MpesaAccount'];
	 $where="mpesa_code='$mpesacode'  AND mpesa_acc='$MpesaAccount' AND mpesa_amt >='$MpesaAccount' ";
	 $mpesaVerification=$this->Site_model->getDataById("bt_mpesa_transactions",$where); 
	if(!empty($mpesaVerification)){
		echo 1;
	}else{
		echo 0;
	}
  }
  
  public function fileComplaint($reportId=null){
	    $data ['title'] ='File Complaints';
		$data ['reportId'] =$reportId;
        $this->load->view( 'pages/fileComplaints', $data );  
  }
    public function processComplaint(){
	   
        $docFile = $_FILES['evidence']['name'];

        $tmp_dir = $_FILES['evidence']['tmp_name'];

        $docSize = $_FILES['evidence']['size'];



        $upload_dir = 'assets/upload_complaint/'; 



        $docExt = strtolower(pathinfo($docFile,PATHINFO_EXTENSION)); // get image extension

      

        // valid image extensions

        $valid_extensions = array('doc', 'docx', 'pdf'); // valid extensions



        // rename uploading image

        $user_evidence = rand(1000,1000000).".".$docExt;

        

        // allow valid image file formats

        if(in_array($docExt, $valid_extensions)){   

          

            if($docSize < 5000000){ // Check file size '5MB'

              move_uploaded_file($tmp_dir,$upload_dir.$user_evidence);

		   $dataComplaints=array(
		   'user_id'=>$this->session->userdata['logged_in']['user_id']?$this->session->userdata['logged_in']['user_id']:'0',
		   'product_id'=>$_REQUEST['pid'],
		   'abuse_id'=>$_REQUEST['id'],
		   'reason'=>$_POST['reason'],
		   'description'=>$_POST['description'],
		   'file'=>$user_evidence
		   );
			
         $res= $this->Site_model->add( $table = "bt_file_complaint", $dataComplaints);
		 $msg=1;
            }

            else{

              $msg="Sorry, your file is too large.";

            }

        }

        else{

            $msg="Sorry, only DOC, DOCX & PDF files are allowed.";

        }

      echo $msg;
 
  }
  
  public function viewsupplierQuotation($order_id=null){
	     $data ['title'] ='Supplier Quotes';
		$data ['order_id'] =$order_id;
        $this->load->view( 'myaccount/viewsupplier_quotation', $data );    
  }
  public function processSupplierOrderStatus(){
	  $prev='bt_';
	    //New Order Status Update 
 if(isset($_POST['sup_status']) && $_POST['sup_status']!=''){
    $statusArr = explode('|',$_POST['sup_status']);
    $supSts = $statusArr[0];
    $ordId = $statusArr[1];
    $sup_order_id = $_POST['sup_order_id'];
    $c_order_id = $_POST['c_order_id'];
    
    if($supSts == 'processing'){

        $this->Site_model->update($prev.'order_courier', array('status' => 2) ,"c_order_id = '$c_order_id'" );
        $this->Site_model->update($prev.'order_supplier', array('status' => 2,'sup_courier_status'=>2) ,"sup_order_id = '$sup_order_id'" );
		$msg=1;
    }
	else if($supSts == 'dispatch'){
	     $this->Site_model->update($prev.'order_courier', array('status' => 3) ,"c_order_id = '$c_order_id'" );
        $this->Site_model->update($prev.'order_supplier', array('status' => 3,'sup_courier_status'=>3) ,"sup_order_id = '$sup_order_id'" );
		
	/*$main_order_id            = $_POST['order_id'];
    $status_updated_by        = $_POST['status_updated_by'];
    $for_supplier_order_number= $_POST['for_supplier_order_number'];
    $courier_ref_num          = $_POST['courier_ref_num'];
    $courier_pickedby         = $_POST['courier_pickedby'];

	
	  $pickup_date              = date('Y-m-d H:i:s');
	  $sup_track_arr =          array(
	  'supplier_id'           => $updt_supplier_user_id,
	  'supplier_order_number' => $for_supplier_order_number,
	  'sup_updatedby'         => $status_updated_by,
	  'main_order_id'         => $main_order_id,
	  'courier_status'        => '0',
	  'courier_ref_number'    => $courier_ref_num,
	  'courier_pickedby'      => $courier_pickedby,
	  'pickup_date'           => $pickup_date
	  );
	  
	  
	  // Get Common track/Invoice Number
      $get_common_track_info =$this->Site_model->getRowData($prev.'order_tracking',"supplier_order_number = '$for_supplier_order_number'");
      $common_track_number = $get_common_track_info['tracking_number'];

      $common_track_arr = array('supplier_order_status' => '1','courier_order_status' => '0');
      $ordr_track_updted =$this->Site_model->update($prev.'order_tracking', $common_track_arr ,"supplier_order_number = '$for_supplier_order_number'" );
	  */
	}
}


echo $msg;
  }
  
    public function processCourierOrderStatus(){
	  $prev='bt_';
	  

	//p($posted_data,1);order_status
	$order_id 			= $_POST['order_id'];		//order is
	$courier_order_id 	= $_POST['order_cou_id'];	//courier_order_id
	$supplier_order_id 	= $_POST['sup_order_id'];	//supplier_order_id
	
	if(!empty($_POST['order_status'])){
		$new_courier_status =  $_POST['order_status'];	//courier new Status
		
		//buyer Status Depending On Courier Status
		if($new_courier_status == '4'){
			$new_buyer_status = '4';	//Order On The Way
		}else if($new_courier_status == '5'){
			$new_buyer_status = '5';	//Deliver To Buyer / Received in Buyer End
		}

		//update courier status in supplier order table :
		$courier_statusData = array('sup_courier_status' => $new_courier_status );
		$courier_updated  =  $this->Site_model->update('bt_order_supplier', $courier_statusData, "sup_order_id='$supplier_order_id'" );
		if($courier_updated){
			$msg=1;
		}else{
			$msg=0;
		}	
	}else{
		$msg=0;
	}
echo $msg;
  }
  
  function processContact(){
	$user_id =$this->session->userdata['logged_in']['user_id'];
	$user_name =$this->session->userdata['logged_in']['username'];
	$comp_id = $_POST['comp_id'];
	$comp_email = $_POST['comp_email'];
	$full_name = $_POST['fname'];
	$email = $_POST['email'];
	if(isset($_POST['company_name'])){$company_name = $_POST['company_name'];}else{$company_name = "";}
	$mobile = $_POST['mobile'];
	$subject = $_POST['subject'];
	$message = $_POST['comment'];
	$msg_read = 'No' ;
	$t_del = 'No' ;
	$f_del = 'No' ;
	
	$dataContacts=array(
   'fid'=>$user_id?$user_id:0, 
   'tid'=>$comp_id?$comp_id:0,
   'subject'=>$subject, 
   'message'=>$message,
   'from_email'=>$email, 
   'contact_number'=>$mobile, 
   'msg_read'=>$msg_read , 
   't_del'=>$t_del ,
   'f_del'=>$f_del
	);
  $res= $this->Site_model->add( $table = "bt_messages", $dataContacts);
  if($res){
	echo 1;  
  }else{
	echo 0;   
  }
  }
  public function currencyConvertion2(){
	  
	  /*$inr
	  $usd
	  $GBP*/
	        $currentAmount=$_POST['currentAmount'];
			$currentCurrency=$_POST['currentCurrency'];
			$conversionCurrecy=$_POST['conversionCurrecy'];
	    if($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')){
            if($arr = json_decode($resp)){
                if($exc_rate = $arr->value){
                    $convertedamount = $currentAmount * $exc_rate;
                    $currency = 'KES';

                }
            }
        }
		 if($resp = @file_get_contents('https://www.nurucoin.com/exchange/'.$conversionCurrecy)){
            if($arr = json_decode($resp)){
                if($exc_rate = $arr->value){
                    $convertamount =$convertedamount/$exc_rate;
                    $currency = $conversionCurrecy;

                }
            }
        }
		$data=array(
		'currency'=>$currency,
		'amount'=>$this->round_up($convertamount,2)
		);
		echo json_encode(array('responce'=>$data));
  }
		
		function round_up ($value, $places=0) {
		  if ($places < 0) { $places = 0; }
		  $mult = pow(10, $places);
		  return ceil($value * $mult) / $mult;
		}
		
		public function getdistanceInKms() {

		  $sourceCountry=$this->getcountriesdrop($_POST['sourceCountry']);
		  $destCountry=$this->getcountriesdrop($_POST['destCountry']);
		  $sourcecities=$this->getcities($_POST['sourcecities']);
		  $destcities=$this->getcities($_POST['destcities']);
		  
	      $resp =@file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$sourcecities.','.$sourceCountry.'&destinations='.$destcities.','.$destCountry.'&key=AIzaSyBxfcZr39qQfgEgnFsPwcBGXcq1hq_ZJFE');
          $arr = json_decode($resp);
		  $distance=array();
			foreach($arr as $data){
				
			  foreach($data as $items){
			    foreach($items as $values){
			    foreach($values as $val){
					   foreach($val as $dist){
						$distance[]=$dist;  
						  
						//  echo $dist[0]['distance']['text']; 
						   
					   }
			   }
			   }
			   } 
			}
			$data=array();
			foreach($distance as $values){
				 $data[]=$values;
			}

			$distanceinkm=explode(" ",$data[0]->text);
			echo $distanceinkm[0]*1.6;
			
		}
		
		public function getcountriesdrop($countryId){
		$where="country_id=$countryId";
		$data =$this->Site_model->getDataById("bt_countries",$where);
		return $data[0]['country_name'];
		}
		public function getcities($city_id){
		$where="city_id=$city_id";
		$data =$this->Site_model->getDataById("bt_cities",$where);
		return $data[0]['city_name'];
		}
		
		

  public function edit_offers($id=null){
	  $data['title'] = "Edit Offers";
	   $data['id'] = $id;
      $data ['name'] ="Edit Offers";
      $data ['active'] ="buyer";
      $data ['active2'] ="offers";
      if (!isset($this->session->userdata['logged_in']['user_id'])) {
          header('location:' . base_url() . 'login');
      } else {
          $this->load->view('dashboard/product-mgt/edit_offer', $data);
      }
	}
	
	
public function sendsms(){
		require (APPPATH.'libraries/ujumbeSMS/UjumbeSMS_Gateway.php');
	    $gatewaysms = new UjumbeSMS_Gateway("NjI4YmY5ZjcxNzMwYzFkODMwY2Y4ZWQ3MWY0YmU0", "muthui@churchblaze.com");
		$where = "status=0";
		$smsdata = $this->Site_model->getDataById ('bt_sms', $where );
		if(!empty($smsdata)){
		foreach($smsdata as $sms){

		$sms_id=$sms['id'];
		$smsto=$sms['smsto'];
		$description=$sms['description'];
		
	
			
	   
        $gatewaysms->send($smsto,$description,'CHURCHBLAZE');	
		
		$updatedata=array(
		'status'=>1
		);
		$where = "id=$sms_id";
		$smsdata = $this->Site_model->update('bt_sms',$updatedata,$where );
		}
		}

		

	}

 public  function processreplymsg($id=null){

	$supplierId =$this->session->userdata['logged_in']['user_id'];
	$subject=$_POST['subject'];
	$description=$_POST['message'];
	$customerId=$_POST['customerId'];
     $replyId=$_POST['replyId'];

     $where="id=$replyId";
     $replydata =$this->Site_model->getDataById('bt_enquiry', $where);
     $customerId=$customerId?$customerId:$replydata[0]['user_id'];

	$inquieryData=array(
        'enquired_product' =>$replydata[0]['enquired_product'],
        'prod_id' => $replydata[0]['prod_id'],
        'full_name' => $replydata[0]['full_name'],
        'email' => $replydata[0]['email'],
        'subject' => $subject,
        'message' => $description,
        'receiver_id' => $replydata[0]['user_id'],
        'user_id'=>$supplierId,
        'user_ip' => $_SERVER['REMOTE_ADDR'],
        'msg_read' => 0
	);
	$res =$this->Site_model->add('bt_enquiry', $inquieryData);

     $inquieryData=array(
         'msg_read'=>1
     );
     $res =$this->Site_model->update('bt_enquiry', $inquieryData,$where);


	$qry="SELECT email FROM bt_members where user_id=$customerId";
    $customerdata = $this->Site_model->execute($qry );


	$qry="SELECT email FROM bt_members where user_id=$supplierId";
    $supplierdata = $this->Site_model->execute($qry );
	
	 $enquiryDetails= array(
		'user_id' => "",

		'sender' =>$supplierdata[0]['email'],

		'receiver' =>$customerdata[0]['email'] ,

		'subject' =>$subject,

		'message' =>$description,

		'status' =>0
		);
	 $this->Site_model->add("bt_emails", $enquiryDetails);
	 
	echo 1;
	
 }

    function getStatus(){
        if(isset($_POST['uid'])) {
            $qry = "select `is_online` from bt_members where `user_id`=".$_POST['uid'];
            $getStat = $this->Site_model->execute($qry );
            if($getStat[0]['is_online']==0) {
                echo 'Offline';
            }
            if($getStat[0]['is_online']==1) {
                echo '<font style="color:green; font-weight:700">Online</font>';
            }
        }
    }

    function getMessage(){

        if(isset($_POST['content']) && !empty($_POST['content'])) {
            $uid = isset($this->session->userdata['logged_in']['user_id'])?$this->session->userdata['logged_in']['user_id']:$_POST['receiver'];
            $qry ="select * from bt_members where `user_id`=".$uid;
            $getStat = $this->Site_model->execute($qry );
            if($getStat[0]['is_online']==0) {
                $chatDetails=array(
                    'user_id' => "",

                    'sender' =>$getStat[0]['email'],

                    'receiver' =>"info@blazebay.com",

                    'subject' =>'Blazebay Chat Message From Buyer For Product : ' . $_POST['enquiryFor'],

                    'message' => $_POST['content'],

                    'status' =>0
                );
                $this->Site_model->add("bt_emails", $chatDetails);

            }else{
                $chatDetails=array(
                    'id' =>NULL,

                    'session' =>$_POST['session'],

                    'sender' =>$_POST['sender'],

                    'receiver' =>$_POST['receiver'],

                    'message' => $_POST['content'],

                    'added_on' =>date("Y-m-d H:i:s")
                );
                $this->Site_model->add("bt_chat_messages", $chatDetails);


            }
        }

        $qry ="select * from bt_chat_messages where session='".strtotime(date("Y-m-d"))."'
        and (`sender`='".explode('.',$_SERVER['REMOTE_ADDR'])[3]."' or `receiver`='".explode('.',$_SERVER['REMOTE_ADDR'])[3]."')
        and (`sender`='".$_POST['supplier']."' or `receiver`='".$_POST['supplier']."') order by id asc";
        $getMessage = $this->Site_model->execute($qry );
        $string=" ";
foreach($getMessage as $key=>$fetchMessage) {
if($fetchMessage['sender']==explode('.',$_SERVER['REMOTE_ADDR'])[3]) {
   $string='<li class="right clearfix">
        <div class="chat-body clearfix">
            <p>'.
                $fetchMessage['message'].
            '</p>
            <div class="header">
                <small class="pull-right text-muted">
                    <span class="glyphicon glyphicon-time"></span>'.date("H:i:s", strtotime($fetchMessage['added_on'])).
               ' </small>
            </div>
        </div>
    </li>
    <div class="clear"></div>';

}else{
    $string='<li class="left clearfix">
        <div class="chat-body clearfix">
            <p>'.
                $fetchMessage['message'].
            '</p>
            <div class="header">
                <small class="pull-right text-muted">
                    <span class="glyphicon glyphicon-time"></span>'.date("H:i:s", strtotime($fetchMessage['added_on'])).'</small>
            </div>
        </div>
    </li>
    <div class="clear"></div>';

}
}
        echo $string;
    }
  function agreedProducts(){
       $product_id=$_POST['product_id'];
        $product_price=$_POST['product_price'];
        $product_qty=$_POST['product_qty'];
        $where="id=".$product_id;
       $productDetails=$this->Site_model->getDataById("bt_products",$where);
        $image="https://www.blazebay.com/assets/uploadedimages/".$productDetails[0]["image"];

        $string='	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody><tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img  style="max-width:100px;max-height:100px;"
									src="'.$image.'" alt=" " class="img-responsive"/></div>
									<div class="col-sm-10 text-center">
										<h4 class="nomargin ">'.$productDetails[0]["title"].'</h4>

									</div>
								</div>
							</td>
							<td data-th="Price"><input type="text"  style="width:100px;"
							         class="form-control text-center" value="'.$product_price/$product_qty.'" id="agreed_price" name="price"></td>
							<td data-th="Quantity" >
								<input type="number"  onchange="return calagreedcorder()"  id="agreed_qty" style="width:100px;" class="form-control text-center" value="'.$product_qty.'">
							</td>
							<td data-th="Subtotal" class="text-center"><input type="text"  style="width:100px;"
							         class="form-control text-center" value="'.$product_price .'" id="agreed_subtotal" name="subtotal"></td>
							<td class="actions" data-th="">
								<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong><div id="agreed_subtotal"></div></strong></td>
						</tr>

					</tfoot>
				</table>';

  echo  $string;
    }


    function postInquiry(){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $product=$_POST['product'];
        $port=$_POST['port'];
        $amount=$_POST['amount'];
        $payment=$_POST['payment'];
        $user_id=$this->session->userdata['logged_in']['user_id'];

        $qry="SELECT p.uid,m.email,p.id as pid,m.mobile,m.phone,m.firstname
      FROM bt_products p
      RIGHT JOIN bt_members m ON m.user_id = p.uid
      WHERE  m.suspended='N'  AND  p.approved = 'yes'
       AND p.price <>0  AND p.price <>'' AND p.title LIKE '%" . $product . "%'  GROUP BY p.uid";

        $Quote = $this->Site_model->execute($qry);
        if(!empty($Quote)) {
            foreach ($Quote as $key=> $Quote_data) {
            $enqdata = array(
                'enquired_product' => $product,
                'prod_id' => $Quote_data['pid'],
                'full_name' => $name,
                'email' => $email,
                'subject' => $name.' '.', a blazebay customer, is requesting for'.' '.$product.' '.' quotation on blazebay.com',
                'message' => $name.' '.', a blazebay customer, is requesting for'.' '.$product.' '.' quotation on blazebay.com',
                'receiver_id' => $Quote_data['uid'],
                'user_id' => $this->session->userdata['logged_in']['user_id'],
                'user_ip' => $_SERVER['REMOTE_ADDR'],
                'msg_read' => 0
            );
            $inserted = $this->Site_model->add('bt_enquiry', $enqdata);

            $enqdata = array(
                'smsfrom' => '+254-741-403-640',
                'smsto' => $Quote_data['mobile'] ? $Quote_data['mobile'] : $Quote_data['phone'],
                'description' => 'Hello ' . $Quote_data['firstname'] . ' one customer is online enquiring about ' . $product . ' Please respond through  your blazebay account and the email sent to your email',
                'status' => 0,
                'user_id' => $this->session->userdata['logged_in']['user_id']

            );
            $inserted = $this->Site_model->add('bt_sms', $enqdata);

            $enquiryDetails = array(
                'user_id' => $this->session->userdata['logged_in']['user_id'],

                'sender' => $email,

                'receiver' => $Quote_data['email'],

                'subject' =>$name.' '.', a blazebay customer, is requesting for'.' '.$product.' '.' quotation on blazebay.com',

                'message' => $name.' '.', a blazebay customer, is requesting for'.' '.$product.' '.' quotation on blazebay.com',

                'status' => 0
            );
            $this->Site_model->add("bt_emails", $enquiryDetails);
        }
        }
        echo 1;
    }


    public function currencyConvertion(){

        $this->session->unset_userdata('convertAmount');
        $this->session->unset_userdata('convertSymbol');
        $currentCurrency=$_POST['currency'];
        if($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')){
            if($arr = json_decode($resp)){
                if($exc_rate = $arr->value){
                    $convertExchange=$exc_rate;

                }
            }
        }
if($currentCurrency=='USD'){
    $convertAmount=1;
    $convertSymbol='USD';
} else if($currentCurrency=='KSH'){
    $convertAmount=$convertExchange;
    $convertSymbol='KSH';
} else if($currentCurrency=='NURUCOIN'){
    $convertAmount=$convertExchange/10;
    $convertSymbol='NRCT';
}else{
    $convertAmount=$convertExchange;
    $convertSymbol='KSH';
}

        $data=array(
            'convertAmount'=>$convertAmount,
            'convertSymbol'=>$convertSymbol
        );
       $res=$this->session->set_userdata( 'currencyConvertion', $data);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }

    function switchLang($language = "") {


        $language=$_POST['language'];
        $language = ($language != "") ? $language : "english";

        $this->session->set_userdata('site_lang', $language);

        echo 1;

    }

    function gextracustomerdetails(){
        $where = "user_id=".$this->session->userdata['logged_in']['user_id']." AND  prod_id=".$_POST['productId']." AND  `date`='".date('Y-m-d')."'";
        $res=$this->Site_model->getDataById("bt_customer_tempoders",$where);
        $data['details']=$res[0]['details'];

        $this->load->view('pages/orders/sticky',$data);
    }

    function postextraordersdetails(){

        $where = "user_id=".$this->session->userdata['logged_in']['user_id']." AND  prod_id=".$_POST['productId']." AND  `date`='".date('Y-m-d')."'";
        $res=$this->Site_model->getDataById("bt_customer_tempoders",$where);
        if(empty($res)) {
            $inquieryData = array(
                'details' => strip_tags($_POST['details']),
                'prod_id' => $_POST['productId'],
                'date' => date('Y-m-d'),
                'user_id' => $this->session->userdata['logged_in']['user_id'],
            );
            $res = $this->Site_model->add('bt_customer_tempoders', $inquieryData);
        }else{
            $details= strip_tags($_POST['details']);
            $inquieryData = array(
                'details' =>$details
            );
            $where = "user_id=".$this->session->userdata['logged_in']['user_id']." AND  prod_id=".$_POST['productId'];
            $res = $this->Site_model->update('bt_customer_tempoders', $inquieryData,$where);
        }
    }

    function newmessage(){

        $uid =$this->session->userdata['logged_in']['user_id'];
        $qry ="select * from bt_members where `user_id`=".$uid;
        $rrs0_query= $this->Site_model->getcountRecods($qry);

        $orderDetails= array(

            'user_id' => $uid,

            'sender' =>$rrs0_query[0]['email'],

            'receiver' =>"info@blazebay.com",

            'subject' =>$_POST['subject'],

            'message' =>$_POST['message'],

            'status' =>0
        );

        $this->Site_model->add("bt_emails", $orderDetails);

        $orderDetails= array(

            'user_id' =>$uid,

            'sender' =>$rrs0_query[0]['email'],

            'receiver' =>$_POST['to'],

            'subject' =>$_POST['subject'],

            'message' =>$_POST['message'],

            'status' =>0
        );

        $this->Site_model->add("bt_emails", $orderDetails);

        echo 1;
    }

    function orderCardPayment(){

        require('init.php');
                if($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')){
            if($arr = json_decode($resp)){
                if($exc_rate = $arr->value){
                    $convertExchange=$exc_rate;

                }
            }
        }
        if($_POST['productcurrency']=='USD'){
            $convertAmount=1;
            $amount=$_POST['totalproductprice'];
        } else if($_POST['productcurrency']=='KSH'){
            $convertAmount=$convertExchange;
            $amount=$_POST['totalproductprice']/$convertAmount;
        }else{
            $amount=0;
        }

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
try {
    if ($amount == 0) {
        $code=0;
        redirect(base_url().$_POST['callbackUrl']);
    } else {
        $charge = \Stripe\Charge::create([
            'amount' => ceil($amount),
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);

        $msg = $charge['description'];
        if ($charge['status'] == 'succeeded') {
            $data=array(
                'code'=>0,
                'msg'=>'Success'
            );
            $this->load->view ( 'dashboard/order-mgt/buyer_orderlist', $data );
        } else {
            $code=0;
            $data=array(
                'code'=>0,
                'msg'=>'Failed'
            );
        }
        redirect(base_url().$_POST['callbackUrl']);
    }
}
    catch(Exception $e){
        $code=0;
        $data=array(
        'code'=>1,
        'msg'=>$e->getMessage()
        );
        $this->load->view ( 'dashboard/order-mgt/buyer_orderlist', $data );
    }


}

    function getQuotes(){

        $categoryId=$_POST['category'];

        $prev="bt_";
        $dotcom="www.blazebay.com";

        $user_id=$this->session->userdata['logged_in']['user_id'];
        $userDetails =$this->Site_model->getDataById($prev.'members',"user_id='$user_id'");
        $name=$userDetails[0]['firstname'];
        $email=$userDetails[0]['email'];

        $category =$this->Site_model->execute("SELECT cat_name FROM bt_categories WHERE group_id=" . $categoryId . "");



         if(empty($user_id)){
             header('location:' . base_url());
        }

        else {
                       $qry = "SELECT p.uid,m.email,p.id as pid,m.mobile,m.phone,m.firstname
      FROM bt_products p
      RIGHT JOIN bt_members m ON m.user_id = p.uid
      RIGHT JOIN bt_product_cats cat ON cat.offer_id=p.id
      WHERE  m.suspended='N'  AND  p.approved = 'yes'
       AND p.price <>0  AND p.price <>''  AND   cat.cid IN (SELECT id FROM bt_categories WHERE group_id=" . $categoryId . " ) GROUP BY p.uid";

            $catname = $category[0]['cat_name'];
            $Quote = $this->Site_model->execute($qry);
            if (!empty($Quote)) {
                foreach ($Quote as $key => $Quote_data) {
                    $enqdata = array(
                        'enquired_product' => $catname,
                        'prod_id' => $Quote_data['pid'],
                        'full_name' => $name,
                        'email' => $email,
                        'subject' => $name . ' ' . ', a blazebay customer, is requesting for' . ' ' . $catname . ' ' . ' quotation on blazebay.com',
                        'message' => $name . ' ' . ', a blazebay customer, is requesting for' . ' ' . $catname . ' ' . ' quotation on blazebay.com',
                        'receiver_id' => $Quote_data['uid'],
                        'user_id' => $user_id,
                        'user_ip' => $_SERVER['REMOTE_ADDR'],
                        'msg_read' => 0
                    );
                    $inserted = $this->Site_model->add('bt_enquiry', $enqdata);

                    $enqdata = array(
                        'smsfrom' => '+254-741-403-640',
                        'smsto' => $Quote_data['mobile'] ? $Quote_data['mobile'] : $Quote_data['phone'],
                        'description' => 'Hello ' . $Quote_data['firstname'] . ' one customer is online enquiring about ' . $catname . ' Please respond through  your blazebay account and the email sent to your email',
                        'status' => 0,
                        'user_id' => $this->session->userdata['logged_in']['user_id']

                    );
                    $inserted = $this->Site_model->add('bt_sms', $enqdata);

                    $enquiryDetails = array(
                        'user_id' => $user_id,

                        'sender' => $email,

                        'receiver' => $Quote_data['email'],

                        'subject' => $name . ' ' . ', a blazebay customer, is requesting for' . ' ' . $catname . ' ' . ' quotation on blazebay.com',

                        'message' => $name . ' ' . ', a blazebay customer, is requesting for' . ' ' . $catname . ' ' . ' quotation on blazebay.com',

                        'status' => 0
                    );
                    $this->Site_model->add("bt_emails", $enquiryDetails);
                }
            }
            echo 1;
        }

    }



 }