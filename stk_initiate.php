<?php
if(isset($_POST['submit'])){
    date_default_timezone_get('Africa/Nairobi');

    /*Access tokens */
    $consumerKey = 'MuiQJf5xtl5IHehCQNvDh8qwMhDM5ZFv';
    $consumerSecret = 'QwMov3CMEV4WGIb4';

    $BusinessShortCode = '174379';
    $PassKey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';


    $Partyb = $_POST['phone'];
    $AccountReference = '2255';
    $TransactionCost = 'Test payment';
    $Amount = $_POST['amount'];

    


}