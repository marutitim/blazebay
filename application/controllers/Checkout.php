<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller
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
        // load the pdo for db connection
        $this->pdo = $this->load->database ( 'pdo', true );
		$this->load->helper ( 'form' );
        $this->load->library ( 'session' );
		$this->load->model('Site_model');
        $this->load->library('upload');

	
    }
  	    public function gen_uuid() {
                return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
                );
            }
			
			public function payViaNunurEwallet() {
				$userPhone=$_POST['phone'];
				$transactionamount=$_POST['amount'] * 102;
				$invoicenumber=$_POST['invoice'];
                mb_internal_encoding('utf-8');
				
		        $fnEnc = new EncryptionHelper();
                $iv = str_pad($timeStamp, 16, ")(", STR_PAD_RIGHT);
                $appId = 7;
                $apikey = 'K@##86H87PUF#M/^';
                $timeStamp = date("YmdHis", time());
                $s = $appId . $apikey . $timeStamp;
                $trxPass = base64_encode(hash('sha256', $s));
                $trxCallID = $this->gen_uuid();
                $userPhone = $fnEnc->encrypt($userPhone, $apikey, $iv);
                $transactionamount = $fnEnc->encrypt($transactionamount, $apikey, $iv);
                $invoicenumber = $fnEnc->encrypt($invoicenumber, $apikey, $iv);

                $param = array('appId' => $appId,
                    'trxPass' => $trxPass,
                    'timeStamp' => $timeStamp,
                    'trxCallID' => $trxCallID,
                    'userPhone' => $userPhone,
                    'transactionamount' => $transactionamount,
                    'invoicenumber' => $invoicenumber
                );

                $client = new nusoap_client(WSDL1);
                $client->useHTTPPersistentConnection();
                $soapaction = "nnr:mobileUser/UserAccountWS/payViaNunurEwalletRequest";
                $request_xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:nnr="nnr:mobileUser">
						<soapenv:Header/>
						<soapenv:Body>
						<nnr:payViaNunurEwallet>
						<appId>' . $appId . '</appId>
						<trxPass>' . $trxPass . '</trxPass>
						<timeStamp>' . $timeStamp . '</timeStamp>
						<trxCallID>' . $trxCallID . '</trxCallID>					
						<userPhone>' . $userPhone . '</userPhone>
						<amount>' . $transactionamount . '</amount>
						<invoiceNumber>' . $invoicenumber . '</invoiceNumber>			
						</nnr:payViaNunurEwallet>
						</soapenv:Body>
						</soapenv:Envelope>
						';
                $result = $client->send($request_xml, $soapaction, '');
                $err = $client->getError();
				
				   
					 if($result['resCode']==43){
					$data=array(
				        'msg'=>$result['resMsg']
				        );	 
					 }else{
						//$this->processMakeanOrder();
					 }
                //echo json_encode($err);
				echo 0;
            }
	
	public function testencrypt() {
				$userPhone='254721729931';
				$transactionamount='1';
				$invoicenumber='123Testtransa';
				$password='123456';
				 mb_internal_encoding('utf-8');
				
		        $fnEnc = new EncryptionHelper();
                $iv = str_pad($timeStamp, 16, ")(", STR_PAD_RIGHT);
                $appId = 7;
                $apikey = 'K@##86H87PUF#M/^';
                $timeStamp = date("YmdHis", time());
                $s = $appId . $apikey . $timeStamp;
                $trxPass = base64_encode(hash('sha256', $s));
                $trxCallID = $this->gen_uuid();
                $userPhone = $fnEnc->encrypt($userPhone, $apikey, $iv);
                $transactionamount = $fnEnc->encrypt($transactionamount, $apikey, $iv);
                $invoicenumber = $fnEnc->encrypt($invoicenumber, $apikey, $iv);
                $pwd = $fnEnc->encrypt($password, $apikey, $iv);
				echo 'Appid=>'.$appId.'<br>';
				echo 'apikey=>'.$apikey.'<br>';
				echo 'timeStamp=>'.$timeStamp.'<br>';
				echo 'trxPass=>'.$trxPass.'<br>';
				echo 'trxCallID=>'.$trxCallID.'<br>';
				echo 'userPhone=>'.$userPhone.'<br>';
				echo 'transactionamount=>'.$transactionamount.'<br>';
				echo 'invoicenumber=>'.$invoicenumber.'<br>';
				echo 'password=>'.$pwd.'<br>';
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

  public function validateMpesa(){
	 $mpesacode=$_POST['mpesacode'];
	 $MpesaAccount=$_POST['MpesaAccount'];
	 $paymentAmount=$_POST['paymentAmount'];
	 $shippingPerson=$_POST['shipping'];
	 $shippingamount=$_POST['shippingamount'];
	 $firstname=$_POST['first-name'];
	 $lastname=$_POST['last-name'];
	 $city=$_POST['city'];
	 $state=$_POST['state'];
	 $email=$_POST['email'];
	 $address=$_POST['address'];
	 $address=$_POST['zip'];
	 $country=$_POST['country'];
	 $phone_number=$_POST['phone-number'];
	 $qty=$_POST['qty'];
	 $customercolor=$_POST['customercolor'];
	 $customersize=$_POST['customersize'];
         $zip=$_POST['zip'];
	 $customised='Color:'.$customercolor.'Size:'.$customersize;
	 
	 $where="mpesa_code='$mpesacode'  AND mpesa_acc='$MpesaAccount' AND mpesa_amt >='$paymentAmount' ";
	 $mpesaVerification=$this->Site_model->getDataById("bt_mpesa_transactions",$where);



	if(!empty($mpesaVerification)){
		$this->processMakeanOrder("mpesa",$shippingPerson,$shippingamount,$firstname,$lastname,$email,$address,$zip,
            $city,$state,$country,$phone_number,$qty,$customised);
	}else{
		echo 0;
	}
  }
		
		public function processMakeanOrder($paymode=null,$shippingPerson=null,$shippingamount=null,$firstname=null,$lastname=null,$email=null,$address=null,$zip=null,$city=null,$state=null,$country=null,$phone_number=null,$qty=null,$customised=null){
		
		if(!isset($this->session->userdata['logged_in']['user_id'])){
			
			header('location:'.base_url().'login');
			}
			else{


				//order details
		$productId=$_POST['productId'];	
		$qty=$qty?$qty:$_POST['qty'];
		$shippingPerson=$shippingPerson?$shippingPerson:$_POST['shipping'];
		$shippingamount=$_POST['shippingamount'];
		$productprice=$_POST['productprice'];
		$productcurrency=$_POST['productcurrency'];
		$totalproductprice=$_POST['totalproductprice'];
		$totalAmount=$_POST['totalAmount'];
		$transactId=$_POST['transactId'];
		$paymode=$_POST['paymode'];
        $phone_number=$_POST['phone-number'];
        $email=$_POST['email'];

		
	
		 $where="user_id='".$this->session->userdata['logged_in']['user_id']."'";
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
        'customer_id'		=> $this->session->userdata['logged_in']['user_id'],
        'currency'			=> $productcurrency,
        'shipping_firstname' =>$firstname? $firstname:$mem["firstname"],
        'shipping_lastname'  => $lastname? $lastname:$mem["lastname"],
        'shipping_address_1' => $address? $address:$mem['zip'],
        'shipping_address_2' => $zip? $zip:$mem['zip'],
        'shipping_city'      =>$city? $city:$mem["city"],
        'shipping_postcode'  => $address? $address: $_POST['shipping_postcode'],
        'shipping_state'     =>$state? $state: $_POST['shipping_state'],
        'shipping_state_id'  => $_POST['shipping_state_id'],
        'shipping_country'   =>$country?$country:$mem["country"],
        'shipping_country_id'=> $mem["country"],
		'shipping_phone'=>$phone_number,
        'shipping_zone'      => "",
        'shipping_zone_id'   => "",
        'shipping_address_format' => "",
        'shipping_method'    => "",
		'buyer_status'=>'2',
        'comments'           =>$customised?$customised:'Express order',
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

                'notify_sender_id' =>$this->session->userdata['logged_in']['user_id'],

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

                'notify_receiver_id' =>$this->session->userdata['logged_in']['user_id'],

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

                'receiver' =>$email,

                'subject' =>'New Order for'.' '.$product_name.'',

                'message' => $this->orderMails($order_number),

                'status' =>0
                );
             $this->Site_model->add("bt_emails", $orderDetails);

               // print_r($orderDetails);exit;

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

                'receiver' => $courier_data[0]['email']?$courier_data[0]['email']:$email,

                'subject' =>'New Order shipment for'.' '.$product_name.'',

                'message' => $this->courierOrderMail($order_number),

                'status' =>0
                );

               // print_r($orderDetails);exit;
             $this->Site_model->add("bt_emails", $orderDetails);
 
	}
		//blazebayOrdermail();
		$msg =$order_number;

     echo  $msg;
	
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

         $unitprice=$orderProductData[0]['price'];
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

	}
?>