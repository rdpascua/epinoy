<?php
date_default_timezone_set('Asia/Manila');
include('nuSoap/lib/nusoap.php');

class epinoyLoad{

  protected $host = "";
  protected $username = "";
  protected $password = "";
  protected $admin_username = "";

  public function __construct($username,$password,$admin_username = ""){

    $this->host = "https://connect.epinoyinc.com/soap/?wsdl";
    $this->username = $username;
    $this->password = $password;
    $this->admin_username = $admin_username;

  }

  public function getSession(){

    $client = new nusoap_client($this->host, true);
    $params = array(
    		'username'=>$this->username
    		);

    $result = $client->call('CreateSession', $params);

    return $result['sessionId'];
  }


  public function getBalance($session_id,$account_no=""){

    $client = new nusoap_client($this->host, true);
    $params = array(

    		'sessionId'=> $session_id,
        'username'=> $this->username,
        'password' => $this->password,
        'command' => 'GETWALLETBALANCE',
        'data'=>'<meta><accountNo>'.$account_no.'</accountNo></meta>'
    		 );

    $result = $client->call('Execute', $params);

    return $result;

  }

  public function loadTransact($session_id,$merchant_transaction_id,$date,$mobile_no,$sku){

    $client = new nusoap_client($this->host, true);
    $params = array(

    		'sessionId'=> $session_id,
        'username'=> $this->username,
        'password' => $this->password,
        'command' => 'TOPUP',
        'data'=>'<meta><merchantTransactionId>'.$merchant_transaction_id.'</merchantTransactionId><merchantDate>'.$date.'</merchantDate><mobileNo>'.$mobile_no.'</mobileNo><sku>'.$sku.'</sku></meta>'
    		 );

    $result = $client->call('Execute', $params);

    return $result;

  }

  public function getTransactionByMerchantID($session_id,$merchant_transaction_id){

    $client = new nusoap_client($this->host, true);
    $params = array(

    		'sessionId'=> $session_id,
        'username'=> $this->username,
        'password' => $this->password,
        'command' => 'GETTRANSDETAILSBYMERCHANTID',
        'data'=>'<meta><merchantTransactionId>'.$merchant_transaction_id.'</merchantTransactionId></meta>'
    		 );

    $result = $client->call('Execute', $params);

    return $result;

  }

  public function getTransactionDetails($session_id,$transact_id){

    $client = new nusoap_client($this->host, true);
    $params = array(
            		'sessionId'=> $session_id,
                    'username'=> $this->username,
                    'password' => $this->password,
                    'command' => 'GETTRANSDETAILS',
                    'data'=>'<meta><transactionId>'.$transact_id.'</transactionId></meta>'
    		 );

    $result = $client->call('Execute', $params);

    return $result;

  }

  public function getSkuList($session_id){

    $client = new nusoap_client($this->host, true);
    $params = array(
        		'sessionId'=> $session_id,
                'username'=> $this->username,
                'password' => $this->password,
                'command' => 'LISTSKUS',
                'data'=>'<?xml version="1.0" ?><meta><username>'.$this->admin_username.'</username></meta>'
    		 );

    $result = $client->call('Execute', $params);

    return $result;

  }

}





?>
