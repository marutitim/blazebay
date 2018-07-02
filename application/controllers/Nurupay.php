<?php

class Nurupay extends CI_Controller {
 function __construct() {
        parent::__construct ();
        // load the pdo for db connection
        $this->pdo = $this->load->database ( 'pdo', true );
		$this->load->helper ( 'form' );
        $this->load->library ( 'session' );
		$this->load->model('Site_model');
        $this->load->library('upload');
        include ('application/libraries/phpmailer/sendEmail.php');
		include ('application/libraries/nusoap/nusoap.php');
		include ('application/libraries/nusoap/EncryptionHelper.php');
    }
	
	
	  public function gen_uuid() {
                return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
                );
            }
			public function payViaNunurEwallet() {
				$userPhone=0731729931;
				echo 'password=>'.$userPhone;
				exit;
				$transactionamount=1;
				$invoicenumber='123Testtransa';
				$password=123456;
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
				echo 'Appid=>'.$appId;
				echo 'apikey=>'.$apikey;
				echo 'Appid=>'.$appId;
				echo 'timeStamp=>'.$timeStamp;
				echo 'trxPass=>'.$trxPass;
				echo 'trxCallID=>'.$trxCallID;
				echo 'userPhone=>'.$userPhone;
				echo 'transactionamount=>'.$transactionamount;
				echo 'invoicenumber=>'.$invoicenumber;
				echo 'password=>'.$password;
				exit;
				
				
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
				$data=array(
				'msg'=>$result['resMsg']
				);
                echo json_encode($data);
            }
	}