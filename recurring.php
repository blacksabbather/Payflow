<?php
session_start();
global $environment;
$environment = "sandbox";

require_once('PayflowNVPAPI.php');

echo '<p>Payflow direct credit card processing - basic demo</p>';
if(empty($_POST)) {

?>
<form method="post">
  Credit card: <input type="text" name="CREDITCARD" value="4720596131350454"/>
  <br/>Expiration date: <input type="text" name="EXPDATE" value="0422"/>
  <br/>Card security code: <input type="text" name="CVV2" value="077"/>
  <br/>First name: <input type="text" name="BILLTOFIRSTNAME" value="John"/>
  <br/>Last name: <input type="text" name="BILLTOLASTNAME" value="Doe"/>
  <br/>Address: <input type="text" name="BILLTOSTREET" value="123 Main St."/>
  <br/>City: <input type="text" name="BILLTOCITY" value="San Jose"/>
  <br/>State: <input type="text" name="BILLTOSTATE" value="CA"/>
  <br/>Zip: <input type="text" name="BILLTOZIP" value="95101"/>
  <br/>Country: <input type="text" name="BILLTOCOUNTRY" value="US"/>
  <br/><input type="submit" value="Pay Now"/>
</form>
<?php

} else {
  $request = array(
    "PARTNER" => "PayPal",
    "VENDOR" => "minjwang",
    "USER" => "minjwang",
    "PWD" => "abcd1234", 
    "TENDER" => "C",
    "ACTION" => "A",
    "TRXTYPE" => "R",
    "PROFILENAME" => "RegularSubscription",
    "CURRENCY" => "USD",
    "AMT" => "15",
    "START" => "03122020",
    "PAYPERIOD" => "DAYS",
    "TERM" => 30,

    "ACCT" => $_POST['CREDITCARD'],
    "EXPDATE" => $_POST['EXPDATE'],
    "CVV2" => $_POST['CVV2'],

    "BILLTOFIRSTNAME" => $_POST['BILLTOFIRSTNAME'],
    "BILLTOLASTNAME" => $_POST['BILLTOLASTNAME'],
    "BILLTOSTREET" => $_POST['BILLTOSTREET'],
    "BILLTOCITY" => $_POST['BILLTOCITY'],
    "BILLTOSTATE" => $_POST['BILLTOSTATE'],
    "BILLTOZIP" => $_POST['BILLTOZIP'],
    "BILLTOCOUNTRY" => $_POST['BILLTOCOUNTRY'],

  );

  //Run request and get the response
  $response = run_payflow_call($request);

  pre($request, "Request");
  pre($response, "Response");
}
