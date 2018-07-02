<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
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

    function __construct() {
        parent::__construct ();
        $this->pdo = $this->load->database ( 'pdo', true );
        $this->load->helper ( 'form' );
        $this->load->library ( 'session' );
        $this->load->model('Mini_site_model');
        $this->load->model('Site_model');
        $this->load->library('upload');
        $this->load->library('user_agent');

          }



     function postProducts(){
        $data ['title'] = "Post Products";
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
     function manageProducts(){
        $data ['title'] = "Manage Products";
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
    public function RemoveBadURLCharaters($str) {
        return mb_strtoupper(preg_replace("/[^0-9a-zA-Z]+/", "-", $str));
    }
     function productDetails($productName=null,$productId=null,$userId=null){
         $data ['title'] =$this->RemoveBadURLCharaters($productName);
         $data ['active'] ='buyer';
         $data ['productName'] = $productName;
         $data ['productId'] = $productId;

         $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
         $prodata = $this->Site_model->productDetails($productId);
         $data ['description'] = $prodata[0]['description'];
         $data ['url'] = base_url().'product-details/'.$this->RemoveBadURLCharaters($prodata[0]['title']).'/'.$prodata[0]['pid'].'/'.$prodata[0]['uid'];
         $data ['image'] ='https://www.blazebay.com/assets/uploadedimages/'.$prodata[0]['image'];
  if(!empty($prodata)){
      $data ['productDetails'] =$prodata;
  }else{
      $qry="SELECT o.*, o.buyoffer_image image,m.firstname,m.lastname,m.email,m.street,m.city,m.state,
                      m.country,m.address,m.phone,m.fax,m.zip,m.usertype,m.user_id FROM bt_offers_buy as o
                      JOIN  bt_members m ON m.user_id = o.uid WHERE o.id =".$productId." ";
$buyoffers=$this->Site_model->execute($qry);
      $data ['productDetails'] =$buyoffers;
      $data ['offerType'] ='Buyoffer';

  }

         $data ['productImages'] = $this->Site_model->productImages($productId);
         $data ['productId'] = $productId;
         $where="offer_id ='$productId'";
         $prodcat= $this->Site_model->getDataById( $table = "bt_product_cats", $where );

         $where="id =".$prodcat[0]['cid'];
         $cat= $this->Site_model->getDataById( $table = "bt_categories", $where );
         $data ['link'] = base_url().$cat[0]['cat_name'].'/'.$prodcat[0]['cid'];
         $data ['categoryName'] =$cat[0]['cat_name'];
         $data ['name'] = $productName;

         if($prodcat[0]['cid']!=0 ||$prodcat[0]['cid']!=""){
             $data ['relatedproducts'] = $this->Site_model->relatedproducts($prodcat[0]['cid']);

         }
         $sql = "SELECT COUNT(*) as total, SUM(review_rating)/COUNT(id) as avg, (SELECT COUNT(*)
		FROM bt_reviews WHERE review_rating = 1) as one_star,(SELECT COUNT(*) FROM bt_reviews WHERE review_rating = 2) as two_star,
		(SELECT COUNT(*) FROM bt_reviews WHERE review_rating = 3) as three_star,(SELECT COUNT(*) FROM bt_reviews WHERE review_rating = 4) as four_star,
		(SELECT COUNT(*) FROM bt_reviews WHERE review_rating = 5) as five_star FROM bt_reviews WHERE product_id = $productId";
         $rating_stats = $this->Site_model->execute($sql);

         $data['rating_stats'] =$rating_stats;

         $qry="SELECT * FROM bt_reviews as r JOIN  bt_members as m ON  m.user_id = r.user_id WHERE
  r.product_id=".$productId." AND  m.suspended='N' AND  m.usertype=1 ORDER BY review_date";
         $res = $this->Site_model->execute($qry);
         $data['reviews_ratings']=$res;
         if ($this->agent->is_mobile())
         {
             $this->load->view ( 'mobile/products/product-details', $data);
         }

         else
         {
             $this->load->view ( 'pages/products/product-details', $data );
         }

    }
	
	 function whoproductDetails($productName=null,$productId=null,$userId=null){

         $data ['title'] =$this->RemoveBadURLCharaters($productName);
         $data ['active'] ='buyer';
         $data ['productName'] = $productName;
         $data ['productId'] = $productId;
         $data ['userId'] = $userId;
         $data ['producttype'] ='wholesale';
         $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
         $data ['productDetails'] = $this->Site_model->productDetails($productId);
         $data ['productImages'] = $this->Site_model->productImages($productId);
         $where="offer_id ='$productId'";
         $prodcat= $this->Site_model->getDataById( $table = "bt_product_cats", $where );

         $where="id =".$prodcat[0]['cid'];
         $cat= $this->Site_model->getDataById( $table = "bt_categories", $where );
         $data ['link'] = base_url().$cat[0]['cat_name'].'/'.$prodcat[0]['cid'];
         $data ['categoryName'] =$cat[0]['cat_name'];
         $data ['name'] = $productName;

         if($prodcat[0]['cid']!=0 ||$prodcat[0]['cid']!=""){
             $data ['relatedproducts'] = $this->Site_model->relatedproducts($prodcat[0]['cid']);

         }
         $sql = "SELECT COUNT(*) as total, SUM(review_rating)/COUNT(id) as avg, (SELECT COUNT(*)
		FROM bt_reviews WHERE review_rating = 1) as one_star,(SELECT COUNT(*) FROM bt_reviews WHERE review_rating = 2) as two_star,
		(SELECT COUNT(*) FROM bt_reviews WHERE review_rating = 3) as three_star,(SELECT COUNT(*) FROM bt_reviews WHERE review_rating = 4) as four_star,
		(SELECT COUNT(*) FROM bt_reviews WHERE review_rating = 5) as five_star FROM bt_reviews WHERE product_id = $productId";
         $rating_stats = $this->Site_model->execute($sql);

         $data['rating_stats'] =$rating_stats;

         $qry="SELECT * FROM bt_reviews as r JOIN  bt_members as m ON  m.user_id = r.user_id WHERE
  r.product_id=".$productId." AND  m.suspended='N' AND  m.usertype=1 ORDER BY review_date";
         $res = $this->Site_model->execute($qry);
         $data['reviews_ratings']=$res;

         if ($this->agent->is_mobile())
         {
             $this->load->view ( 'mobile/products/product-details', $data);
         }

         else
         {
             $this->load->view ( 'pages/products/product-details', $data );
         }
    }
	
   function all($searterm=null,$page=null,$pageId=null){
	   if($searterm==''){
		   $data ['title'] = "All Products"; 
	   }else{
		   $data ['title'] = $this->RemoveBadURLCharaters($searterm);
	   }

       $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
       $data ['name'] =$this->RemoveBadURLCharaters($searterm);
       $data ['search'] =$this->RemoveBadURLCharaters($searterm);
       $data ['active'] ='buyer';
       $data ['Getpage'] = $pageId;
       $data ['page'] = $page;

       if ($this->agent->is_mobile())
       {
           $this->load->view ( 'mobile/products/products', $data);
       }

       else
       {
           $this->load->view ( 'pages/products/products', $data );
       }


    }

    function listProducts($page=null,$pageId=null){
        $data ['title'] = "All Products";
        $data ['name'] ="All Products";
        $data ['active'] ='buyer';
        $data ['Getpage'] = $pageId;
        $data ['page'] = $page;

        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/products/products', $data);
        }

        else
        {
            $this->load->view ( 'pages/products/products', $data );
        }

    }
	function searchInPage($searterm=null,$page=null,$pageId=null){
        $data ['name'] =$this->RemoveBadURLCharaters($searterm);
        $data ['search'] =$this->RemoveBadURLCharaters($searterm);
        $data ['active'] ='buyer';
        $data ['Getpage'] = $pageId;
        $data ['page'] = $page;

        $this->load->view ( 'pages/products', $data );
	
	}
	 function allcategories($searterm,$catId,$page=null,$pageId=null){
        $data ['title'] = "All Products";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['tagline'] = "CALL US :";
        $data ['contact'] = "+254-741-403-640";
        $data ['inCart_count'] = "2";
        $data ['Getpage'] = $pageId;
		$data ['getcid'] =$catId;
         $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
		$data ['getcategory'] =$searterm;
        $data ['link'] = base_url().$searterm.'/'.$catId;
        $data ['categoryName'] =$searterm;
        $data ['name'] = $searterm;
         $data ['active'] ='buyer';
         if ($this->agent->is_mobile())
         {
             $this->load->view ( 'mobile/products/products', $data);
         }

         else
         {
             $this->load->view ( 'pages/products/products', $data );
         }

     }
    function industries($searterm,$catId,$page=null,$pageId=null){
        $data ['title'] = $searterm;
        $data ['hotSellingProducts_details'] = $this->Site_model->gethotSellingProducts();
        $data ['industries'] ='industries';
        $data ['Getpage'] = $pageId;
        $data ['getcid'] =$catId;
        $data ['getcategory'] =$searterm;
        $data ['link'] = base_url().$searterm.'/'.$catId;
        $data ['categoryName'] =$searterm;
        $data ['name'] = $searterm;
        $data ['active'] ='buyer';
        if ($this->agent->is_mobile())
        {
            $this->load->view ( 'mobile/products/products', $data);
        }

        else
        {
            $this->load->view ( 'pages/products/products', $data );
        }

    }


	function sellerProducts($sellerName=null,$sellerId=null){
        $data ['title'] = "Seller Products";
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
     function allProductsUnder(){
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
     function wholesellerProductsDetails(){
        $data ['title'] = "Wholeseller Products Details";
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
     function productOffers($name=null,$id=null){
        $data ['title'] = "product Offers";
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['tagline'] = "CALL US :";
        $data ['contact'] = "+254-741-403-640";
        $data ['id'] = $id;

        $this->load->view ( 'pages/productOfferDetails', $data );
    }
     function productSupplier($supplierName,$uid,$id,$country){
        $data ['title'] =$supplierName;
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['tagline'] = "CALL US :";
        $data ['contact'] = "+254-741-403-640";
        $data ['uid'] =$uid;
		$data ['id'] =$id;
		$data ['country'] =$country;
		

        $session = array(
            'username'  => 'Sajal Soni',
            'user_id'     => 1,
            'first_name' => '@sajalsoni',
            'email' => '@sajalsoni',
            'second_name' =>'test'
        );
        $user_session= $this->session->set_userdata ( 'userData', $session);

        $this->load->view( 'pages/productSupplier', $data );
    }
	
	function addtofav(){
		 $favdata = array(
			 'fev_product_id' =>$_POST['product'],
			'fev_user_id  ' =>$this->session->userdata['logged_in']['user_id'],
			'fev_add_date'=>date("Y-m-d H:i:s"),
             'type'=>$_POST['type']
			);

	$res =$this->Site_model->add('bt_favourite_list',$favdata); 
	echo $res;
	}
	
	   function allfeatured($searterm=null,$page=null,$pageId=null){
	   if($searterm==''){
		   $data ['title'] = "All Featured Products"; 
	   }else{
		   $data ['title'] = urlencode($searterm); 
	   }
		if($searterm=='page'){
			$data ['getProduct'] ='';
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
			$data ['type'] = 'featured';
		}else{
			$data ['getProduct'] = $searterm;
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
			$data ['type'] = 'featured';
		}

           if ($this->agent->is_mobile())
           {
               $this->load->view ( 'mobile/products/products', $data);
           }

           else
           {
               $this->load->view ( 'pages/products/products', $data );
           }

    }
		
	   function allwholesale($searterm=null,$page=null,$pageId=null){
	   if($searterm==''){
		   $data ['title'] = "All Wholesale Products"; 
	   }else{
		   $data ['title'] = urlencode($searterm); 
	   }
		if($searterm=='page'){
			$data ['getProduct'] ='';
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
			$data ['type'] = 'wholesale';
		}else{
			$data ['getProduct'] = $searterm;
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
			$data ['type'] = 'wholesale';
		}

           if ($this->agent->is_mobile())
           {
               $this->load->view ( 'mobile/products/products', $data);
           }

           else
           {
               $this->load->view ( 'pages/products/products', $data );
           }

       }
      public function filter_product($value=null,$page=null,$pageId=null){

		    $data ['title'] = "Products Below"." ".$value; 
		    $data ['getProduct'] = $value;
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
			$data ['type'] = 'wholesale';
			$data ['value'] = $value;
        $this->load->view ( 'pages/products', $data );	
	}
	
	 function getTradeproducts($searterm=null,$page=null,$pageId=null){
		 
	   if($searterm==''){
		   $data ['title'] = "All Products"; 
	   }else{
		   $data ['title'] = urlencode($searterm); 
	   }
       
        $data ['keywords'] = "Ecommerce";
        $data ['description'] = "blazebay  is for you, for me, and for all of us, where you can buy, sell, trade and find what you want,  blazebay.com covers the entire world.";
        $data ['tagline'] = "CALL US :";
        $data ['contact'] = "+254-741-403-640";
        $data ['inCart_count'] = "2";
		if($searterm=='page'){
			$data ['getProduct'] ='';
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
		}else{
			$data ['getProduct'] = $searterm;
			$data ['Getpage'] = $page;
			$data ['page'] = $page;
		}
        
		
		

        $this->load->view ( 'pages/tradesecurityproducts', $data );
    }
 public function autocomplete($searchtearm=null){
	 
	 $searchtearm=$_POST['phrase'];
	 $qry="SELECT title as name FROM `bt_products` WHERE `title` LIKE'%$searchtearm%' ";
	 $searchData=$this->Site_model->execute($qry);
	 $search=array();
	 foreach($searchData as $sdata){
		$search[]=$sdata; 
	 }
	
		echo json_encode($search);
	 }
	 
	public function my_wholesale_products_list($approved=null,$page=null,$pageId=null){
        if(!isset($this->session->userdata['logged_in']['user_id'])){
            header('location:'.base_url().'login');}
        else {
            $data ['title'] = "More products";
            $data['active'] = "forsupplier";
            $data['name'] = "More products";
            $data['active2'] = "products";
            $data['approved_products'] = $approved;


            $this->load->view('dashboard/product-mgt/more-products', $data);
        }
	}
}
    ?>