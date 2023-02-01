<?php
namespace App\Mylib;

class Apirone {

    protected $ACCOUNT="apr-981e90565fff83a804edb75e4b71a897";
    protected $TRANSFER_KEY="Cvl1odzHLRHuQcnhKkfGUkwzKk9oMoCm";
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($account="", $transferKey="")
    {
        $this->ACCOUNT=$account;
        $this->TRANSFER_KEY=$transferKey;
        date_default_timezone_set("Asia/Seoul");

    }
    //create a new account
    public function createAccount(){
        $method = "POST";
        $url = "https://apirone.com/api/v2/accounts";


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        //echo($httpcode);

        //echo($result);
        return $result;
    }

    //generate address using account
    public function generateAddressByAccount($coinType="BTC", $genId = 0){
        $method = "POST";
        $url = "https://apirone.com/api/v2/accounts/{$this->ACCOUNT}/addresses";

        $req_arr=array();
        $req_arr['currency']= strtolower($coinType);
        $req_arr['callback'] = array(
            'method' => "POST",
            'url' => 'http://example.com/callback',
            'data' => array(
                'id' => $genId
            )
        );
       

        $req=json_encode($req_arr);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        curl_setopt($curl, CURLOPT_POSTFIELDS, $req);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return array('status'=>$httpcode, 'data'=>json_decode($result));
    }
    // exchange rate
    public function getExchangeRate($coinType="BTC"){
        $method = "GET";
        $url = "https://apirone.com/api/v2/ticker?currency=".strtolower($coinType);

        
       
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return array('status'=>$httpcode, 'data'=>json_decode($result));
    }

    //
    public function createWallet(){
        date_default_timezone_set("GMT+0");
        $method = "POST";
        $url = "https://apirone.com/api/v2/wallets";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        
        return $result;
    }
}