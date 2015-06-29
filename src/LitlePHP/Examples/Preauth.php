<?php
/**
 * Created by Sam.
 * At: 26/06/2015 20:10
 */
//If you're not using an autoloader
include_once("vendor/autoload.php");
//Username, Password, MerchantID, Prefix, Mode
//Prefix is added to the start of the transaction reference
//Mode is one of betacert, prelive, postlive, production, sandbox, transact_betacert, transact_prelive, transact_postlive, transact_production
$client = new \LitlePHP\LitleClient("", "", 0, "test", "sandbox");
//Card number, Expiry month, Expiry year, Card cvv
$card = new \LitlePHP\Structs\Card("5454545454545454", "12", "18", "123");
//Name, Address line 1, City, State, Zip, Country
//For US and CA, State MUST be a valid state code
//Country MUST be a valid country code
$billing = new \LitlePHP\Structs\Billing("A Developer", "1 Cherry Tree Lane", "London", "London", "LO123MP", "GB");
//Affiliate name, Campaign ID (appears in dashboard)
$merchant = new \LitlePHP\Structs\MerchantData("", "TEST");
//Card, Billing, Merchant, Amount
$response = $client->AuthCard($card, $billing, $merchant, "1.00");
/**
 * Response is a class of AuthResponse with the following methods:
 * getAmount()
 * getAuthCode()
 * getAVSResponse()
 * getCVVResponse()
 * getErrorCode()
 * getErrorString()
 * getReturnCode()
 * getReturnText()
 * getTransactionID()
 * getTransactionType()
 * wasAuthed()
 */
//Check if the preauth was successful
if($response->wasAuthed())
{
  echo "Successfully preauthed for " . $response->getAmount() . ", Transaction Reference is " . $response->getTransactionID() . "\n";
}
else
{
  echo "Failed to preauth for " . $response->getAmount() . ", Error is " . $response->getErrorString() . "\n";
}
