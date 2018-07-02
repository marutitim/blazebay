<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Api extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		$this->pdo = $this->load->database ( 'pdo', true );
		$this->load->model('Site_model');
		include ('application/libraries/phpmailer/sendEmail.php');
    }
	public function loginUser_post(){
		$username =$this->post( 'username' );
		$pwd = $this->post( 'password' );
	if( $username=="") {
		$resArr['message']='Please enter your username';
		$resArr['statusCode'] = 301;
        $this->set_response ( $resArr, 301);
		
	}
	else if($pwd=="") {
		$resArr['message']='Please enter your password';
		$resArr['statusCode'] = 301;
        $this->set_response ( $resArr, 301);
		
	}else{
		$password = md5($pwd);
		$where = "(username = '" . $username . "' OR email = '".$username."') AND password = '" . $password . "' AND suspended='N'";
		
		$checklogin= $this->Site_model->getDataById( 'bt_members', $where );
		$user=array(
		1=>'Admin',
		2=>'Supplier',
		3=>''
		);
        if (! empty ($checklogin)) {
			    $resArr['statusCode'] = 201;
				$loginData ['user_id'] = $checklogin [0]['user_id'] ;
                $loginData ['username'] = $checklogin [0]['username'] ;
                $loginData ['role'] = $user[$checklogin [0] ['usertype']];
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
				$loginData ['memtype']=$checklogin[0]["memtype"];
				if(file_exists('assets/uploadedimages/'.$checklogin[0]['user_img'])){
					$loginData['profileImage']=base_url().'assets/uploadedimages/'.$checklogin[0]['user_img'];
					 }else{
					$loginData['profileImage']=base_url().'assets/uploadedimages/picavartar.jpg';	 
					 }

			
               $this->set_response($loginData,201);
        }else{
            $resArr['message']='Invalid credentials';
			$resArr['statusCode'] = 301;
            $this->set_response( $resArr, 301);
        }
	}
	}
	
	public function registerUser_post(){
		
		
			$ip         = $_SERVER['REMOTE_ADDR'];
			$username   = $this->post('username');
			$first_name = $this->post('firstname');
			$last_name  = $this->post('lastname');
			$email      = $this->post('email');
			$pass       = $this->post('password');
			$street      = $this->post('street');
			$phone      = $this->post('phone');
			$city        = $this->post('city');
			$state     = $this->post('user_state');
			$mobile     = $this->post('mobile');
			$country = $this->post('country');
			$signup_user_type    = $this->post('role');
			$postal_code  = $this->post('postal_code');
		    
			if($signup_user_type=='buyer'){
				$memtype=1;
			}
			else if($signup_user_type=='supplier'){
				$memtype=2;
			}else{
				$memtype=4;
			}
		

	if( $username=="" || $email=="" || $first_name =="" || $last_name==""  || $pass==""  || $phone=="" ||$city=="" ) {
		$resArr['message']='Please enter all the fields to register';
		$resArr['statusCode'] = 301;
        $this->set_response ( $resArr, 301);
		
	}else{	
		$prev="bt_";
		$dotcom="www.blazebay.com";
		$check_username =$this->Site_model->getDataById($prev.'members',"username='$username'");
		$check_email =$this->Site_model->getDataById($prev.'members',"email='$email'");
		

		if($check_username[0]['user_id']>0){
			$resArr['message']='The username Exists,please try a different one';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
		
		else if($check_email[0]['user_id']>0){ 
		$resArr['message']='The email Already Exists.please try a different one';
		$resArr['statusCode'] = 301;
        $this->set_response ( $resArr, 301);	
		}
		
		else {
			$pass       = md5( $pass);
			$data =array(
		    'username'  =>$username,
			'usertype'  =>$memtype,
			'password'  =>$pass,
			'firstname' =>$first_name,
			'lastname  '=>$last_name,
			'email' =>$email,
			'street '   =>$street,
			'country '  =>$country,
			'city      '=>$city,
			'state    ' =>112,
			'address'=>$postal_code?$postal_code:0,
			'phone'     =>$phone,
			'mobile   '=>$mobile,
			'user_img  '=>'',
			'suspended '=>'Y'
			);			
			$res=$this->Site_model->add('bt_members',$data);
			if($res){
				$from ='no-reply@blazebay.com';
                $to = $email;
                $subject = "Activate Your Blazebay Account";
				$name=$first_name;
				$token=md5($res);

                $content='<p>Hi,'.' '.$first_name.'</p>
                        <p>Welcome to <a href="https://wwww.blazebay.com">Blazebay</a>. Thank you for registering with us. Click <br>
						<a href="https://www.blazebay.com/activate-account/'.$token.'" target="_blank">Activate Account</a> <br> or Click the activate button.</a></p>';

                    $orderDetails= array(

                        'user_id' => $res,

                        'sender' => "info@blazebay.com",

                        'receiver' =>$email,

                        'subject' =>'Activate Your Blazebay Account',

                        'message' =>$content,

                        'status' =>0
                    );

                    $this->Site_model->add("bt_emails", $orderDetails);


				
			  $resArr['message']='Registration Successful Please check your email to activate your account.You can also check the email in the Spam folder';
			  $resArr['statusCode'] = 200;
              $this->set_response ( $resArr, 200);
			 
			}else{
			  $resArr['message']='An error occured while creating your account';
			  $resArr['statusCode'] = 301;
              $this->set_response( $resArr, 301);	
			}
		}
	}
	}
	
	public function getProducts_get(){
				$limit=500;
				$productData= $this->Site_model->getallProducts($limit);
		        $proData['statusCode'] = 200;
			   
			   	//buy offers
				$bqry  = " SELECT buy.id  FROM bt_offers_buy as buy JOIN  bt_members as m ON m.user_id=buy.uid 
				WHERE buy.approved='yes' AND buy.expireson > NOW()";
				$buyData= $this->Site_model->execute($bqry);
				//sell offers
				$sqry  = "SELECT p.id
				FROM  bt_products as p  JOIN  bt_offers as o ON p.id=o.prod_id  WHERE p.wholesale='0' AND o.approved='yes' AND o.expireson > NOW() ";
				$sellData= $this->Site_model->execute($sqry);
				
                //hotselling data
 
                $sql='SELECT p.id FROM  bt_products as p  RIGHT JOIN   bt_members as m ON m.user_id = p.uid WHERE m.suspended="N" AND p.approved ="yes" AND p.wholesale="0"  AND p.image !=""
				ORDER BY p.id  DESC LIMIT 12';
				
				$hotSellingData= $this->Site_model->execute($sql);
				
				
				foreach($productData as $value){
                $proData ['productname'] = $value['title'];
                $proData ['price'] = $value['price'];
                $proData ['discountPrice'] = 0;
                $proData ['description'] =$value['description'];
                $proData ['product_id'] = $value['id'];
				
				
			    $salepro_rate_info = $this->Site_model->getRowData('bt_ratings',"ratedto='".$value['id']."' AND type_rate='P'");
                $proData ['ratings'] =$salepro_rate_info[0]['rating'];
                $proData ['quantity_range'] ='';
                $proData ['qty'] =$value['qty_unit'];
                $proData ['min_qty'] = $value['min_order'];
                $proData ['product_category'] = '';
				if (in_array($value['id'], $buyData))
				  {
				 $proData ['product_type'] ="BuyOffer";
				  }
				else if (in_array($value['id'], $sellData))
				  {
				 $proData ['product_type'] ="SellOffer";
				  }
				  else if(in_array($value['id'], $hotSellingData)){
					 $proData ['product_type'] ="HotSelling";  
				  }
				else{
				$productType=array(
				1=>'Wholesale',
				0=>'Featured'
				);
				$proData ['product_type'] = $productType[$value['wholesale']];  
				  }
			
				$proData ['whole_sale_product'] = $value['wholesale'];
				
				$sql="SELECT img_url FROM bt_product_images WHERE offer_id='".$value['id']. "' ORDER BY id DESC";
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "' ");
				
			
				if(!empty($productImages)){
				$proimage=array();	
				foreach($productImages as $img){
					 if(file_exists('assets/multimage/'.$img['img_url'])){
					$productImageData['image_name']=base_url().'assets/multimage/'.$img['img_url'];
					 }else{
					$productImageData['image_name']=base_url().'assets/uploadedimages/'.$img['img_url'];	 
					 }
					$proimage[]=$productImageData;
				}
				}
				$proData ['productImages'] =array_unique($proimage);
				
				$productDetails['color']=$productData[0]['color'];
				$productDetails['Location']=$productData[0]['location'];
				$productDetails['Samples Available']=$productData[0]['samples_available'];
				$productDetails['New Product']=$productData[0]['new'];
				
				$proData ['productDetails'] = $productDetails;
				
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "'");
				
				$where="user_id = '".$value['uid']."'";
                $business_details= $this->Site_model->getDataById( $table = "bt_business", $where );
				foreach($business_details as $biz){
				$companyDetails['company_name']=$biz['company_name'];
				$companyDetails['services']=$biz['services'];
				$companyDetails['image_name']=$biz['address1'];
				
				$companyDetails['minisite']='https://'.strtolower($biz["minisite_prefix"]).'.blazebay.com';
				
				$proData['companyDetails']= $companyDetails;
				}
				
				$productinfo [] = $proData;
				}
				$data=array(
				'data'=>$productinfo,
				'statusCode'=>200
				);
                $this->set_response($data,200);
	}
   
   
   public function getAllProductsByType_get(){
	    $limit=20;
				$producttype = $this->get('product_type');
				$currency = $this->get('currency');
				if($producttype==''){
					 $resArr['message']='Please enter Product type';
			         $resArr['statusCode'] = 301;
					 $this->set_response($resArr,301);
				    $this->set_response($resArr,301);
				}else{
					if($producttype=='latest'){
					$productData=$this->Site_model->getallProducts($limit);;	
					}else{
				$productData= $this->Site_model->getallProductType($limit,$producttype);
					}
		        $proData['statusCode'] = 200;
			   
			   	//buy offers
				$bqry  = " SELECT buy.id  FROM bt_offers_buy as buy JOIN  bt_members as m ON m.user_id=buy.uid 
				WHERE buy.approved='yes' AND buy.expireson > NOW() LIMIT 12";
				$buyData= $this->Site_model->execute($bqry);
				//sell offers
				$sqry  = "SELECT p.id
				FROM  bt_products as p  JOIN  bt_offers as o ON p.id=o.prod_id  WHERE p.wholesale='0' AND o.approved='yes' AND o.expireson > NOW() LIMIT 12 ";
				$sellData= $this->Site_model->execute($sqry);
				
                //hotselling data
 
                $sql='SELECT p.id FROM  bt_products as p  RIGHT JOIN   bt_members as m ON m.user_id = p.uid WHERE m.suspended="N" AND p.approved ="yes" AND p.wholesale="0"  AND p.image !=""
				ORDER BY p.id  DESC LIMIT 12';
				
				$hotSellingData= $this->Site_model->execute($sql);
				
				
				foreach($productData as $value){
                $proData ['productname'] = $value['title'];
				
				if($currency!=""){
					
					if($resp = @file_get_contents('https://www.nurucoin.com/exchange/usd')){
						if($arr = json_decode($resp)){
							if($exc_rate = $arr->value){
								$amount =  $value['price'] * $exc_rate;
							}
						}
					}
			   $proData ['price'] =ceil($amount);
				}else{
					$proData ['price'] = $value['price'];
				}
                
				$proData ['originalprice'] = $value['price'];
				$currencyId=$value['price_cur_id'];
				$currencies=array(
				2=>'INR',
				3=>'GBP',
				4=>'USD',
				9=>'BMD',
				11=>'NGN',
				13=>'AWG',
				15=>'KSH'
				);
				$proData ['originalcurrency'] =$currencies[$currencyId];
				
				$proData ['convertedcurrency'] =strtoupper($currency)?strtoupper($currency):'';
				
                $proData ['discountPrice'] = 0;
                $proData ['description'] =$value['description'];
                $proData ['product_id'] = $value['id'];
				
				
			    $salepro_rate_info = $this->Site_model->getRowData('bt_ratings',"ratedto='".$value['id']."' AND type_rate='P'");
                $proData ['ratings'] =$salepro_rate_info[0]['rating'];
                $proData ['quantity_range'] ='';
                $proData ['qty'] =$value['qty_unit'];
                $proData ['min_qty'] = $value['min_order'];
                $proData ['product_category'] = '';
				if (in_array($value['id'], $buyData))
				  {
				 $proData ['product_type'] ="BuyOffer";
				  }
				else if (in_array($value['id'], $sellData))
				  {
				 $proData ['product_type'] ="SellOffer";
				  }
				  else if(in_array($value['id'], $hotSellingData)){
					 $proData ['product_type'] ="HotSelling";  
				  }
				else{
				$productType=array(
				1=>'Wholesale',
				0=>'Featured'
				);
				$proData ['product_type'] = $productType[$value['wholesale']];  
				  }
			
				$proData ['whole_sale_product'] = $value['wholesale'];
				
				$sql="SELECT img_url FROM bt_product_images WHERE offer_id='".$value['id']. "' ORDER BY id DESC";
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "' ");
				
			
				if(!empty($productImages)){
				$proimage=array();	
				foreach($productImages as $img){
					 if(file_exists('assets/multimage/'.$img['img_url'])){
					$productImageData['image_name']=base_url().'assets/multimage/'.$img['img_url'];
					 }else{
					$productImageData['image_name']=base_url().'assets/uploadedimages/'.$img['img_url'];	 
					 }
					$proimage[]=$productImageData;
				}
				}
				$proData ['productImages'] =array_unique($proimage);
				
				$productDetails['color']=$productData[0]['color'];
				$productDetails['Location']=$productData[0]['location'];
				$productDetails['Samples Available']=$productData[0]['samples_available'];
				$productDetails['New Product']=$productData[0]['new'];
				
				$proData ['productDetails'] = $productDetails;
				
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "'");
				
				$where="user_id = '".$value['uid']."'";
                $business_details= $this->Site_model->getDataById( $table = "bt_business", $where );
				foreach($business_details as $biz){
				$companyDetails['company_name']=$biz['company_name'];
				$companyDetails['services']=$biz['services'];
				$companyDetails['image_name']=$biz['address1'];
				$companyDetails['minisite']='https://'.strtolower($biz["minisite_prefix"]).'.blazebay.com';
				$proData['companyDetails']= $companyDetails;
				}
				
				$productinfo [] = $proData;
				}
				$data=array(
				'data'=>$productinfo,
				'statusCode'=>200
				   );
				$this->set_response($data,200);
				   }
               
   }
   
   public function product_type_get(){
				$limit=15;
				$producttype = $this->get('product_type');
				$currency = $this->get('currency');
				if($producttype==''){
					 $resArr['message']='Please enter Product type';
			         $resArr['statusCode'] = 301;
					 $this->set_response($resArr,301);
				    $this->set_response($resArr,301);
				}else{
				$productData= $this->Site_model->getallProductType($limit,$producttype);
		        $proData['statusCode'] = 200;
			   
			   	//buy offers
				$bqry  = " SELECT buy.id  FROM bt_offers_buy as buy JOIN  bt_members as m ON m.user_id=buy.uid 
				WHERE buy.approved='yes' AND buy.expireson > NOW()";
				$buyData= $this->Site_model->execute($bqry);
				//sell offers
				$sqry  = "SELECT p.id
				FROM  bt_products as p  JOIN  bt_offers as o ON p.id=o.prod_id  WHERE p.wholesale='0' AND o.approved='yes' AND o.expireson > NOW() ";
				$sellData= $this->Site_model->execute($sqry);
				
                //hotselling data
 
                $sql='SELECT p.id FROM  bt_products as p  RIGHT JOIN   bt_members as m ON m.user_id = p.uid WHERE m.suspended="N" AND p.approved ="yes" AND p.wholesale="0"  AND p.image !=""
				ORDER BY p.id  DESC LIMIT 12';
				
				$hotSellingData= $this->Site_model->execute($sql);
				
				
				foreach($productData as $value){
                $proData ['productname'] = $value['title'];
				
				if($currency){
				$proData ['currency'] = $value['price'];
				$proData ['price'] = $value['price'];	
				$proData ['prevcurrency'] = $value['price'];
				$proData ['previousprice'] = $value['price'];	
				}else{
				$proData ['currency'] = $value['price'];	
				$proData ['price'] = $value['price'];
				}
                
				
				
                $proData ['discountPrice'] = 0;
                $proData ['description'] =$value['description'];
                $proData ['product_id'] = $value['id'];
				
				
			    $salepro_rate_info = $this->Site_model->getRowData('bt_ratings',"ratedto='".$value['id']."' AND type_rate='P'");
                $proData ['ratings'] =$salepro_rate_info[0]['rating'];
                $proData ['quantity_range'] ='';
                $proData ['qty'] =$value['qty_unit'];
                $proData ['min_qty'] = $value['min_order'];
                $proData ['product_category'] = '';
				if (in_array($value['id'], $buyData))
				  {
				 $proData ['product_type'] ="BuyOffer";
				  }
				else if (in_array($value['id'], $sellData))
				  {
				 $proData ['product_type'] ="SellOffer";
				  }
				  else if(in_array($value['id'], $hotSellingData)){
					 $proData ['product_type'] ="HotSelling";  
				  }
				else{
				
				$productType=array(
				1=>'Wholesale',
				0=>'Featured'
				);
				$proData ['product_type'] = $productType[$value['wholesale']];  
					if($producttype=='Hotselling'){
						$proData ['product_type'] ='Hotselling';
					}
				  }
			
				$proData ['whole_sale_product'] = $value['wholesale'];
				
				$sql="SELECT img_url FROM bt_product_images WHERE offer_id='".$value['id']. "' ORDER BY id DESC";
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "' ");
				
			
				if(!empty($productImages)){
				$proimage=array();	
				foreach($productImages as $img){
					 if(file_exists('assets/multimage/'.$img['img_url'])){
					$productImageData['image_name']=base_url().'assets/multimage/'.$img['img_url'];
					 }else{
					$productImageData['image_name']=base_url().'assets/uploadedimages/'.$img['img_url'];	 
					 }
					$proimage[]=$productImageData;
				}
				}
				$proData ['productImages'] =array_unique($proimage);
				
				$productDetails['color']=$productData[0]['color'];
				$productDetails['Location']=$productData[0]['location'];
				$productDetails['Samples Available']=$productData[0]['samples_available'];
				$productDetails['New Product']=$productData[0]['new'];
				
				$proData ['productDetails'] = $productDetails;
				
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "'");
				
				$where="user_id = '".$value['uid']."'";
                $business_details= $this->Site_model->getDataById( $table = "bt_business", $where );
				foreach($business_details as $biz){
				$companyDetails['company_name']=$biz['company_name'];
				$companyDetails['services']=$biz['services'];
				$companyDetails['image_name']=$biz['address1'];
				$companyDetails['minisite']='https://'.strtolower($biz["minisite_prefix"]).'.blazebay.com';
				$proData['companyDetails']= $companyDetails;
				}
				
				$productinfo [] = $proData;
				}
				$data=array(
				'data'=>$productinfo,
				'statusCode'=>200
				   );
				$this->set_response($data,200);
				   }
               
	}
   
   public function buyRequirements_post(){
	   	    //$name   = $this->post('name');
			//$email      = $this->post('email');
			$productName = $this->post('productName');
			//$phoneNumber  = $this->post('phoneNumber');
			$subject   = $this->post('subject');
			$requirements_desc    = $this->post('requirements_desc');
			$user_id    = $this->post('user_id');
			
			
			/*if($name==""){
			$resArr['message']='Please enter your name';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
			else if($email==""){
			$resArr['message']='Please enter your email';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
			else if($phoneNumber==""){
			$resArr['message']='Please enter your phone Number';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}*/
		    if($user_id==""){
			$resArr['message']='Please submit user_id';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
			 else if($subject==""){
			$resArr['message']='Please enter the  subject';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
			else if($requirements_desc==""){
			$resArr['message']='Please enter the  requirement Description';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
			else if($productName==""){ 
			$resArr['message']='Please enter the product';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
		 else{
			 
			 $where = "user_id = '" . $user_id ."'";
		     $userdata= $this->Site_model->getDataById( 'bt_members', $where );
		
			$firstName= $userdata [0] ['firstname'];
			$lastName = $userdata [0] ['lastname'];
			$email =$userdata [0] ['email'];
			$phoneNumber = $userdata [0] ['phone'];
			$requireArray=array(
			'full_name'=>$firstName." ".$lastName,
			'email'=>$email,
			'subject'=>$subject,
			'phone'=>$phoneNumber,
			'message'=>$requirements_desc,
			'enquired_product'=>$productName,
			'user_id'=>$user_id,
			'enquired_all_suppliers '=>'Y'
			);
			$res=$this->Site_model->add('bt_enquiry',$requireArray);
			if($res){
			  $resArr['message']='Success';
			  $resArr['statusCode'] = 201;
              $this->set_response ( $resArr, 201);	
			 
			}else{
			  $resArr['message']='An error occured while submiting your requirements';
			  $resArr['statusCode'] = 301;
              $this->set_response( $resArr, 301);	
			}
		}
   }
  
   public function forgotPassword_post(){
	   
			/*$email=$this->post('email');
			if($email==""){
			$resArr['message']='Please submit your email';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}else{
			$where = "email = '".$email."'";
		    $checkEmail= $this->Site_model->getDataById( 'bt_members', $where );
		   if(empty($checkEmail)){

			$resArr['message']='Your details not found.Please create an account on blazebay.com';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);  
		   } else{
			$from ='no-reply@blazebay.com';
			$to = $email;
			$subject = "Reset Password";
			$datesent=date('Y-m-d:h:i:s');
			mailer($from, $to,$subject,md5($datesent.$email)); 
				
			$data2 =array(
			'token'=>md5($datesent.$email),
			'date'=>date('Y-m-d'),
			'email'=>$email
			);
			$results=$this->Site_model->add('bt_forgotPwd',$data2);  
			if($results){
			  $resArr['message']='Success.Please check your email to reset your password';
			  $resArr['statusCode'] = 201;
              $this->set_response ( $resArr, 201);	
			 
			}else{
			  $resArr['message']='An error occured while reseting your password';
			  $resArr['statusCode'] = 301;
              $this->set_response( $resArr, 301);	
			}
		 
			}
			}*/
			$phone_number =$this->post('phone_number');
			if($phone_number=="") {
				$resArr['message']='Please pass phone a number';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
			$addedphone=substr($phone_number,1);
			$check_phone =$this->Site_model->getDataById('bt_members',"phone='$phone_number' OR phone='$addedphone' OR mobile='$phone_number' OR mobile='$addedphone'");
			if(empty($check_phone)){
				$resArr['message']='Failed.User does not exist';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}else{
			$data=$this->random_sms(6);
			$insertData = array (       
				'smsfrom' =>'+254-741-403-640',
				'smsto' => $phone_number,
				'description' =>'Your verification code is'.' '.$data,
				'status' =>0,
				'user_id'=>$check_phone[0]['user_id']
			);
			$result = $this->Site_model->add( 'bt_sms', $insertData);
			$this->sendsms();
			
		   $resArr['statusCode'] =200;
		   $data=array ( 
				'smscode' =>$data,
				'user_id'=>$check_phone[0]['user_id']
		   );
		   $resArr['data'] =$data;
		   $this->set_response($resArr, 200);
			}
			}   
   }
   
   public  function get_web_page_by_curl( $url )
    {
        $user_agent ='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        	//set request type post or get
            CURLOPT_HTTPGET           =>false,        	//set to GET
            CURLOPT_USERAGENT      => $user_agent, 	//set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", 	//set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", 	//set cookie jar
            CURLOPT_RETURNTRANSFER => true,     	// return web page
            CURLOPT_HEADER         => false,    	// don't return headers
            CURLOPT_FOLLOWLOCATION => true,     	// follow redirects
            CURLOPT_ENCODING       => "",       	// handle all encodings
            CURLOPT_AUTOREFERER    => true,     	// set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      	// timeout on connect
            CURLOPT_TIMEOUT        => 120,      	// timeout on response
            CURLOPT_MAXREDIRS      => 10,       	// stop after 10 redirects
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
  
}

   public function getSupplier_get(){
	        $my_location_ip = $_SERVER['REMOTE_ADDR'];
		    $content_url = "http://ipinfo.io/".$my_location_ip."/json";
			// $content_url ="http://ipinfo.io/197.232.58.126/json";
			
			$getContents = $this->get_web_page_by_curl($content_url);
			
			$getContents_jsonData     = $getContents['content'];
			$getContents_jsonDecoded  = json_decode($getContents_jsonData);
			$my_location_details = $getContents_jsonDecoded;
			$my_location_country = $my_location_details->country;
			$location_data = array(
				'ip'      => $my_location_details->ip,
				'city'    => $my_location_details->city,
				'region'  => $my_location_details->region,
				'country' => $my_location_country,
				'loc'     => $my_location_details->loc,
				'org'     => $my_location_details->org,
			);
         $_SESSION['TEMP_USER_DATA'] = $location_data;
		
		  if(!empty($_SESSION['TEMP_USER_DATA']['country'])){
        $my_location_country = $_SESSION['TEMP_USER_DATA']['country'];
		
        //get Country id
        $where="ISO2='$my_location_country'";
        $getCountryDetails= $this->Site_model->getDataById( $table = "bt_countries", $where );

        if(!empty($getCountryDetails)){
            $my_location_country_id = $getCountryDetails[0]['country_id'];
            $_SESSION['TEMP_USER_DATA']['my_country_id']   = $my_location_country_id;
            $_SESSION['TEMP_USER_DATA']['my_country_name'] = $getCountryDetails[0]['country_name'];
        }
    }

	if(!empty($_SESSION['TEMP_USER_DATA']['my_country_id'])){
		$country_id = $_SESSION['TEMP_USER_DATA']['my_country_id'];
		$getSuppliers_byCountry= $this->Site_model->getSuppliers_byCountry( $country_id);

	}

		          if(!empty($getSuppliers_byCountry)){
					  foreach ($getSuppliers_byCountry as $key => $eachSupplier) {
						$member_id    = $eachSupplier['member_id'];
						$business_id  = $eachSupplier['business_id'];
						$companyLogo_folder = "assets/uploadedimages/";
						$business_logo_vpath = base_url()."assets/images/nopic.jpg";
						if(!empty($eachSupplier['company_logo'])){
							if(file_exists('assets/uploadedimages'.$eachSupplier['company_logo'])){
								$business_logo_vpath = base_url()."assets/uploadedimages/".$eachSupplier['company_logo'];
							}
						}
						
						$where="ISO2='$country_id'";
                        $getCountryDetails= $this->Site_model->getDataById( $table = "bt_countries", $where );
						
								  $supplierData['country'] = $_SESSION['TEMP_USER_DATA']['my_country_name'];
								  $supplierData['image_url'] = $business_logo_vpath;
								  $supplierData['supplier_id'] =$business_id;
								  $supplierInfo[] = $supplierData; 
					  }
              
			  
                      $code=200;
					 $suppliers=array(
						'brands'=>$supplierInfo,
						 'statusCode'=>$code
						);
						}
						else{
						$code=301;
						$suppliers=array(
						'brands'=>$supplierInfo,
						 'statusCode'=>$code
						);	
						}
		 $this->set_response($suppliers,200);
		
		
	    
					
			
   }
   
   public function getliveBrands_get(){
	                $business_logo_vpath ="";
                    $sbq_con = "select * from  bt_members where user_id IN (1506,1507,1508,1509,1510,1511)";
                    $premium_supplierBrands = $this->Site_model->getcountRecods($sbq_con);
					//print_r($premium_supplierBrands);
                    foreach ($premium_supplierBrands as $key => $value) {
                            if (file_exists("assets/uploadedimages/".$business_logo)) {
                                $business_logo_vpath 	= base_url().'assets/uploadedimages/'.$value['user_img'];
                            }
					  $suppliers_products_link=base_url().'premium-brand-products/'.$value['user_id'];
					  
				      $premiumData['company_name'] = $premiumBrands['company_name'];
				      $premiumData['link'] =$suppliers_products_link;
					  $premiumData['image_url'] = $business_logo_vpath;
					  $premiumData['id'] = $value['user_id'];
                      $prem[] = $premiumData; 

                    }
					$premiumBrands=array(
						'brands'=>$prem,
						 'statusCode'=>200
						);
					 $this->set_response($premiumBrands,200);
	   
   }
   
    public function contactSupplier_post(){
			$product_id = $this->post('product_id');
			$message = $this->post('message');
			$senderId =$this->post('user_id');

			 if($senderId==""){
			$resArr['message']='Please pass user_id first to contact the supplier';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
			else if($product_id==""){
			$resArr['message']='Please select the product_id first';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
			
			else if($message==""){
			$resArr['message']='Please enter your message';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
			
			else{
			$sql="SELECT uid,title,image FROM bt_products WHERE id='".$product_id. "'";
			$productData= $this->Site_model->execute($sql);
			$supplier_id=$productData[0]['uid'];
			
			 if($supplier_id==''){
			$resArr['message']='An Error occured,product dont have a supplier';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	 
			 }else{
			$sqlbiz="SELECT company_name FROM bt_business WHERE user_id='".$supplier_id. "'";
			$bizData= $this->Site_model->execute($sqlbiz);
			
			$sqlu="SELECT CONCAT(firstname,' ',lastname)suppliername,email FROM bt_members WHERE user_id='".$supplier_id. "'";
			$userData= $this->Site_model->execute($sqlu);

			$suppliername=$userData[0]['suppliername'];
			$supplier_email =$userData[0]['email'];
			$product_name =$productData[0]['title'];
			$product_image = $productData[0]['image'];
			$subject = 'Customer Product Inquiry:'.' '.$product_name;
			
			$sqlu="SELECT email,firstname,lastname FROM bt_members WHERE user_id='".$senderId. "'";
			$loginuserData= $this->Site_model->execute($sqlu);
			$from = $loginuserData[0]['email'];
			$senderName=$loginuserData[0]['firstname'].' '.$loginuserData[0]['lastname'];
			$company_name =$bizData[0]['company_name'];
	
		  $content=$message.','.$suppliername.','.$company_name.','.$product_name.','.$product_image.','.$senderName.','.$from;
		
		
       // contactsuplierMail($from, $supplier_email,$subject,$content,$supplier_email,'info@blazebay.com'); 
			
		 $enquiryDetails= array(
			'user_id' =>$senderId,

			'sender' =>$from,

			'receiver' =>$supplier_email ,

			'subject' =>$subject,

			'message' =>$this->contactsuplierMail($content),

			'status' =>0
			);
			
		//	print_r($this->contactsuplierMail($content,$senderName));exit;
		 $this->Site_model->add("bt_emails", $enquiryDetails);
	 
	 
		$enqdata=array(
		'enquired_product'=>$product_name,
		'prod_id'=>$product_id,
		'full_name'=>$senderName,
		'email'=>$from,
		'subject'=>$subject,
		'message'=>$message,
		'receiver_id'=>$supplier_id,
		'user_id'=>$senderId,
		'user_ip'=>$_SERVER['REMOTE_ADDR'],
		'msg_read'=>$from.' '.$supplier_email
		);
		
		$inserted =$this->Site_model->add('bt_enquiry', $enqdata);
		if($inserted){
	    $code=200;
		$data=array(
		'message'=>'success',
		 'statusCode'=>$code
		);	
		
		$this->set_response($data,$code);
		
		}else{
			$resArr['message']='An error Occured while contacting supplier';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
		}
			 }
		}

   }
  function contactsuplierMail($content,$user){
  $details=explode(',',$content);
	$message=$details[0];
	$suppliername=$details[1];
	$company_name=$details[2];
	$product_name=$details[3];
	$product_image=$details[4];
	$username=$user;
	$email=$details[6];
	
    $img = 'https://www.blazebay.com/assets//images/logo/LOGO_9841497874673.png';
$body = '
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        Margin-bottom: 30px; }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        Margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }

      a {
        color: #3498db;
        text-decoration: underline; }

      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }

      .btn-primary table td {
        background-color: #3498db; }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }

      .first {
        margin-top: 0; }

      .align-center {
        text-align: center; }

      .align-right {
        text-align: right; }

      .align-left {
        text-align: left; }

      .clear {
        clear: both; }

      .mt0 {
        margin-top: 0; }

      .mb0 {
        margin-bottom: 0; }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }

      .powered-by a {
        text-decoration: none; }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }

    </style>
  </head>
  <body >
    <center><img height="150" title="Blazebay" alt="Blazebay" src="<img src="https://www.blazebay.com/assets//images/logo/LOGO_9841497874673.png" style="max-height:80px;" /></center>



							Hi <strong>'.$suppliername.'</strong>,

							<br /><br />

							There is an enquiry about product : <br />



							<img src="https://www.blazebay.com/assets/uploadedimages/'.$product_image.'"  width="150"/><br />

							'.$product_name.'



							<br /><br />

							<strong>Here are the inquiry details:</strong><br />

							Name: '.$username .',<br/>

							Email: '.$email.',<br/>

							Message : '.$message.'<br/>
						
  </body>
</html>
';
return $body;
}

   public function getAdverts_get(){
		 $one="https://www.blazebay.com/assets/ads/banner-4.jpg";
		 $one2="https://www.blazebay.com/assets/ads/banner12.jpg";
		 $one3="https://www.blazebay.com/assets/ads/banner-7.jpg";
			 $ads=array(
			 'image_url1'=>$one,
			 'image_url2'=>$one2,
			 'image_url3'=>$one3
			 );
			foreach($ads as $value){
			
       $dataads[]=$value;		
			}
		$adsRecord['image_url']=$dataads;
		$data=array(
		'data'=>$adsRecord,
		'statusCode'=>200
		);
		$this->set_response($data,200);
	 }


	public function createOrder_post(){
	    $user_id=$this->post('user_id');
		$productId=$this->post('product_id');	
		$qty=$this->post('quantity');
		$productprice=$this->post('product_price');
		$productcurrency=$this->post('product_currency');
		$customised=$this->post('customer_requests');
		$shippingPerson=$this->post('courier_id');
		$shippingamount=$this->post('courier_amount');
		$paymode=$this->post('payment_method');
		$transactId=$this->post('transaction_no');
		$firstname=$this->post('shipping_first_name');
        $lastname= $this->post('shipping_last_name');
		$phone_number= $this->post('shipping_phone_number');
        $address=$this->post('shipping_address');
        $city=$this->post('shipping_city');
        $zip=$this->post('zip_code');
        $state=$this->post('shipping_state');
        $country=$this->post('shipping_country');
        $country_id=$this->post('shipping_country');
		$state_id=$this->post('shipping_state');
		$totalproductprice=$qty*$productprice;
		$totalAmount=$totalproductprice + $totalproductprice;
		
		 if($user_id==""){
			$resArr['message']='Please pass user_id';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);
			}
			else if($productId==""){
			$resArr['message']='Please pass the product_id';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($qty==""){
			$resArr['message']='Please pass the quantity';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($productprice==""){
			$resArr['message']='Please pass the product_price';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($customised==""){
			$resArr['message']='Please pass the customer_requests';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($productcurrency==""){
			$resArr['message']='Please pass the product_currency';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($shippingPerson==""){
			$resArr['message']='Please pass the courier_id';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($shippingamount==""){
			$resArr['message']='Please pass the courier_amount';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($paymode==""){
			$resArr['message']='Please pass the payment_method';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($transactId==""){
			$resArr['message']='Please pass the transaction_no';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($firstname==""){
			$resArr['message']='Please pass the shipping_first_name';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}else if($lastname==""){
			$resArr['message']='Please pass the shipping_last_name';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($phone_number==""){
			$resArr['message']='Please pass the shipping_phone_number';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($address==""){
			$resArr['message']='Please pass the shipping_address';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($city==""){
			$resArr['message']='Please pass the shipping_city';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($state==""){
			$resArr['message']='Please pass the shipping_state';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else if($country==""){
			$resArr['message']='Please pass the shipping_country';
			$resArr['statusCode'] = 301;
			$this->set_response ( $resArr, 301);	
			}
			else{
		 $where="user_id='".$user_id."'";
		 $memD= $this->Site_model->getDataById( 'bt_members', $where );
         $mem=$memD[0];
		  
		//create order section
       if (isset($_SERVER['REMOTE_ADDR'])){
		   $ip = $_SERVER['REMOTE_ADDR']; 
	     }else{
		  $ip = "";
			}
        $date_added			= date('Y-m-d H:i:s');
		 $ordr_status		= 0;
         $order_data			= array(
        'order_id'			=> "",
        'invoice_no'		=> "",
        'invoice_prefix'	=> "",
        'customer_id'		=> $user_id,
        'currency'			=> $productcurrency,
        'shipping_firstname' =>$firstname? $firstname:$mem["firstname"],
        'shipping_lastname'  => $lastname? $lastname:$mem["lastname"],
        'shipping_address_1' => $address? $address:$mem['zip'],
        'shipping_address_2' => $zip? $zip:$mem['zip'],
        'shipping_city'      =>$city? $city:$mem["city"],
        'shipping_postcode'  => $address,
        'shipping_state'     =>$state,
        'shipping_state_id'  =>$state,
        'shipping_country'   =>$country?$country:$mem["country"],
        'shipping_country_id'=> $mem["country"],
		'shipping_phone'=>$phone_number,
        'shipping_zone'      => "",
        'shipping_zone_id'   => "",
        'shipping_address_format' => "",
        'shipping_method'    => "",
		'buyer_status'=>'2',
        'comments'           =>$customised,
        'total'              => 0,
        'order_status_id'    => $ordr_status,
        'ip'                 => $ip,
        'date_added'         => $date_added,
        'date_modified'      => "",
		'for_courier_id'    =>$shippingPerson,
        'shipping_charge'   =>$shippingamount
    );

	

	$order_id=$this->Site_model->add('bt_order', $order_data);
		//end of create order section
           
	$order_product_data= $this->Site_model->getRowData('bt_products',"id = '$productId'"); 
    $order_product_info=$order_product_data[0];
	$product_name	= $order_product_info['title'];
	
	//create product order section
	   $order_product_arr = array(
		'order_id'		=> $order_id,
		'product_id'	=> $productId,
		'product_type'	=> $order_product_info['wholesale'],
		'name'			=> $product_name,
		'quantity'		=> $qty,
		'price'			=> $productprice,
		'total'			=> $totalAmount,
		'b2b_profit'    => "",
		'b2b_percentage'=>"",
		'supplier_id' => $order_product_info['uid']
		
	);
	 $product_order_id=$this->Site_model->add('bt_order_product', $order_product_arr);
	
	    $rand			= $this->random_gen('8');
        $order_number	= 'ORD'.$rand .'B'. $order_id;

		$orderUpdate=array(
		'total '=>$totalAmount ,
		'order_number'=>$order_number
		);
		$product_order_update=$this->Site_model->update('bt_order', $orderUpdate,"order_id = '$order_id'");
		
		//end of create product order section
       if ($product_order_update) {
		   
		   // supplier section
		    $order_supplier_data = array(

                    'order_id' => $order_id,

                    'supplier_id' => $order_product_info['uid'],

                    'status' => '1',
					
					'sup_courier_status'=>'1',

                    'assign_date' => date('Y-m-d H:i:s'),

                    'supplier_price' => $productprice

                    );
                $supplier_order_id = $this->Site_model->add("bt_order_supplier", $order_supplier_data);
				
                $supplier_rand =$this->random_gen('8');

                $supplier_order_number = 'S' . $supplier_order_id . 'R' . $supplier_rand;
				$updateorder_supplier_data=array('supplier_order_number' => $supplier_order_number);

               $updateSupplierTable=$this->Site_model->update('bt_order_supplier',$updateorder_supplier_data, "sup_order_id=$supplier_order_id");
              //end supplier section
		
		
		     //Courier area

				$prefix = 'C' . $order_id . 'R';

				$cordrnum =$this->random_num_gen(5);

				$c_order_number = $prefix . $cordrnum;

				$couins_data = array(

					'order_id' => $order_id,

					'courier_id' =>$shippingPerson,

					'courier_order_number' => $c_order_number,

					'assign_date' => date("Y-m-d"),

					'courier_price' =>$shippingamount,
					
					'sup_id'=>$order_product_info['uid'],

					'status' =>1

					);
        $return_corior_data = $this->Site_model->add('bt_order_courier', $couins_data);

        // end of courier area

  

		   
	    //====== for notification :: starts ======

            $created_on = time();

            //notify to admin

            $notifyText = "New Order Recdeived. Order No:$order_number.";

            $notifyUrl = "order_list";

            

            $notify_data = array(

                'notify_type' => "order",

                'notify_user_type' => "admin",

                'notify_text' => $notifyText,

                'notify_url' => $notifyUrl,

                'notify_sender_id' =>$user_id,

                'notify_receiver_id' => '0',

                'created_on' => $created_on,

                );

            $this->Site_model->add("bt_nofication", $notify_data);

            //notify to user
            $notifyText_user = "New Order Placed.Order No:$order_number.";

            $notify_user = array(

                'notify_type' => "order",

                'notify_user_type' => "buyer",

                'notify_text' => $notifyText_user,

                'notify_url' => "buyer-orderlist",

                'notify_sender_id' => '0',

                'notify_receiver_id' =>$user_id,

                'created_on' => $created_on,
                );

           $this->Site_model->add("bt_nofication", $notify_user);

            //====== for notification ::   Ends ====== 
            $msg = "Your Order Placed Successfully. Your Order Number is  <b>$order_number</b>";
			
			
		

	   }
	   
//customer mail
	     $orderDetails= array(

                'user_id' => "",

                'sender' => "info@blazebay.com",

                'receiver' =>$mem['email'],

                'subject' =>'New Order for'.' '.$product_name.'',

                'message' => $this->orderMails($order_number),

                'status' =>0
                );
             $this->Site_model->add("bt_emails", $orderDetails);

//supplier mail		
          $user_id=$order_product_info['uid'];
         $supplier_data= $this->Site_model->getRowData('bt_members',"user_id = '$user_id'"); 	
	     $orderDetails= array(

                'user_id' => "",

                'sender' => "info@blazebay.com",

                'receiver' =>$supplier_data[0]['email'],

                'subject' =>'New Order for'.' '.$product_name.'',

                'message' => $this->orderMailsadmins($order_number),

                'status' =>0
                );
             $this->Site_model->add("bt_emails", $orderDetails);
//blazebay mail
  $orderDetails= array(

                'user_id' => "",

                'sender' => "info@blazebay.com",

                'receiver' =>'info@blazebay.com' ,

                'subject' =>'New Order for'.' '.$product_name.'',

                'message' => $this->orderMailsadmins($order_number),

                'status' =>0
                );
             $this->Site_model->add("bt_emails", $orderDetails);

//courier mail


         $courier_data= $this->Site_model->getRowData('bt_members',"user_id = '$shippingPerson'");
  $orderDetails= array(

                'user_id' => "",

                'sender' => "info@blazebay.com",

                'receiver' => $courier_data[0]['email'],

                'subject' =>'New Order shipment for'.' '.$product_name.'',

                'message' => $this->courierOrderMail($order_number),

                'status' =>0
                );
             $this->Site_model->add("bt_emails", $orderDetails);
 
	}
		$msg =$order_number;

	    $code=200;
		$suppliers=array(
		'msg'=>$msg,
		 'statusCode'=>$code
		);			
		 $this->set_response($suppliers,200);
	
	}
	function orderMails($orderNo){
		
		$where="order_number = '".$orderNo."'";
	    $orderData=$this->Site_model->getDataById( $table = "bt_order", $where);
		
		$whereord="order_id= '".$orderData[0]['order_id']."'";
	    $orderProductData=$this->Site_model->getDataById( $table = "bt_order_product", $whereord);
		$user=$orderData[0]['shipping_firstname'];
		$product=$orderProductData[0]['name'];
		$qty=$orderProductData[0]['quantity'];
		$price=$orderProductData[0]['price'];
		$total=$orderData[0]['total'];
		$shippingtotal=$orderData[0]['shipping_charge'];
		$unitprice=$price;
		$vat=$total *16/100;
		$grandtotal=$total + $shippingtotal+$vat;
		
		$body='
		<h2>ORDER EMAIL</h2>
		<table border="0" cellpadding="0" cellspacing="0" height="100%" width="600" id="bodyTable" class="table_border">

    <tr>

        <td align="left" valign="top">

            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailContainer" >

     
                <tr>

                    <td align="left" valign="top">

                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">

                            <tr>

                                <td align="left" valign="top">

                               	Hello <strong>'.$user.' ,</strong>,<br /><br />

 Thank you for placing an order with us.Your order Number is <strong>'.$orderNo.'</strong><br />
 If you have any issue please contact us on our official email <b>support@blazebay.com</b> or call us on <b>254-741-403-640</b>
								<br />

                                </td>

                            </tr>

                        </table>

                    </td>

                </tr>



				<tr>

                    <td align="left" valign="top">
					 <tr><a href="https://www.blazebay.com/buyer-track-order/'.$orderNo.'" ><b>Track order</b></a></tr>
                                    

                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">

                            <tr>

                                <td align="left" valign="top">

                               	<strong>Item Details</strong><br />

								


								<tr>
                                       <strong>
									<td class="td_border">Item</td>

									<td class="td_border center">Qty</td>

									<td class="td_border center">Unit Price</td>
									<td class="td_border right">Sub Total</td>
                                     </strong>
								</tr>

								<tr>
                                      
									<td class="td_border">'.$product.'</td>

									<td class="td_border center">'.$qty.'</td>

									<td class="td_border center">KSH '.$unitprice.'</td>

									<td class="td_border center">KSH '. $total.'</td>

								</tr>



								</table>

                                </td>

                            </tr>

                        </table>

					

                    </td>

                </tr>



				<tr>

                    <td align="left" valign="top">

					    <strong>Amount</strong>

					

                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">

                            <tr>

                                <td align="left" valign="top">                               	

								<table border="0" cellpadding="2" cellspacing="0" width="100%" id="emailBody" class="table_border">

								<tr>									

									<td class="td_border right"><strong>Shipping Total</strong> </td>

									<td class="td_border left">KSH '.$shippingtotal.'</td>

								</tr>

								<tr>									

									<td class="td_border right"><strong>Grand Total(VAT inclusive)</strong>  </td>

									<td class="td_border left">KSH '.$total.'</td>

								</tr>
							
								

								</table>

                                </td>

                            </tr>

                        </table>

						

						

                    </td>

                </tr>



            
            </table>

        </td>

    </tr>

</table>
';
return $body;
	}

	function orderMailsadmins($orderNo){
		
		$where="order_number = '".$orderNo."'";
	    $orderData=$this->Site_model->getDataById( $table = "bt_order", $where);
		
		$whereord="order_id = '".$orderData[0]['order_id']."'";
	    $orderProductData=$this->Site_model->getDataById( $table = "bt_order_product", $whereord);
		$user=$orderData[0]['shipping_firstname'];
		$product=$orderProductData[0]['name'];
		$qty=$orderProductData[0]['quantity'];
		$price=$orderProductData[0]['price'];
		$total=$orderData[0]['total'];
		$shippingtotal=$orderData[0]['shipping_charge'];
		$unitprice=$total/$qty;
		$vat=$total *(16/100);
		$grandtotal=$total + $shippingtotal +$vat;
		$adminship=$shippingtotal *0.5;
		$admintot=$total *0.5;
		$admintotamount=$adminship+ $admintot;
		
		
		
		$body='<h2>ORDER EMAIL</h2>
		<table border="0" cellpadding="0" cellspacing="0" height="100%" width="600" id="bodyTable" class="table_border">

    <tr>

        <td align="left" valign="top">

            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailContainer" >

     
                <tr>

                    <td align="left" valign="top">

                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">

                            <tr>

                                <td align="left" valign="top">

                               	Hello <strong> Blazebay Admin</strong>,<br /><br />



								You have new Order placed.<br />Order Number is <strong>'.$orderNo.'</strong><br />

								Please process it<br />

                                </td>

                            </tr>

                        </table>

                    </td>

                </tr>



				<tr>

                    <td align="left" valign="top">
					 <tr><a href="https://www.blazebay.com/buyer-track-order/'.$orderNo.'" ><b>Track order</b></a></tr>
                                    

                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">

                            <tr>

                                <td align="left" valign="top">

                               	<strong>Item Details</strong><br />

								


								<tr>
                                       <strong>
									<td class="td_border">Item</td>

									<td class="td_border center">Qty</td>

									<td class="td_border center">Unit Price</td>
									<td class="td_border right">Sub Total</td>
                                     </strong>
								</tr>

								<tr>
                                      
									<td class="td_border">'.$product.'</td>

									<td class="td_border center">'.$qty.'</td>

									<td class="td_border center">KSH '.$unitprice.'</td>

									<td class="td_border center">KSH '. $total.'</td>

								</tr>



								</table>

                                </td>

                            </tr>

                        </table>

					

                    </td>

                </tr>



				<tr>

                    <td align="left" valign="top">

					    <strong>Amount</strong>

					

                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">

                            <tr>

                                <td align="left" valign="top">                               	

								<table border="0" cellpadding="2" cellspacing="0" width="100%" id="emailBody" class="table_border">

								<tr>									

									<td class="td_border right"><strong>Shipping Total</strong> </td>

									<td class="td_border left">KSH '.$shippingtotal.'</td>

								</tr>

								<tr>									

									<td class="td_border right"><strong>Grand Total(VAT inclusive)</strong>  </td>

									<td class="td_border left">KSH '.$total.'</td>

								</tr>
								
								
								
								

								</table>

                                </td>

                            </tr>

                        </table>

						

						

                    </td>

                </tr>



            
            </table>

        </td>

    </tr>

</table>
';
return $body;
	}

		function courierOrderMail($orderNo){
		
		$where="order_number = '".$orderNo."'";
	    $orderData=$this->Site_model->getDataById( $table = "bt_order", $where);
		
		$whereord="order_id= '".$orderData[0]['order_id']."'";
	    $orderProductData=$this->Site_model->getDataById( $table = "bt_order_product", $whereord);
		
		$curierwhereord="order_id= '".$orderData[0]['order_id']."'";
	    $curierorderProductData=$this->Site_model->getDataById( $table = "bt_order_courier", $curierwhereord);
		
		$user=$orderData[0]['shipping_firstname'];
		$product=$orderProductData[0]['name'];
		$qty=$orderProductData[0]['quantity'];
		$price=$orderProductData[0]['price'];
		$total=$orderData[0]['total'];
		$shippingtotal=$orderData[0]['shipping_charge'];
		
		$productSupplier=$curierorderProductData[0]['sup_id'];
		$courier_id=$curierorderProductData[0]['courier_id'];
		
		$whereord="user_id= '".$courier_id."'";
	    $courierData=$this->Site_model->getDataById( $table = "bt_business", $whereord);
		
		$body='
		<h2>ORDER EMAIL</h2>
		<table border="0" cellpadding="0" cellspacing="0" height="100%" width="600" id="bodyTable" class="table_border">

    <tr>

        <td align="left" valign="top">

            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailContainer" >

     
                <tr>

                    <td align="left" valign="top">

                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">

                            <tr>

                                <td align="left" valign="top">

                               	Hello <strong>'.$courierData[0]['company_name'].'</strong>,<br /><br />



								You have new Order shipment placed.<br />Order Number is <strong>'.$orderNo.'</strong><br />

								Please process its delivery<br />

                                </td>
								<td align="left" valign="top">
								
								</td>

                            </tr>

                        </table>

                    </td>

                </tr>



				<tr>

                    <td align="left" valign="top">
					 <tr><a href="https://www.blazebay.com/buyer-track-order/'.$orderNo.'" ><b>Track order</b></a></tr>
                                    

                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">

                            <tr>

                                <td align="left" valign="top">

                               	<strong>Item Details</strong><br />

								


								<tr>
                                       <strong>
									<td class="td_border">Item</td>

									<td class="td_border center">Qty</td>

									<td class="td_border center">Unit Price</td>
									<td class="td_border right">Sub Total</td>
                                     </strong>
								</tr>

								<tr>
                                      
									<td class="td_border">'.$product.'</td>

									<td class="td_border center">'.$qty.'</td>

									<td class="td_border center">KSH '.$unitprice.'</td>

									<td class="td_border center">KSH '. $total.'</td>

								</tr>



								</table>

                                </td>

                            </tr>

                        </table>

					

                    </td>

                </tr>



				<tr>

                    <td align="left" valign="top">

					    <strong>Amount</strong>

					

                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">

                            <tr>

                                <td align="left" valign="top">                               	

								<table border="0" cellpadding="2" cellspacing="0" width="100%" id="emailBody" class="table_border">

								<tr>									

									<td class="td_border right"><strong>Shipping Total</strong> </td>

									<td class="td_border left">KSH '.$shippingtotal.'</td>

								</tr>

								<tr>									

									<td class="td_border right"><strong>Total amount</strong>  </td>

									<td class="td_border left">KSH '.$total.'</td>

								</tr>
								

								</table>

                                </td>

                            </tr>

                        </table>

						

						

                    </td>

                </tr>



            
            </table>

        </td>

    </tr>

</table>
';
return $body;
	}

	  public function random_gen($length){

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
  		
	public function random_num_gen($length=6)

	{

	  	$random= "";

	  	srand((double)microtime()*1000000);


	 	$timenow = time();

	 	$laststring = substr($timenow,-3);



	 	$char_list = strrev($timenow);

	  	$char_list .= "1234567890";

	  	



	  	for($i = 0; $i < $length; $i++) {    

	 	$random .= substr($char_list,(rand()%(strlen($char_list))), 1);  

	  	} 

	  	//$random .= $laststring;

	  	return $random;

	}

	function getSuppliers_get(){
	$country_id = $this->get('country_id'); 
	if($country_id==""){
	   $resArr['message']="Please submit country Id";
	   $resArr['statusCode'] = 301;
	   $this->set_response ( $resArr, 301);	
	}else{
		
	$qry = "
	SELECT * 
	FROM bt_business b
  JOIN bt_members m ON m.user_id=b.user_id 
	WHERE 
  m.suspended='N' AND m.usertype=2 AND b.status = 'Y'  AND m.country=$country_id AND b.`company_name` <>'' ";
	$supplierbyCountryData=$this->Site_model->execute($qry);
		
		if(empty($supplierbyCountryData)){
					
				   $resArr['message']="No records found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{ 
		$supplierData=array();
		foreach($supplierbyCountryData as $value){
			
			if($value["company_logo"]=='assets/uploadedimages/' || $value["company_logo"]==''){
			$proData ['image_url']     = base_url().'assets/images/logo/LOGO_9841497874673.png';
		}
		else{
			if(file_exists('assets/uploadedimages/'.$value["company_logo"])){
				$proData ['image_url']     = base_url().'assets/uploadedimages/'.$value["company_logo"];
			}else{
				$proData ['image_url']     = base_url().'assets/images/logo/LOGO_9841497874673.png';
			}
		    }
                $proData ['supplier_id'] = $value['id'];
                $proData ['supplier_name'] =$value['company_name'];
                $supplierData[] = $proData;
		}
		   $resArr['message']="Success";
		   $resArr['statusCode'] = 200;
		   $resArr['suppliers'] =$supplierData;
		   $this->set_response($resArr, 200);	
		}
		}
	}

	function getAllSuppliersBycountry_get(){
		$qry =	  
	  "SELECT * FROM bt_business b JOIN bt_members m ON m.user_id=b.user_id WHERE m.suspended='N' AND m.usertype=2 AND b.status = 'Y' AND b.`company_name` <>'' AND 
	  b.country NOT IN('India','Kenya') AND b.country<>'' ORDER BY m.country DESC";
	    $supplierbyCountryData=$this->Site_model->execute($qry);
		
		 if(empty($supplierbyCountryData)){
				   $resArr['message']="No records found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{ 
		$supplierData=array();
		foreach($supplierbyCountryData as $value){
			
			if($value["company_logo"]=='assets/uploadedimages/' || $value["company_logo"]==''){
			$proData ['image_url']     = base_url().'assets/images/logo/LOGO_9841497874673.png';
		}
		else{
			if(file_exists('assets/uploadedimages/'.$value["company_logo"])){
				$proData ['image_url']     = base_url().'assets/uploadedimages/'.$value["company_logo"];
			}else{
				$proData ['image_url']     = base_url().'assets/images/logo/LOGO_9841497874673.png';
			}
		    }
			
			$where="country_id='".$value['country']."'";
			$countryData=$this->Site_model->getDataById( $table = "bt_countries", $where );
			$countryName=$countryData[0]['country_name'];
			    $proData ['country'] =$countryName;
				$proData ['country_id'] = $countryData[0]['country_id'];
                $proData ['supplier_name'] =$value['company_name'];
                $proData ['supplier_name'] =$value['company_name'];
                $supplierData[] = $proData;
		}
		   $resArr['message']="Success";
		   $resArr['statusCode'] = 200;
		   $resArr['suppliers'] =$supplierData;
		   $this->set_response($resArr, 200);	
	}
		}
		
 public function getMainCategories_get(){
	         $categories = $this->Site_model->getDataById("bt_categories", " pid='0' and status ='Y' ORDER BY cat_name ASC"); 
			 
			 if(empty($categories)){
					
				   $resArr['message']="No records found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{ 
			 $categoriesData=array();
				  foreach($categories as $value){
					    $catData ['category_name'] =$value['cat_name'];
						$catData ['category_id'] = $value['id'];
						$groupId= $value['group_id'];
				        $groups =$this->Site_model->getDataById("bt_categorie_group","group_status='1' AND group_id ='$groupId'");
						$catData ['category_icon_url'] =base_url().'assets/upload_image/category/cat_icon/'.$groups[0]['group_image'];
						
						$categoriesData[]=$catData;
				  }
				   $resArr['statusCode'] = 200;
				   $resArr['maincategories'] =$categoriesData;
				   $this->set_response($resArr, 200);
 }	    
		  }
		 
public function getSubCategories_get(){
		$parent_id = $this->get('parent_id'); 
		if($parent_id==""){
		   $resArr['message']="Please submit parent Id";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}else{
			 $parent_id=
	         $categories = $this->Site_model->getDataById("bt_categories", "pid=$parent_id and status ='Y' ORDER BY cat_name ASC"); 
			
         if(empty($categories)){
					
				   $resArr['message']="No records found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{			
			 $categoriesData=array();
				  foreach($categories as $value){
					  
					  
					$join_sel =" SELECT p.id,p.approved,pc.cid FROM bt_products as p 

					  JOIN bt_product_cats as pc  ON p.id = pc.offer_id

					  JOIN bt_categories as c ON c.id = pc.cid

					  JOIN bt_members m ON m.user_id = p.uid
					  WHERE pc.cid = ". $value['id']." AND p.approved = 'yes'  AND m.suspended='N' GROUP BY p.id";
					
					if(!empty($this->Site_model->getcountRecods($join_sel))){
						
					$catData ['category_name'] =$value['cat_name'];
					$catData ['category_id'] = $value['id'];
					$groupId= $value['group_id'];
					$groups =$this->Site_model->getDataById("bt_categorie_group","group_status='1' AND group_id ='$groupId'");
					$catData ['category_icon_url'] =base_url().'assets/upload_image/category/cat_icon/'.$groups[0]['group_image'];
					
				   $categoriesData[]=$catData;
				   $resArr['statusCode'] = 200;
				   $resArr['subcategories'] =$categoriesData;
				   $this->set_response($resArr, 200);
					} else {
				    $resArr['statusCode'] = 301;
				   $resArr['subcategories'] ='0';
				   $this->set_response($resArr, 301);
						}
					   
				  }
				   $resArr['statusCode'] = 200;
				   $resArr['subcategories'] =$categoriesData;
				   $this->set_response($resArr, 200);
		}
              		    
		  }
		 
		  }
			 
			 
	public function getProductsPerCategories_get(){
		
		$categoryId = $this->get('categoryId'); 
		if($categoryId==""){
		   $resArr['message']="Please submit category Id";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}else{
				
                $sql="SELECT p.* FROM bt_products as p 

                                      JOIN bt_product_cats as pc  ON p.id = pc.offer_id

                                      JOIN bt_categories as c ON c.id = pc.cid

                                      JOIN bt_members m ON m.user_id = p.uid
									  WHERE pc.cid =$categoryId AND p.approved = 'yes'  AND m.suspended='N' GROUP BY p.id";
				
				$productData= $this->Site_model->execute($sql);
				
				if(empty($productData)){
					
				   $resArr['message']="No records found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{
				foreach($productData as $value){
                $proData ['productname'] = $value['title'];
                $proData ['price'] = $value['price'];
                $proData ['discountPrice'] = 0;
                $proData ['description'] =$value['description'];
                $proData ['product_id'] = $value['id'];
				
				
			    $salepro_rate_info = $this->Site_model->getRowData('bt_ratings',"ratedto='".$value['id']."' AND type_rate='P'");
                $proData ['ratings'] =$salepro_rate_info[0]['rating'];
                $proData ['quantity_range'] ='';
                $proData ['qty'] =$value['qty_unit'];
                $proData ['min_qty'] = $value['min_order'];
                $proData ['product_category'] = '';
				if (in_array($value['id'], $buyData))
				  {
				 $proData ['product_type'] ="BuyOffer";
				  }
				else if (in_array($value['id'], $sellData))
				  {
				 $proData ['product_type'] ="SellOffer";
				  }
				  else if(in_array($value['id'], $hotSellingData)){
					 $proData ['product_type'] ="HotSelling";  
				  }
				else{
				$productType=array(
				1=>'Wholesale',
				0=>'Featured'
				);
				$proData ['product_type'] = $productType[$value['wholesale']];  
				  }
			
				$proData ['whole_sale_product'] = $value['wholesale'];
				
				$sql="SELECT img_url FROM bt_product_images WHERE offer_id='".$value['id']. "' ORDER BY id DESC";
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "' ");
				
			
				if(!empty($productImages)){
				$proimage=array();	
				foreach($productImages as $img){
					 if(file_exists('assets/multimage/'.$img['img_url'])){
					$productImageData['image_name']=base_url().'assets/multimage/'.$img['img_url'];
					 }else{
					$productImageData['image_name']=base_url().'assets/uploadedimages/'.$img['img_url'];	 
					 }
					$proimage[]=$productImageData;
				}
				}
				$proData ['productImages'] =array_unique($proimage);
				
				$productDetails['color']=$productData[0]['color'];
				$productDetails['Location']=$productData[0]['location'];
				$productDetails['Samples Available']=$productData[0]['samples_available'];
				$productDetails['New Product']=$productData[0]['new'];
				
				$proData ['productDetails'] = $productDetails;
				
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "'");
				
				$where="user_id = '".$value['uid']."'";
                $business_details= $this->Site_model->getDataById( $table = "bt_business", $where );
				foreach($business_details as $biz){
				$companyDetails['company_name']=$biz['company_name'];
				$companyDetails['services']=$biz['services'];
				$companyDetails['image_name']=$biz['address1'];
				
				$proData['companyDetails']= $companyDetails;
				}
				
				$productinfo [] = $proData;
				}
			   $resArr['statusCode'] = 200;
			   $resArr['data'] =$productinfo;
			   $this->set_response($resArr, 200);
				}
	}
	}
   
   
   public function getProductsBySupplierId_get(){
	  	$supplier_id = $this->get('supplier_id'); 
		if($supplier_id==""){
		   $resArr['message']="Please submit supplier Id";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}else{ 
			 $sql="SELECT p.* FROM bt_products as p 
			  JOIN bt_members m ON m.user_id = p.uid
			  WHERE m.user_id =$supplier_id AND p.approved = 'yes'  AND m.suspended='N' GROUP BY p.id";
				
				$productData= $this->Site_model->execute($sql);
				
				if(empty($productData)){
					
				   $resArr['message']="No records found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{
				foreach($productData as $value){
                $proData ['productname'] = $value['title'];
                $proData ['price'] = $value['price'];
                $proData ['discountPrice'] = 0;
                $proData ['description'] =$value['description'];
                $proData ['product_id'] = $value['id'];
				
				
			    $salepro_rate_info = $this->Site_model->getRowData('bt_ratings',"ratedto='".$value['id']."' AND type_rate='P'");
                $proData ['ratings'] =$salepro_rate_info[0]['rating'];
                $proData ['quantity_range'] ='';
                $proData ['qty'] =$value['qty_unit'];
                $proData ['min_qty'] = $value['min_order'];
                $proData ['product_category'] = '';
				if (in_array($value['id'], $buyData))
				  {
				 $proData ['product_type'] ="BuyOffer";
				  }
				else if (in_array($value['id'], $sellData))
				  {
				 $proData ['product_type'] ="SellOffer";
				  }
				  else if(in_array($value['id'], $hotSellingData)){
					 $proData ['product_type'] ="HotSelling";  
				  }
				else{
				$productType=array(
				1=>'Wholesale',
				0=>'Featured'
				);
				$proData ['product_type'] = $productType[$value['wholesale']];  
				  }
			
				$proData ['whole_sale_product'] = $value['wholesale'];
				
				$sql="SELECT img_url FROM bt_product_images WHERE offer_id='".$value['id']. "' ORDER BY id DESC";
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "' ");
				
			
				if(!empty($productImages)){
				$proimage=array();	
				foreach($productImages as $img){
					 if(file_exists('assets/multimage/'.$img['img_url'])){
					$productImageData['image_name']=base_url().'assets/multimage/'.$img['img_url'];
					 }else{
					$productImageData['image_name']=base_url().'assets/uploadedimages/'.$img['img_url'];	 
					 }
					$proimage[]=$productImageData;
				}
				}
				$proData ['productImages'] =array_unique($proimage);
				
				$productDetails['color']=$productData[0]['color'];
				$productDetails['Location']=$productData[0]['location'];
				$productDetails['Samples Available']=$productData[0]['samples_available'];
				$productDetails['New Product']=$productData[0]['new'];
				
				$proData ['productDetails'] = $productDetails;
				
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "'");
				
				$where="user_id = '".$value['uid']."'";
                $business_details= $this->Site_model->getDataById( $table = "bt_business", $where );
				foreach($business_details as $biz){
				$companyDetails['company_name']=$biz['company_name'];
				$companyDetails['services']=$biz['services'];
				$companyDetails['image_name']=$biz['address1'];
				
				$proData['companyDetails']= $companyDetails;
				}
				
				$productinfo [] = $proData;
				}
			   $resArr['statusCode'] = 200;
			   $resArr['data'] =$productinfo;
			   $this->set_response($resArr, 200);
				}
		}
   }
  
  
  public function search_get(){
	  
	    $searchTerm = $this->get('search_term'); 
		if($searchTerm==""){
		   $resArr['message']="Please submit search value";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}else{
           $_searchfield= $searchTerm;
		   $prev="bt_";
            $searchWords        = explode(' ',$_searchfield);
            $searchTermBits     = array();
            foreach ($searchWords as $term)
            {
                $term = trim($term);
                if (!empty($term))
                {
                    $searchTermBits[] = "p.title LIKE '%$term%'";
                }
            }

            $__multiWordQ    = "";
            $__singleWordQu  = "";

            $__multiWordQ   .= implode(" AND ", $searchTermBits);
            $__singleWordQu  = implode(" OR ", $searchTermBits);
			   $product_SQL = "    
                  SELECT * ,p.id as pid 
                  FROM " . $prev . "products p   
                  JOIN " . $prev . "product_cats pc ON pc.offer_id = p.id  
                  RIGHT JOIN " . $prev . "members m ON m.user_id = p.uid 
                  WHERE p.approved = 'yes' AND m.suspended='N' and title like '%$_searchfield%'  AND p.price<>0 ORDER BY p.id DESC ";
             $searchResultsData =$this-> Site_model->execute($product_SQL);

	            if(!empty($searchResultsData)){
					
	  	          $searchProductData=array();
				  foreach($searchResultsData as $search){
					    
							if(file_exists('assets/uploadedimages/'.$search['img_url'])){
							$proData ['product_name'] =$search['title'];
							$proData ['product_id'] = $search['pid'];
							$proData ['product_currency'] ='USD';
							$proData ['product_pric'] = $search['price'];
							$proData['product_img_url']=base_url().'assets/uploadedimages/'.$search['image'];
							$user_id=$search['uid'];
						   $sqlcompany = "SELECT * FROM `bt_business` WHERE user_id ='$user_id'";
				           $companyInfo= $this->Site_model->execute($sqlcompany);
						  $proData['minisite']='http://'.strtolower($companyInfo[0]["minisite_prefix"]).'.blazebay.com';
							 }else if(file_exists('assets/multimage/'.$search['img_url'])){
							$proData['product_img_url']=base_url().'assets/multimage/'.$search['image'];
                            $proData ['product_name'] =$search['title'];
							$proData ['product_id'] = $search['pid'];
							$proData ['product_currency'] ='USD';
							$proData ['product_pric'] = $search['price'];
							$proData['product_img_url']=base_url().'assets/uploadedimages/'.$search['image'];
							$user_id=$search['uid'];
						   $sqlcompany = "SELECT * FROM `bt_business` WHERE user_id ='$user_id'";
				           $companyInfo= $this->Site_model->execute($sqlcompany);
						  $proData['minisite']='http://'.strtolower($companyInfo[0]["minisite_prefix"]).'.blazebay.com';							
							 }else{
								$resArr['statusCode'] = 301;
							   $resArr['data'] ='No match found for'.' '.$searchTerm;
							   $this->set_response($resArr, 301); 
							 }
						
					
						$searchProductData[]=$proData;
				  }
				   $resArr['statusCode'] = 200;
				   $resArr['data'] =$searchProductData;
				   $this->set_response($resArr, 200);
				}else{
					$resArr['statusCode'] = 301;
				   $resArr['data'] ='No match found for'.' '.$searchTerm;
				   $this->set_response($resArr, 301);
				}
		}
			 }

  public function getUserOrders_get(){
	 $user_id = $this->get('user_id'); 
		if($user_id==""){
		   $resArr['message']="Please submit user Id";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}else{
			$sql="SELECT o.* FROM  bt_order as o where o.customer_id ='$user_id'";
			 $ordersData =$this-> Site_model->execute($sql);

			 if(!empty($ordersData)){

	  	          $customerOrderData=array();
				  $orderStatus=array(
				  0=>'Pending',
				  1=>'Paid Waiting Delivery',
				  2=>'Delivered'
				  );
				  foreach($ordersData as $orders){
					    $orData ['orderCode'] =$orders['order_number'];
						$orData ['orderDate'] = $orders['date_added'];
						$orData ['orderStatus'] =$orderStatus[$orders['order_status_id']];
						$orData ['orderCountry'] =$orders['shipping_country_id'];
						$orData ['orderTotal'] = $orders['total'];
						$orData ['currency'] = $orders['currency'];
						$orData ['shippingFee'] =$orders['shipping_charge'];
						
						$customerOrderData[]=$orData;
				  }
				   $resArr['statusCode'] = 200;
				   $resArr['data'] =$customerOrderData;
				   $this->set_response($resArr, 200);
				}else{
				   $resArr['statusCode'] = 301;
				   $resArr['data'] ='No pending Orders yet';
				   $this->set_response($resArr, 301);
				}
	    	}			
  }			 

    public function getUserTransactions_get(){
	 $user_id = $this->get('user_id'); 
		if($user_id==""){
		   $resArr['message']="Please submit user Id";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}else{
			 $sql="SELECT * FROM  bt_payments where order_user_id ='$user_id'";
			 $transData =$this-> Site_model->execute($sql);

			 if(!empty($transData)){

	  	          $transactionData=array();
				  foreach($transData as $transact){
					    $trxData ['trans_Id'] =$transact['payment_id'];
						$trxData ['trans_date'] = $transact['order_trans_date'];
						$trxData ['trans_order_no'] =$transact['order_number'];
						$trxData ['payment_status'] =$transact['payment_status'];
						$trxData ['trans_amount'] = $transact['payment_gross'];
						$trxData ['currency'] = $transact['currency_code'];
						
						$transactionData[]=$trxData;
				  }
				   $resArr['statusCode'] = 200;
				   $resArr['data'] =$transactionData;
				   $this->set_response($resArr, 200);
				}else{
				   $resArr['statusCode'] = 301;
				   $resArr['data'] ='No transaction found';
				   $this->set_response($resArr, 301);
				}
	    	}			
  }			 

  
  	public function getProductsById_get(){
		        
				$product_id = $this->get('product_id'); 
				if($product_id==""){
				   $resArr['message']="Please submit Product Id";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{
		       $prev="bt_";
			   $product_SQL = "SELECT * FROM `bt_products` WHERE id='$product_id'";
              $productData =$this-> Site_model->execute($product_SQL);
				
				
				foreach($productData as $value){
                $proData ['productname'] = $value['title'];
                $proData ['price'] = $value['price'];
                $proData ['discountPrice'] = 0;
                $proData ['description'] =$value['description'];
                $proData ['product_id'] = $value['id'];
				
				
			    $salepro_rate_info = $this->Site_model->getRowData('bt_ratings',"ratedto='".$value['id']."' AND type_rate='P'");
                $proData ['ratings'] =$salepro_rate_info[0]['rating'];
                $proData ['quantity_range'] ='';
                $proData ['qty'] =$value['qty_unit'];
                $proData ['min_qty'] = $value['min_order'];
                $proData ['product_category'] = '';
				if (in_array($value['id'], $buyData))
				  {
				 $proData ['product_type'] ="BuyOffer";
				  }
				else if (in_array($value['id'], $sellData))
				  {
				 $proData ['product_type'] ="SellOffer";
				  }
				  else if(in_array($value['id'], $hotSellingData)){
					 $proData ['product_type'] ="HotSelling";  
				  }
				else{
				$productType=array(
				1=>'Wholesale',
				0=>'Featured'
				);
				$proData ['product_type'] = $productType[$value['wholesale']];  
				  }
			
				$proData ['whole_sale_product'] = $value['wholesale'];
				
				$sql="SELECT img_url FROM bt_product_images WHERE offer_id='".$value['id']. "' ORDER BY id DESC";
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "' ");
				
			
				if(!empty($productImages)){
				$proimage=array();	
				foreach($productImages as $img){
					 if(file_exists('assets/multimage/'.$img['img_url'])){
					$productImageData['image_name']=base_url().'assets/multimage/'.$img['img_url'];
					 }else{
					$productImageData['image_name']=base_url().'assets/uploadedimages/'.$img['img_url'];	 
					 }
					$proimage[]=$productImageData;
				}
				}
				$proData ['productImages'] =array_unique($proimage);
				
				$productDetails['color']=$productData[0]['color'];
				$productDetails['Location']=$productData[0]['location'];
				$productDetails['Samples Available']=$productData[0]['samples_available'];
				$productDetails['New Product']=$productData[0]['new'];
				
				$proData ['productDetails'] = $productDetails;
				
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "'");
				
				$where="user_id = '".$value['uid']."'";
                $business_details= $this->Site_model->getDataById( $table = "bt_business", $where );
				foreach($business_details as $biz){
				$companyDetails['company_name']=$biz['company_name'];
				$companyDetails['services']=$biz['services'];
				$companyDetails['image_name']=$biz['address1'];
				
				$proData['companyDetails']= $companyDetails;
				}
				
				$productinfo [] = $proData;
				}
				$data=array(
				'data'=>$productinfo,
				'statusCode'=>200
				);
                $this->set_response($data,200);
				}
	   }
   
		   public function getCourier_get(){
			    $product_id = $this->get('country_id'); 
				if($product_id==""){
				   $resArr['message']="Please submit country Id";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{
			    $sql="SELECT lp.*,bt_business.company_name  FROM bt_location_pricing lp JOIN bt_business ON lp.uid=bt_business.user_id";
                $courier_details= $this->Site_model->execute( $sql);
				if(!empty($courier_details)){
				foreach($courier_details as $courier){
				$courierDetails['courier_id']=$courier['uid'];
				$courierDetails['company_name']=$courier['company_name'];
				$courierDetails['currency']='USD';
				$courierDetails['shipping_cost']=$courier['price'];
				$courierDetails['duration']=$courier['duration'];
				$courierDetails['shipping_duration']=$courier['duration'];
				
				$curiorinfo [] = $courierDetails;
				}
				
				
				
				$data=array(
				'data'=>$curiorinfo,
				'statusCode'=>200
				);
                $this->set_response($data,200);
				}else{
					$resArr['message']="No couriers found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}
				}
		   }
		   
		   public function getcountriesListed_get(){
			   
			    $sql="SELECT country_id,country_name,flag_32 FROM `bt_countries` WHERE country_id IN(112,237,100,244,216,42,224)";
                $courier_details= $this->Site_model->execute( $sql);
				if(!empty($courier_details)){
				foreach($courier_details as $courier){
				$courierDetails['country_id']=$courier['country_id'];
				$courierDetails['country_name']=$courier['country_name'];
				$courierDetails['flag']=base_url().'assets/images/country/'.$courier['flag_32'];
				
				$curiorinfo [] = $courierDetails;
				}
				
				
				
				$data=array(
				'data'=>$curiorinfo,
				'statusCode'=>200
				);
                $this->set_response($data,200);
		   }
		   }
		   public function OrderHistory_get(){
		   $user_id =$this->get( 'user_id' );
			if( $user_id=="") {
				$resArr['message']='Please pass user_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
				
			}
			else {
				$sql="SELECT * FROM bt_order WHERE customer_id=$user_id 
  				AND order_number<>'' AND total<>''  AND shipping_charge<>''  GROUP  BY order_number ORDER BY order_id	DESC ";
                $order_details= $this->Site_model->execute( $sql);
				
				
				if(!empty($order_details)){
					
				
				$allOrders=array();
				
				foreach($order_details as $orders){
				$ordersInfo=array();			
				$orderitems=array();
				$supplier_details=array();
				$customerOrder=array();
				

				
				$ordersInfo['orderCode']=$orders['order_number'];
				$ordersInfo['orderDate']=$orders['date_added'];
				if($orders['buyer_status']==0){
				$ordersInfo['orderStatus']='Pending';	
				}
				
				$ordersInfo['orderCountry']=$orders['shipping_country_id'];
				
				$ordersInfo['orderTotal']=$orders['total'];
				$ordersInfo['currency']=$orders['currency'];
				$ordersInfo['shippingFee']=$orders['shipping_charge'];
				
                $order_id=$orders['order_id'];
				
				
				
				$sql="SELECT * FROM bt_order_product WHERE order_id=$order_id";
                $order_itemsDetails= $this->Site_model->execute( $sql);
				
          
				 $productId=$order_itemsDetails[0]['product_id'];
				 $supplier_ids=$order_itemsDetails[0]['supplier_id'];
				 $sql="SELECT * FROM bt_products WHERE id=$productId";
                 $produuctDetails= $this->Site_model->execute( $sql);
				 
				$orderitems['productImageUrl']=base_url()."assets/uploadedimages/".$produuctDetails[0]["image"];
				$orderitems['productName']=$order_itemsDetails[0]['name']?$order_itemsDetails[0]['name']:'';
				$orderitems['productQty']=$order_itemsDetails[0]['quantity']?$order_itemsDetails[0]['quantity']:'';
				$orderitems['unitPrice']=$order_itemsDetails[0]['price']?$order_itemsDetails[0]['price']:'';
				$supplier_id=$order_itemsDetails[0]['supplier_id'];	
				
				
			
				 $sql="SELECT * FROM bt_business WHERE user_id=$supplier_id";
                 $suplierDetails= $this->Site_model->execute( $sql);
				 
				 $sql="SELECT * FROM bt_members WHERE user_id=$supplier_id";
                 $userDetails= $this->Site_model->execute( $sql);

				$supplier_details['company_name']=$suplierDetails['company_name']?$suplierDetails['company_name']:'';
				$supplier_details['city']=$suplierDetails['city']?$suplierDetails['city']:$userDetails[0]['city'];
				$supplier_details['phone_number']=$suplierDetails['phone']?$suplierDetails['phone']:'';
				$supplier_details['street_address']=$suplierDetails['address1']?$suplierDetails['address1']:'';
				
				
			    $data['data']=$ordersInfo;
				$data['order_items']=$orderitems;	
			    $data['supplier_details']=$supplier_details;	
			    $allOrders[]=$data;
			   }
			    

				
				$Orderdata=array(
				'statusCode'=>200,
				'orders'=>$allOrders
				);
				$this->set_response ( $Orderdata, 200);
				} else{
					
					
				$resArr['message']='No order History found';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
				}
				
				
				
				
			}
		   }
		   

		 public function getOverallSummary_get(){
			$user_id =$this->get( 'user_id' );
			if( $user_id=="") {
				$resArr['message']='Please pass user_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
				
				$sql="SELECT * FROM bt_order WHERE customer_id=$user_id  ";
                $orders= $this->Site_model->execute( $sql);
				
			    $sql="SELECT * FROM bt_order WHERE customer_id=$user_id  AND buyer_status='0' ";
                $order_pending= $this->Site_model->execute( $sql);	
				
				$sql="SELECT * FROM bt_order WHERE customer_id=$user_id AND buyer_status='1'  ";
                $order_delivered= $this->Site_model->execute( $sql);

                $sql="SELECT * FROM bt_favorites WHERE uid=$user_id";
                $favorites= $this->Site_model->execute( $sql);
				
                $sql="SELECT * FROM bt_offers_buy WHERE uid=$user_id ";
                $buyoffers= $this->Site_model->execute( $sql);				
				if(!empty($orders)){
					$orders=count($orders);
				}
				if(!empty($order_delivered)){
					$order_delivered=count($order_delivered);
				}
				if(!empty($order_pending)){
					$order_pending=count($order_pending);
				}
				if(!empty($buyoffers)){
					$buyoffers=count($buyoffers);
				}
				if(!empty($favorites)){
					$favorites=count($favorites);
				}
				$orderData['total_orders'] = $orders?$orders:0;	
				$orderData['delivered_orders'] = $order_delivered?$order_delivered:0;	
				$orderData['pending_orders'] =$order_pending?$order_pending:0;	
				$orderData['buy_offers'] =$buyoffers?$buyoffers:0;	
				$orderData['favourites'] =$favorites?$favorites:0;	
				
				$data=array(
				'data'=>$orderData,
				'statusCode'=>200
				);
                $this->set_response($data,200);
			} 
		 }
		public function payViaMpesa_post(){
			$data = json_decode(file_get_contents('php://input'), true);
           
		   	
			 foreach ($data['data'] as  $response) {
				      $mpesaData=array();
						 foreach ($response as  $payment) {
							 
						$mpesaTransaction=array(
			            'inbound_id'=>$payment['inbound_id'],
						'orig'=>$payment['orig'],
						'dest'=>$payment['dest'],
						'tstamp'=>$payment['tstamp'],
						'text'=>$payment['text'],
						'customer_id'=>$payment['customer_id'],
						'user'=>$payment['user'],
						'pass'=>$payment['pass'],
						'routemethod_id'=>$payment['routemethod_id'],
						'routemethod_name'=>$payment['routemethod_name'],
						'mpesa_code'=>$payment['mpesa_code'],
						'mpesa_acc'=>$payment['mpesa_acc'],
						'mpesa_msisdn'=>$payment['mpesa_msisdn'],
						'mpesa_trx_date'=>$payment['mpesa_trx_date'],
						'mpesa_trx_time'=>$payment['mpesa_trx_time'],
						'mpesa_amt'=>$payment['mpesa_amt'],
						'mpesa_sender'=>$payment['mpesa_sender'],
						'business_number'=>$payment['business_number'],
						'created_at'=>$payment['created_at']['date'],			  
			          );
						

						 $res=$this->Site_model->add('bt_mpesa_transactions',$mpesaTransaction);
			          }
				  
					  
			    }
				$resArr['message']='Success';
				$resArr['statusCode'] = 200;
				$this->set_response ( $resArr, 200);
			
		}
		  
		 public function uploadImage_post(){

		     $type=$_POST['type'];
			if($_FILES["file"]["name"]) {
				    $allowed_ext=array("jpg","jpeg","png","gif");
					
					$extension=explode('.',$_FILES["file"]["name"]);
					
					$ext=strtolower(end($extension));
					$newname=rand(10000,99999)."_".time().".".$ext;
					if(in_array($ext,$allowed_ext))
					{
						if($type=='wholesale'){
						$loc= "assets/uploadedimages/".$newname;
						
                        $slider_target_path = "assets/multimage".$newname;
                      	move_uploaded_file($_FILES["file"]["tmp_name"],$slider_target_path);
						
						}else if($type=='featured'){
							
						$loc= "assets/uploadedimages/".$newname;
                        $slider_target_path = "assets/multimage/".$newname;
                     move_uploaded_file($_FILES["file"]["tmp_name"],$slider_target_path);
						
						}else if($type=='tradeshows'){
						$loc="assets/trade/".$newname;	
						
						}else if($type=='feedback'){
						$loc="assets/upload_image/feedback/".$newname;	
						
						} if($type=='banners'){
						$loc="assets/banners2/".$newname;	
						
						}else if($type=='profile'){
						$loc="assets/uploadedimages/".$newname;	
						
						}else if($type=='buyoffers'){
							
						$loc= "assets/uploadedimages/buyoffer/".$newname;	
						}
				move_uploaded_file($_FILES["file"]["tmp_name"],$loc);

				$resArr['message']='Success';
				$resArr['name']=$newname;
				$resArr['statusCode'] = 200;
				$this->set_response ( $resArr, 200);
					}else{
				$resArr['message']='Please upload an Image';
				$resArr['statusCode'] = 200;
				$this->set_response ( $resArr, 200);
					}
				
			}
			else { 
			    $resArr['message']='Please pass all parameters';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
		 }
		
			
		   public function getHomeBanners_get(){
			    $platform = $this->get('platform');  
			   if($platform==""){
				   $resArr['message']="Please pass the platform";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				} else{
			  $sql="SELECT * FROM bt_homepage_banner WHERE platform='$platform'  AND heading_msgdesc <>'' ORDER BY  ord ASC ";
			  $homebannersData = $this->Site_model->execute($sql); 
			  $bannerDetails=array();
			  foreach($homebannersData as $banner){
				 // if(file_exists($banner['image'])){
				$bannersdetails['id']=$banner['id'];
				$bannersdetails['title']=$banner['title'];
				$bannersdetails['image_url']=$banner['image'];
				$bannersdetails['description']=$banner['description'];
				$bannersdetails['ord']=$banner['ord'];	
				$bannersdetails['heading_msg']=$banner['heading_msg'];				
				$bannersdetails['heading_msgdesc']=$banner['heading_msgdesc'];				
								  
			$bannerDetails[]=$bannersdetails;		  
			  //}
			  }
		$data=array(
		'data'=>$bannerDetails,
		'statusCode'=>200
		);
		$this->set_response($data,200);
		} 
	 }
	 	   public function trackOrder_get(){
		 $order_no =$this->get( 'order_no' );
			if( $order_no=="") {
				$resArr['message']='Please pass order_no';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
				
			}
			else {
				$orderIdData = $this->Site_model->getRowData("bt_order", "order_number = '" . $order_no."'");
				$no=$orderIdData[0]['order_id'];
               
				if(!empty($orderIdData)){
               $buyer_order_date = $orderIdData[0]['date_added'];

               $buyer_order_date = date("jS F, Y", strtotime($buyer_order_date));
	
                $buyerdetails['Track_no']=$order_no;
				$buyerdetails['order_date']=$buyer_order_date;
				$buyerdetails['total']='USD'.' '.$orderIdData[0]['total'];
				$buyerdetails['buyer_name']=$orderIdData[0]['shipping_firstname'].' '.$orderIdData[0]['shipping_lastname'];
				$buyerdetails['address']=$orderIdData[0]['phone'];
				$buyerdetails['address']=$orderIdData[0]['shipping_address_1'];
			    $track['buyerDetails']=$buyerdetails;						
					
					  // Courier Company Details::

			$qry = " SELECT oc.courier_order_number,mb.company_name,mb.address1,mb.company_logo, mb.about , mb.phone, mb.website  FROM  bt_order_courier as oc   JOIN bt_business as mb  ON oc.courier_id  = mb.user_id  JOIN bt_order odr ON oc.order_id  = odr.order_id WHERE
			odr.order_number  = '$order_no'";
			$courier_details =$this->Site_model->execute($qry);
			

			$courier_details=$courier_details[0];

			// Company Profile picture

			$company_logoimg =base_url() . 'assets/uploadedimages/';

			if (!empty($courier_details['company_logo'])) {

				$company_logoimg_vpath = $company_logoimg . $courier_details['company_logo'];

				$company_logoimg_apath = 'assets/uploadedimages/'. $courier_details['company_logo'];

				if (!file_exists($company_logoimg_apath)) {

					$company_logoimg_vpath = base_url(). "assets/images/nopic.jpg";

				}

			} else {

				$company_logoimg_vpath =base_url()."assets/images/nopic.jpg";

			}

									
				$cudetails['curierlogo']=$company_logoimg_vpath;
				$cudetails['company']=$courier_details['company_name'];
				$cudetails['address']=$courier_details['address1'];
				$cudetails['phone']=$courier_details['phone'];
				$cudetails['website']=$courier_details['website'];
			    $track['shippingDetails']=$cudetails;
									
                $status=array(
				1=>'Approved, Payment Done',
				2=>'Order Process',
				3=>'Dispatched',
				4=>'Order On The Way',
				5=>'Delivered' );
				
               $orderStatusData = $this->Site_model->getRowData("bt_order_supplier", "order_id = '" . $no."'");
				if($orderStatusData[0]['sup_courier_status']==1){
					$state['Approved, Payment Done']=true;
					$state['Order Processing']=false;
					$state['Dispatched']=false;
					$state['Order On The Way']=false;
					$state['Delivered']=false;
					$track['status']=$state;
				}
				if($orderStatusData[0]['sup_courier_status']==2){
					$state['Approved, Payment Done']=true;
					$state['Order Processing']=true;
					$state['Dispatched']=false;
					$state['Order On The Way']=false;
					$state['Delivered']=false;
					$track['status']=$state;
				}
				if($orderStatusData[0]['sup_courier_status']==3){
					$state['Approved, Payment Done']=true;
					$state['Order Processing']=true;
					$state['Dispatched']=true;
					$state['Order On The Way']=false;
					$state['Delivered']=false;
					$track['status']=$state;
				}
				if($orderStatusData[0]['sup_courier_status']==4){
					$state['Approved, Payment Done']=true;
					$state['Order Processing']=true;
					$state['Dispatched']=true;
					$state['Order On The Way']=true;
					$state['Delivered']=false;
					$track['status']=$state;
				}
				if($orderStatusData[0]['sup_courier_status']==5){
					$state['Approved, Payment Done']=true;
					$state['Order Processing']=true;
					$state['Dispatched']=true;
					$state['Order On The Way']=true;
					$state['Delivered']=true;
					$track['status']=$state;
				}
				
				$details[]=$track;
				$this->set_response($details,200);
			 }
			else{
				$resArr['message']='No records found for order_no'.' '.$order_no;
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
				
			}
	        }
		   }
		   
		   public function getProductImages_get(){
		    $product_id =$this->get( 'product_id' );
			if( $product_id=="") {
				$resArr['message']='Please pass product_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
				
			}
			else {
				$sql="SELECT * FROM bt_product_images WHERE offer_id=$product_id";
                $productImages=$this->Site_model->execute( $sql);
				
				if(!empty($productImages)){
				$proimage=array();	
				foreach($productImages as $img){
					 if(file_exists('assets/multimage/'.$img['img_url'])){
					$productImageData['image_name']=base_url().'assets/multimage/'.$img['img_url'];
					 }else{
					$productImageData['image_name']=base_url().'assets/uploadedimages/'.$img['img_url'];	 
					 }
					$proimage[]=$productImageData;
				}
				
				$proData ['productImages'] =$proimage;
				
				$data=array(
					'data'=>$proData,
					'statusCode'=>200
					);
					$this->set_response($data,200);
				} else{
				$resArr['message']='No images found';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
					
				}
				
	            }
				
				
			}
  
       public function getSupplierOrders_get(){
			$user_id =$this->get( 'user_id' );
			if( $user_id=="") {
				$resArr['message']='Please pass user_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
				
				$sql="SELECT * FROM bt_order_supplier WHERE supplier_id=$user_id GROUP BY order_id";
                $productorders= $this->Site_model->execute( $sql);
				if(!empty($productorders)){
					foreach($productorders as $orders){
						
				
				$order_id=$orders['order_id'];
				$sql="SELECT * FROM bt_order_product WHERE order_id=$order_id";
				
                $order_itemsDetails= $this->Site_model->execute( $sql);
				
				$sql="SELECT order_number,currency FROM bt_order WHERE order_id=$order_id";
                $ordern= $this->Site_model->execute( $sql);
				
				
				$ordersInfo['orderCode']=$ordern[0]['order_number'];
				$ordersInfo['orderDate']=$orders['assign_date'];
				$ordersInfo['currency']=$ordern[0]['currency'];
				$ordersInfo['total']=$orders['supplier_price'];
				$supStatus = $orders['status'];
                $courStatus = $orders['sup_courier_status'];
			
				if($supStatus==1 && $courStatus ==1){
				$ordersInfo['orderStatus']='New Order';	
				}
				if($supStatus == 2 && $courStatus == 2){
				$ordersInfo['orderStatus']='Order Processing in Progress';	
				}
				if($supStatus == 3 && $courStatus == 3){
				$ordersInfo['orderStatus']='Order Dispatched';	
				}
				if($supStatus == 3 && $courStatus == 5){
				$ordersInfo['orderStatus']='Order Delivered';	
				
				}
				
				$productId=$order_itemsDetails[0]['product_id'];
				
				$supplier_ids=$order_itemsDetails[0]['supplier_id'];
				
				
				
				$sql="SELECT * FROM `bt_product_images` WHERE offer_id=$productId LIMIT 1 ";
				$produuctDetails= $this->Site_model->execute( $sql);
				 
				$ordersInfo['productImageUrl']=base_url()."assets/uploadedimages/".$produuctDetails[0]["img_url"];
				$ordersInfo['productName']=$order_itemsDetails[0]['name']?$order_itemsDetails[0]['name']:'';
				$ordersInfo['productQty']=$order_itemsDetails[0]['quantity']?$order_itemsDetails[0]['quantity']:'';
				$ordersInfo['unitPrice']=$order_itemsDetails[0]['price']?$order_itemsDetails[0]['price']:'';
				
				
				
				
                
				//$ordersInfo['orderitems']=$orderitems;
				$supplierOrders[]=$ordersInfo;
				}
				$orderData=$supplierOrders;
				$data=array(
				'data'=>$orderData,
				'statusCode'=>200
				);
                $this->set_response($data,200);
					
				} else{
				$resArr['message']='No order records found';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
				}
			}
			
	   }
  
   public function getSupplierMessages_get(){
			$user_id =$this->get( 'user_id' );
			if( $user_id=="") {
				$resArr['message']='Please pass user_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
				$sql = " SELECT m.user_id,m.firstname,m.lastname,m.username,mg.*   FROM  bt_messages as mg JOIN bt_members as m ON m.user_id = mg.fid WHERE  
				mg.tid = '$user_id'  ORDER BY mg.id DESC";
				$incoming_msglist= $this->Site_model->getcountRecods($sql);
				
                 if(!empty($incoming_msglist)){
					
					foreach($incoming_msglist as $coming){
				
				$msgitems['from']=$coming["from_email"];
				$msgitems['subject']=$coming["subject"];
				$msgitems['message']=$coming["message"];
				$msgitems['date']=date('d M Y h.i.s A', strtotime($coming["tempdate"]));
				$msgitems['status']=$coming["msg_read"];
				$msg[]=$msgitems;
					}
					
				$data=array(
				'data'=>$msg,
				'statusCode'=>200
				);
                $this->set_response($data,200);
              }
			  else{
				$resArr['message']='No messages found';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);  
			  }
			}
   }
  
   public function getSupplierInquiries_get(){
			$user_id =$this->get( 'user_id' );
			if( $user_id=="") {
				$resArr['message']='Please pass user_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
		$sqlStatement = "SELECT

						e.id as enquiry_id,

						e.*,

						m.user_id as member_id,

						m.firstname as member_firstname,

						m.lastname as member_lastname,

						m.email as member_email,

						m.country as member_country

						

					FROM 

						bt_enquiry e 

					LEFT JOIN  bt_members m ON m.user_id = e.sender_id

					WHERE e.receiver_id ='$user_id'";

				$incoming_msglist= $this->Site_model->getcountRecods($sqlStatement);
				
                 if(!empty($incoming_msglist)){
					
					foreach($incoming_msglist as $coming){
				
                         if(!empty($received['member_id'])){

                              $members=$received['member_firstname'].' '.$received['member_lastname'];

                            }else{

                             $members="Unknown"; 

                            }
				$msgitems['from']=$members;
				$msgitems['subject']=$coming["subject"];
				$msgitems['message']=$coming["message"];
				$msgitems['email']=$coming["email"];
				$msgitems['date']=date('d M Y h.i.s A', strtotime($coming["enqdate"]));
				$msg[]=$msgitems;
					}
					
				$data=array(
				'data'=>$msg,
				'statusCode'=>200
				);
                $this->set_response($data,200);
              }
			  else{
				$resArr['message']='No inquiries found';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);  
			  }
			}
   }
  
  
   public function getSupplierFeatured_get(){
			$user_id =$this->get( 'user_id' );
			if( $user_id=="") {
				$resArr['message']='Please pass user_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
		else{
			  $qry="SELECT * FROM `bt_products` WHERE uid=$user_id";
		        $productData= $this->Site_model->execute($qry);
		        $proData['statusCode'] = 200;
			   
			   	//buy offers
				$bqry  = " SELECT CONCAT(added_by, 'buy') as 'type', buy.* FROM bt_offers_buy as buy JOIN  bt_members as m ON m.user_id=buy.uid 
				WHERE   buy.expireson > NOW() AND m.user_id=$user_id ";
				$buyData= $this->Site_model->execute($bqry);
				
				//sell offers
				$sqry  = "SELECT CONCAT(p.other_mode,'sell') as 'type', p.*
				FROM  bt_products as p  JOIN  bt_offers as o ON p.id=o.prod_id  WHERE o.expireson > NOW() AND p.uid=$user_id ";
				$sellData= $this->Site_model->execute($sqry);
				
                //hotselling data
 
                $sql="SELECT  CONCAT(p.other_mode,'hot') as 'type', p.*  FROM  bt_products as p  RIGHT JOIN   bt_members as m ON m.user_id = p.uid WHERE m.suspended='N'  AND
				p.wholesale='0'  AND p.image !='' AND p.uid=$user_id
				ORDER BY p.id  DESC LIMIT 12";
				
				$hotSellingData= $this->Site_model->execute($sql);

				$list=array_merge($productData);
			

				foreach($list as $value){
                $proData ['productname'] = $value['title'];
                $proData ['price'] = $value['price'];
                $proData ['discountPrice'] = 0;
                $proData ['description'] =$value['description'];
                $proData ['product_id'] = $value['id'];
				
				
			    $salepro_rate_info = $this->Site_model->getRowData('bt_ratings',"ratedto='".$value['id']."' AND type_rate='P'");
                $proData ['ratings'] =$salepro_rate_info[0]['rating'];
                $proData ['quantity_range'] ='';
                $proData ['qty'] =$value['qty_unit'];
                $proData ['min_qty'] = $value['min_order'];
				$proData ['min_price'] =$value['min_price'];
                $proData ['max_price'] = $value['max_price'];
				$proData ['min_sell_price'] =$value['min_sell_price'];
                $proData ['max_sell_price'] = $value['max_sell_price'];
                $proData ['product_category'] = '';

				$productType=array(
				1=>'Wholesale',
				0=>'Featured'
				);
				$proData ['product_type'] = $productType[$value['wholesale']];  
	
			
				$proData ['whole_sale_product'] = $value['wholesale'];
				
				$sql="SELECT img_url FROM bt_product_images WHERE offer_id='".$value['id']. "' ORDER BY id DESC";
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "' ");
				
			
				if(!empty($productImages)){
			
					 if(file_exists('assets/multimage/'.$productImages['img_url'])){
					$productImageData=base_url().'assets/multimage/'.$productImages[0]['img_url'];
					 }else{
					$productImageData=base_url().'assets/uploadedimages/'.$productImages[0]['img_url'];	 
					 }
				}
				$proData ['productImages'] =$productImageData;
				
				$proData['color']=$productData[0]['color'];
				$proData['Location']=$productData[0]['location'];
				$proData['Samples Available']=$productData[0]['samples_available'];
				$proData['New Product']=$productData[0]['new'];
				
				//$proData ['productDetails'] = $productDetails;
				
				$productinfo [] = $proData;
				}
				$data=array(
				'data'=>$productinfo,
				'statusCode'=>200
				   );
				$this->set_response($data,200);
				   
		}
			}
 
    public function getSupplierQuotes_get(){
	   
			$user_id =$this->get( 'user_id' );
			if($user_id=="") {
				$resArr['message']='Please pass user_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
				$sql='SELECT *  FROM  bt_quotes  WHERE receiver_id='.$user_id.'
				ORDER BY qt_id  DESC';
				
				$supplierQuotes= $this->Site_model->execute($sql);
                  if(!empty($supplierQuotes)){
				foreach($supplierQuotes as $quote){

				$quotedata['quoteNumber']=$quote['quote_number'];
				$quotedata['subject']=$quote['subject'];
				$quotedata['item']=$quote['item_number'];
				$quotedata['amount']=$quote['product_price'];
				$quotedata['content']=$quote['descp'];
				$quotedata['date']=$quote['time'];
						
				$qdata[] = $quotedata;
				}
				$data=array(
				'data'=>$qdata,
				'statusCode'=>200
				   );
				$this->set_response($data,200);	
			}
			else{
				$resArr['message']='No quotes sent';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			}
	}
 
 public function getSupplierInformation_get(){
	   
			$user_id =$this->get( 'user_id' );
			if( $user_id=="") {
				$resArr['message']='Please pass user_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
		        $sqlcompany = "SELECT * FROM `bt_business` WHERE user_id ='$user_id'";
				$companyInfo= $this->Site_model->execute($sqlcompany);
				
				
				$sqluser = "SELECT * FROM `bt_members` WHERE user_id ='$user_id'";
				$userInfo= $this->Site_model->execute($sqluser);
				
                if(!empty($companyInfo) && !empty($userInfo)){
				foreach($companyInfo as $company){
			
				$companydata['company_name']=$company["company_name"];
				$companydata['minisite_prefix']=$company["minisite_prefix"];
				$companydata['year_established']=$company['year_established'];
				$companydata['services']=$company["services"];
				$companydata['about']=$company["about"];
				$companydata['address1']=$company["address1"];
				$companydata['city']=$company['city']?$company['city']:'';
				$companydata['state']=$company["state"]?$company["state"]:'';
				$companydata['country']=$company["country"];
				$companydata['phone']=$company["phone"];
				$companydata['phone2']=$company['phone2'];
				$companydata['fax']=$company["fax"];
				$companydata['mobile']=$company['mobile'];
				if (file_exists("assets/uploadedimages/".$company['company_logo'])) {
				  $companydata['company_logo'] = base_url()."assets/uploadedimages/".$company['company_logo']; 
				}else {
					
				   $companydata['company_logo'] = base_url().'assets/company_banner/BB-logo.png';  
				}
				$companydata['ceo']=$company["ceo"];
				
				$data['companyDetails']=$companydata;
					}
               
				foreach($userInfo as $user){
				$details['username']=$user["username"];
				$details['email']=$user["email"];
				$details['name']=$user["firstname"].' '.$user["lastname"];
				$details['phone']=$user["phone"];
				$details['zip']=$user["zip"];
				$details['street']=$user["street"];
				$details['country']=$user["country"];
				$details['state']=$user["state"];
				$details['city']=$user["city"];
				//$details['membership']=$user["memtype"];
				$details['mobile']=$user["mobile"];
				$data['userDetails']=$details;
					}
				$membershiptype=$userInfo[0]["memtype"];
				$sqlmember = "SELECT * FROM `bt_membership_plan` WHERE 	plan_id ='$membershiptype'";
				$membershipplan= $this->Site_model->execute($sqlmember);
				
				
				$membership['plan_name']=$membershipplan[0]["plan_name"];
				$membership['plan_price']=$membershipplan[0]["plan_price"];
				$membership['no_of_products']=$membershipplan[0]["no_of_products"];
				$membership['no_of_sell_offer']=$membershipplan[0]["no_of_sell_offer"];
				$membership['no_of_buy_offer']=$membershipplan[0]["no_of_buy_offer"];
				$membership['no_of_days']=$membershipplan[0]["no_of_days"];
				$membership['plan_icon']=base_url().'assets/uploadedimages/'.$membershipplan[0]["plan_icon"];
				$membership['no_of_photos']=$membershipplan[0]["no_of_photos"];
				$membership['no_of_videos']=$membershipplan[0]["no_of_videos"];
				$membership['trade_alerts']=$membershipplan[0]["no_of_trade_alerts"];
				
				$data['membershipDetails']=$membership;
				$dataUser=array(
				'data'=>$data,
				'statusCode'=>200
				);
                $this->set_response($dataUser,200);	
              }
			  else{
				$resArr['message']='No data found ';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);  
			  }
			}
   }
 

      public function getSupplierTransactions_get(){
	   
			$user_id =$this->get( 'user_id' );
			if($user_id=="") {
				$resArr['message']='Please pass user_id';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
				$sql='SELECT *  FROM  bt_payments  WHERE order_user_id='.$user_id.'
				ORDER BY payment_id DESC';
 
				$supplierTransactions= $this->Site_model->execute($sql);
                  if(!empty($supplierTransactions)){
				foreach($supplierTransactions as $trans){
				
				$trsnsdata['TransactionId']=$trans['txn_id'];
				$trsnsdata['Date']=$trans['payment_date'];
				$trsnsdata['Order_Number']=$trans['order_number'];
				$trsnsdata['Type']=$trans['order_trans_type'];
				$trsnsdata['Payment Status']=$trans['payment_status'];
				$trsnsdata['Currency']=$trans['currency_code'];
				$trsnsdata['Amount']=$trans['payment_gross'];

						
				$tdata[] = $trsnsdata;
				}
				$data=array(
				'data'=>$tdata,
				'statusCode'=>200
				   );
				$this->set_response($data,200);	
			}
			else{
				$resArr['message']='No transaction information';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			}
	}
 
  public function editSupplierProductDetails_post(){
	   
			/*$product_type =$this->get( 'product_type' );
			if($product_type=="") {
				$resArr['message']='Please pass product_type';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {*/
				
			$title = $_POST["title"];
			$productId = $_POST["productId"];
			$description = $_POST["description"];
			$quantity = $_POST["quantity"];
			$featured = $_POST["features"];
			$min_order = $_POST["min_order"];
            $minprice      = $_POST["minprice"];              //supplier min price
		    $maxprice   = $_POST["maxprice"];              //supplier max price
            $minproduct_sell_price = $_POST["minproduct_sell_price"]; //product min sellig price
            $maxproduct_sell_price = $_POST["maxproduct_sell_price"]; //product max sellig price
		
        /*  $newfile=$_FILES["fileToUpload"]["name"];
							 
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
			*/
			
		  $product_data=array(
			'title'=>$title,
			'description'=>$description,
			'qty_unit'=>$quantity,	
			'min_order'=>$min_order,
			'min_price'             => $minprice,
			'max_price'             => $maxprice,
			'min_sell_price'       => $minproduct_sell_price,
			'max_sell_price'       => $maxproduct_sell_price,
			'supplier_price'=> $maxproduct_sell_price,
			'price'=> $maxproduct_sell_price,
			'image'=>$mainImageNewName,
			'featured'=>$features,
			);
			
			
		  $where="id=". $productId;
		  $product_update=$this->Site_model->update('bt_products',$product_data,$where);
		  if($product_update){
	             $resArr['message']='Success';
				$resArr['statusCode'] = 200;
				$this->set_response ( $resArr, 200);
			}
			else{
				$resArr['message']='Failed,an Error has occured';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
  
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
 
  public function mpesaPaymentVerification_post(){
	   
			$product_type =$this->get( 'mpesacode' );
			$product_type =$this->get( 'amount' );
			if($product_type=="") {
				$resArr['message']='Please pass Mpesa Code';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
			 $mpesacode=$_POST['mpesacode'];
			 $MpesaAccount=$_POST['MpesaAccount'];
			 $paymentAmount=$_POST['paymentAmount'];
			 $where="mpesa_code='$mpesacode'  AND mpesa_acc='$MpesaAccount' AND mpesa_amt >='$paymentAmount' ";
			 $mpesaVerification=$this->Site_model->getDataById("bt_mpesa_transactions",$where); 
			if(!empty($mpesaVerification)){
				$resArr['message']='success';
				$resArr['statusCode'] = 200;
				$this->set_response ( $resArr, 200);
			}else{
				$resArr['message']='Verification failed';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}

			}
			
	
  
  }
  
   public function postProducts_post(){
	  
						   $logged_user_planid =$this->post("membership_type");
						   $user_id =$this->post("user_id");
						   $product_type=$this->post("product_type");
						   $title = $this->post("title");
						   if($user_id=="") {
							$resArr['message']='Please pass user_id';
							$resArr['statusCode'] = 422;
							$this->set_response ( $resArr, 422);
						   }
						 else if($logged_user_planid=="") {
							$resArr['message']='Please pass mambership_type';
							$resArr['statusCode'] = 422;
							$this->set_response ( $resArr, 422);
						 }
						 else if($product_type=="") {
							$resArr['message']='Please pass product_type';
							$resArr['statusCode'] = 422;
							$this->set_response ( $resArr, 422);
						 }
						 else if($title=="") {
							$resArr['message']='Please pass product title';
							$resArr['statusCode'] = 422;
							$this->set_response ( $resArr, 422);
						 } else {
						 
					    $category = str_replace(";", ",", $this->post("category"));
						
						$sub_category = str_replace(";", ",", $this->post("sub_category"));
					
						$cat    = explode(",", $sub_category);
					   
						$description1 =$this->post("description");
						$description  = htmlentities($description1, ENT_QUOTES);
						$quantity     = $this->post("product_qty");
						$keywords     = $this->post("keywords");
						$key          = explode(",", $keywords);

						$origin       = "";
						$material     = "";
						$function     = "";
						$brand_name   = "";
						$model_number = "";
						$brand_name =$this->post("brand_name"); 
						$cbrand_name = $this->post("cbrand_name"); 
						$model_number =$this->post("model_number");
						$color      =$this->post("color");
						$type       = $this->post("type");
						$features   = $this->post("features");
						$expireson  = date("Y-m-d", strtotime($this->post('expireson')));
						$location           = $this->post("location");
						$qty_unit  = $this->post("qty_unit");
						$origin  = $this->post("origin");
						$material  = $this->post("material");
						$postedon  = date("Y-m-d");
						$min_order          = $this->post("min_order");
						$price_cur_id       = $this->post("currency_id");
						$minproduct_price   =$this->post("minprod_price");                 
						$maxproduct_price =$this->post("maxprod_price"); 
						$minwhole_sell_price    =$this->post("min_sell_price"); 
						$maxwhole_sell_price =$this->post("max_sell_price");
						$samples_available  =$this->post("samples_available");
						$product_status     = $this->post("product_status");
						
						  $prev='bt_';
						  $ADMIN_PERCENTAGE=5;
						  
                      
						$getBusinessDetails =$this->Site_model-> getDataById('bt_business',"user_id = ".$user_id."");
						if(!empty($getBusinessDetails)){
							$business_id = $getBusinessDetails[0]['id'];
						}

                        //getting user's previous postings
                        $sbq_off = "select * from " . $prev . "products where uid=" . $user_id;
                        $sbsell_count = count($this->Site_model->getcountRecods($sbq_off));
                        $USER_POSTED_PRODUCTS = count($this->Site_model->getcountRecods($sbq_off)); // TOTAL POSTED
						
						// Get Plan Details
						$sbq_gro = "select * from " . $prev . "membership_plan where plan_id ='" . $logged_user_planid . "'";
						$sbrow_gro =$this->Site_model->getcountRecods($sbq_gro);
						$PLAN_ALLOWED_PRODUCTS_NO = $sbrow_gro[0]["no_of_products"];

                        // Enters When 
                        if($USER_POSTED_PRODUCTS < $PLAN_ALLOWED_PRODUCTS_NO)
                        {
                            //Checks duplicates::
                            $duplicate_entry = $this->Site_model->getcountRecods("SELECT * FROM  bt_products WHERE uid = '$user_id' AND title = '$title'");
                            
							
                            if(empty($duplicate_entry))
                            {
							
							$multi_imgname   = $_FILES['product_image']['name'];

							$multi_extension = explode('.', $multi_imgname);  

							$mimg_ext        = strtolower(end($multi_extension));

							
							$mimgpre       = 'PRODIMG'.rand(1000,9999);

							$image  = $mimgpre.time().".".$mimg_ext;

							 $mainImageNewName=$image;
							 
							 move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"assets/uploadedimages/".$image);
							
							move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"assets/multimage/".$image);
							
							$multiimg_dataArr = array(
                                            'img_url'     => $image,
                                            'uid'         => $user_id,
                                            'default_img' => 1,
                                        );
										
							 $upimagedata =$this->Site_model->add( "bt_product_images",$multiimg_dataArr);
							 
	                             $data=array(
									'uid'=>$user_id,
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
									'delivery_time'=>1,
									'payment_mode'=>'', 
									'qty_unit'=>$qty_unit,
									'other_mode'=>'', 
									'shipping_cost'=>'' , 
									'approved'=>'no',
									'new'=>'', 
									'image'=>$image,
									'origin'=>$origin,
									'material'=>$material,
									'function'=>$function,
									'brand_name'=>'',
									'quality'=>'',
									'cbrand_name'=>'',
									'model_number'=>$model_number,
									'color'=>$color,
									'type'=>$type,
									'featured'=>$features,
									'expireson'=>$expireson,
									'supplier_price'=>$maxwhole_sell_price,
									'min_price'=>$minproduct_price,
									'max_price'=>$maxproduct_price,
									'min_sell_price'=>$minwhole_sell_price,
									'max_sell_price'=>$maxwhole_sell_price,
									'admin_percent'=>$ADMIN_PERCENTAGE,
									'wholesale'=>$product_type 
									);
								//	print_r($data);exit;
                                   $res=$this->Site_model->add('bt_products',$data);
							$resArr['message']='Success';
							$resArr['statusCode'] = 200;
							$this->set_response ( $resArr, 200);  
							
							}
						else{
							$resArr['message']='Similar product exists';
							$resArr['statusCode'] = 422;
							$this->set_response ( $resArr, 422);
						}
						
						} else{
							$resArr['message']='Your membership prohibits more products.Please upgrade your membership plan';
							$resArr['statusCode'] = 422;
							$this->set_response ( $resArr, 422);
						}
                                
							
						 }
                    }
					
					 public function getUnits_get(){
	         $units= $this->Site_model->getTableData("bt_unit_master"); 
			 
			 if(empty($units)){
					
				   $resArr['message']="No units found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{ 
			 $unitsData=array();
				  foreach($units as $value){
					    $Data ['unit_name'] =$value['unit_name'];
						$Data ['unit_id'] = $value['unit_id'];
						
						$unitsData[]=$Data;
				  }
				   $resArr['statusCode'] = 200;
				   $resArr['units'] =$unitsData;
				   $this->set_response($resArr, 200);
 }	    
		  }
		  					 public function getCurrency_get(){
	         $currencyData= $this->Site_model->getcountRecods("Select * from bt_currencies where sbcur_status = '1'");

			 
			 if(empty($currencyData)){
					
				   $resArr['message']="No currency found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{ 
			 $currencies=array();
				  foreach($currencyData as $value){
					    $Data ['currency_name'] =$value['sbcur_name'];
						$Data ['currency_id'] = $value['sbcur_id'];
						
						$currencies[]=$Data;
				  }
				   $resArr['statusCode'] = 200;
				   $resArr['units'] =$currencies;
				   $this->set_response($resArr, 200);
 }	    
		  }
			 public function getCountry_get(){
              $getCountryDetails= $this->Site_model->getTableData( $table = "bt_countries");
			 if(empty($getCountryDetails)){
				   $resArr['message']="No country found";
				   $resArr['statusCode'] = 404;
				   $this->set_response ( $resArr, 404);	
				}else{ 
			 $countries=array();
				  foreach($getCountryDetails as $value){
					   $Data['country_id'] = $value['country_id'];
                       $Data ['country_name']= $value['country_name'];
						$countries[]=$Data;
				  }
				   $resArr['statusCode'] = 200;
				   $resArr['units'] =$countries;
				   $this->set_response($resArr, 200);
                  }	    
		  }
		  	 public function getSms_get(){
             $phone_number =$this->get('phone_number');
			if($phone_number=="") {
				$resArr['message']='Please pass phone a number';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}
			else {
			$addedphone=substr($phone_number,1);
			$check_phone =$this->Site_model->getDataById('bt_members',"phone='$phone_number' OR phone='$addedphone' OR mobile='$phone_number' OR mobile='$addedphone'");
			if(empty($check_phone)){
				$resArr['message']='Failed.User does not exist';
				$resArr['statusCode'] = 301;
				$this->set_response ( $resArr, 301);
			}else{
			$data=$this->random_sms(6);
			$insertData = array (       
				'smsfrom' =>'+254-741-403-640',
				'smsto' => $phone_number,
				'description' =>'Your verification code is'.' '.$data,
				'status' =>0,
				'user_id'=>$check_phone[0]['user_id']
			);
			$result = $this->Site_model->add( 'bt_sms', $insertData);
			$this->sendsms();
			
		   $resArr['statusCode'] =200;
		   $data=array ( 
				'smscode' =>$data,
				'user_id'=>$check_phone[0]['user_id']
		   );
		   $resArr['data'] =$data;
		   $this->set_response($resArr, 200);
			}
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
 
 
   public function random_sms($length){

	  	$random= "";

	  	srand((double)microtime()*1000000);

	  	//$char_list = "ABCDEFGHIJKLMNPQRSTUVWXYZ";

	 	// $char_list .= "abcdefghijklmnopqrstuvwxyz";

	  	$char_list .= "123456789";

	  	// Add the special characters to $char_list if needed



	  	for($i = 0; $i < $length; $i++) {    

	 	$random .= substr($char_list,(rand()%(strlen($char_list))), 1);  

	  	}  

	  	return $random;

	}
  		
 
   public function changePassword_post(){
	    $user_Id=$this->post( 'user_id' );
		$newpassword= $this->post( 'new_password' );

    if($user_Id=="") {
		$resArr['message']='Please pass user_Id';
		$resArr['statusCode'] = 301;
        $this->set_response ( $resArr, 301);
		
	}
	else if($newpassword=="") {
		$resArr['message']='Please pass new_password';
		$resArr['statusCode'] = 301;
        $this->set_response ( $resArr, 301);
		
	}
	 else{
		$where = "user_id='$user_Id'  AND status=1 ";
		$checkuser= $this->Site_model->getDataById( 'bt_sms', $where );
		$user_id=$checkuser[0]['user_id'];
		if(empty($checkuser)){
		$resArr['message']='Failed.Invalid SMS verification code';
		$resArr['statusCode'] = 301;
        $this->set_response ( $resArr, 301);
		} else{
			$updateData = array (       
				'password' =>md5($newpassword)	
			);
		$where = "user_id=$user_id";	  
		$res=$this->Site_model->update("bt_members",$updateData,$where);
		$resArr['message']='Success';
		$resArr['statusCode'] = 200;
		$this->set_response ( $resArr, 200);	
			}		
	
	}
  }
  public function getProductsPerMainCategories_get(){
		
		$categoryId = $this->get('parentId'); 
		$limit = $this->get('limit');
		if($categoryId==""){
		   $resArr['message']="Please submit parentId";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}
		else if($limit==""){
		   $resArr['message']="Please pass the limit";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}else{
				
                $sql="SELECT * FROM `bt_products` as `p` JOIN `bt_product_cats` as `pc` ON `p`.`id`=`pc`.`offer_id` 
				JOIN `bt_categories` as `c` ON `c`.`id` = `pc`.`cid` JOIN `bt_business` as `b` ON `b`.`user_id` = `p`.`uid` 
				WHERE `c`.`pid` = $categoryId LIMIT $limit";
				
				$productData= $this->Site_model->execute($sql);
				
				if(empty($productData)){
					
				   $resArr['message']="No records found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{
				foreach($productData as $value){
                $proData ['productname'] = $value['title'];
                $proData ['price'] = $value['price'];
                $proData ['discountPrice'] = 0;
                $proData ['description'] =$value['description'];
                $proData ['product_id'] = $value['id'];
				
				
			    $salepro_rate_info = $this->Site_model->getRowData('bt_ratings',"ratedto='".$value['id']."' AND type_rate='P'");
                $proData ['ratings'] =$salepro_rate_info[0]['rating'];
                $proData ['quantity_range'] ='';
                $proData ['qty'] =$value['qty_unit'];
                $proData ['min_qty'] = $value['min_order'];
                $proData ['product_category'] = '';
				if (in_array($value['id'], $buyData))
				  {
				 $proData ['product_type'] ="BuyOffer";
				  }
				else if (in_array($value['id'], $sellData))
				  {
				 $proData ['product_type'] ="SellOffer";
				  }
				  else if(in_array($value['id'], $hotSellingData)){
					 $proData ['product_type'] ="HotSelling";  
				  }
				else{
				$productType=array(
				1=>'Wholesale',
				0=>'Featured'
				);
				$proData ['product_type'] = $productType[$value['wholesale']];  
				  }
			
				$proData ['whole_sale_product'] = $value['wholesale'];
				
				$sql="SELECT img_url FROM bt_product_images WHERE offer_id='".$value['id']. "' ORDER BY id DESC";
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "' ");
				
			
				if(!empty($productImages)){
				$proimage=array();	
				foreach($productImages as $img){
					 if(file_exists('assets/multimage/'.$img['img_url'])){
					$productImageData['image_name']=base_url().'assets/multimage/'.$img['img_url'];
					 }else{
					$productImageData['image_name']=base_url().'assets/uploadedimages/'.$img['img_url'];	 
					 }
					$proimage[]=$productImageData;
				}
				}
				$proData ['productImages'] =array_unique($proimage);
				
				$productDetails['color']=$productData[0]['color'];
				$productDetails['Location']=$productData[0]['location'];
				$productDetails['Samples Available']=$productData[0]['samples_available'];
				$productDetails['New Product']=$productData[0]['new'];
				
				$proData ['productDetails'] = $productDetails;
				
				$productImages= $this->Site_model->getDataById("bt_product_images","offer_id='".$value['id']. "'");
				
				$where="user_id = '".$value['uid']."'";
                $business_details= $this->Site_model->getDataById( $table = "bt_business", $where );
				foreach($business_details as $biz){
				$companyDetails['company_name']=$biz['company_name'];
				$companyDetails['services']=$biz['services'];
				$companyDetails['image_name']=$biz['address1'];
				
				$proData['companyDetails']= $companyDetails;
				}
				
				$productinfo [] = $proData;
				}
			   $resArr['statusCode'] = 200;
			   $resArr['data'] =$productinfo;
			   $this->set_response($resArr, 200);
				}
	}
	}
	
	  public function getCouriersAvailable_post(){
		
		 $productId = $this->post('productId'); 
		 $country = $this->post('country'); 
		 $state = $this->post('state'); 
		 $city = $this->post('city'); 
		 $shippingmode = $this->post('mode'); 
		 $qty = $this->post('qty');
		 
		if($productId==""){
		   $resArr['message']="Please pass productId";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}
		else if($qty==""){
		   $resArr['message']="Please pass qty";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}
		else if($country==""){
			 $resArr['message']="Please pass country";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}
   else if($shippingmode==""){
			 $resArr['message']="Please pass shippingmode";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}		else{
					$qry=" SELECT uid,quality  FROM bt_products where id='$productId'";
					$supplierData=$this->Site_model->execute($qry);
					
					$whereord="user_id= '".$supplierData[0]['uid']."'";
					$suppliercontacts=$this->Site_model->getDataById( $table = "bt_members", $whereord);
					$sourceCountry=$suppliercontacts[0]['country'];
					$sourceState=$suppliercontacts[0]['state'];
					$sourcecity=$suppliercontacts[0]['city'];
					$weight=$supplierData[0]['quality'] *$qty;
					
				   $Query.="select bt_location_pricing.uid,bt_location_pricing.min_weight,bt_location_pricing.price,bt_location_pricing.dest_city,
				   bt_business.company_name from  bt_location_pricing JOIN bt_business ON bt_location_pricing.uid=bt_business.user_id 
				   where   bt_location_pricing.active=1 AND  
				   mode='".$shippingmode."' AND  `source`=".$sourceCountry." and destination=".$country." ";
 			
				 if(!empty($city) && !empty($sourcecity)&&!empty($sourceState) && !empty($state)){
					$Query.=" AND source_city='".$sourcecity."'  AND   dest_city ='".$city."'  AND  source_state='".$sourceState."'  AND   dest_state='".$state."' AND '".$weight."' 
					BETWEEN min_weight AND max_weight LIMIT 1";
				} else{
				 $Query.=" AND '".$weight."' BETWEEN min_weight AND max_weight";	
				}
				
				   $curierData= $this->Site_model->execute($Query);
				
				
				if(empty($curierData)){
					
				   $resArr['message']="Sorry,no couriers found";
				   $resArr['statusCode'] = 301;
				   $this->set_response ( $resArr, 301);	
				}else{
					$proData=array();
				 foreach($curierData as $info) {
                        $cudata['curier_id'] = $info['uid'];
                        $cudata['company_name']=$info['company_name'];
						$cudata['currency']='USD';
						$cudata['price']=$info['price'];
						$cudata['duration']=$info['duration'];
						$cudata['minweight_Kg']=$info['min_weight'];
						
						$dest_city=$info['dest_city'];
						$qry="select city_name  from  bt_cities  where `city_id`=".$dest_city."";
					    $dest_cityname=$this->Site_model->execute($qry);
						$cudata['destination']=$dest_cityname[0]['city_name'];
						$proData[]= $cudata;
				
				}
			   $resArr['statusCode'] = 200;
			   $resArr['data'] =$proData;
			   $this->set_response($resArr, 200);
				}
		}
	  }
	  
	  public function currencyConvertion_post(){
		   $currentCurrency = $this->post('currentCurrency');
		   $location= $this->post('location');
		 
		if($currentCurrency==""){
		   $resArr['message']="Please pass currentCurrency";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}
		else{
		}
	  }
   
   
     public function getuserlocation_post(){

		   $ipaddress = $this->post('ip_address');
		   
		if($ipaddress==""){
		   $resArr['message']="Please pass the ip_address";
		   $resArr['statusCode'] = 301;
		   $this->set_response ( $resArr, 301);	
		}
		else{
			$my_location_ip =$ipaddress;
			$content_url = "http://ipinfo.io/{$my_location_ip}/json";
			$getContents =$this->get_web_page_by_curl($content_url);
			
			$getContents_jsonData     = $getContents['content'];
			$my_location_details  = json_decode($getContents_jsonData);
			$my_location_country = $my_location_details->country;
			
		    $where="ISO2='$my_location_country'";
            $getCountryDetails= $this->Site_model->getDataById( $table = "bt_countries", $where );

			if(!empty($getCountryDetails)){
				$my_location_country_id = $getCountryDetails[0]['country_id'];
			}
		    $content =@file_get_contents("http://country.io/currency.json");
			$countryData= json_decode($content);

			if(!empty($getCountryDetails)){
			$location_data = array(
				'ip'      => $my_location_details->ip,
				'city'    => $my_location_details->city,
				'country_currency'    =>$countryData->$my_location_country,
				'region'  => $my_location_details->region,
				'country' => $my_location_country,
				'country_id' => $my_location_country_id,
				'loc'     => $my_location_details->loc,
				'org'     => $my_location_details->org,
			);
               $resArr['statusCode'] = 200;
			   $resArr['data'] =$location_data;
			   $this->set_response($resArr, 200);
			}
			else{
			   $resArr['statusCode'] = 301;
			   $resArr['data'] ='No data available';
			   $this->set_response($resArr, 301);	
			}
		}
	  }
  }
