<?php
if(isset($_POST['submit'])){
    date_default_timezone_get('Africa/Nairobi');

    /*Access tokens */
    $consumerKey = 'MuiQJf5xtl5IHehCQNvDh8qwMhDM5ZFv';
    $consumerSecret = 'QwMov3CMEV4WGIb4';

    $BusinessShortCode = '174379';
    $PassKey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';


    $PartyA = $_POST['phone'];
    $AccountReference = '2255';
    $TransactionCost = 'Test payment';
    $Amount = $_POST['amount'];

    #timestamp in <y>
    $Timestamp = date('YmdHis');

    /*get base64 encoded pass */
    $Password = base64_encode($BusinessShortCode, $PassKey, $Timestamp);

    /*Header for acces token */
    $headers = ['Content-Type:application/json; charset-utf8'];

    #Mpesa endpoint 
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    #callback url
    $Callback_url = 'https://secret-everglades-18228.herokuapp.com/callbackurl.php';

    $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;  
  curl_close($curl);

  # header for stk push
  $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

  # initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $Callback_url,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);

  echo $curl_response;

}