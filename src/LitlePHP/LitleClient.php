<?php
/**
 * Created by sam
 * At: 01/09/2014 17:37
 */
namespace LitlePHP;

use LitlePHP\Exceptions\AuthException;
use LitlePHP\Helpers\LitleHelper;
use LitlePHP\Lib\LitleOnlineRequest;
use LitlePHP\Lib\XmlParser;
use LitlePHP\Responses\AuthResponse;
use LitlePHP\Structs\Billing;
use LitlePHP\Structs\Card;
use LitlePHP\Structs\MerchantData;

class LitleClient
{
  private $_username;
  private $_password;
  private $_mid;
  private $_mode;
  private $_referencePrefix;

  public function __construct($username, $password, $mid, $prefix, $mode = "live")
  {
    $this->_username = $username;
    $this->_password = $password;
    $this->_mid = $mid;
    $this->_referencePrefix = $prefix;
    $this->_mode = $mode;
  }

  public function setLoginDetails($username, $password)
  {
    $this->_username = $username;
    $this->_password = $password;
  }

  public function setMID($mid)
  {
    $this->_mid = $mid;
  }

  public function setMode($mode)
  {
    $this->_mode = $mode;
  }

  public function RefundCard($original_transaction, $amount, $card_no, $reason, $params)
  {
    //Not implemented
  }

  public function VoidTransaction($txn_id, $params)
  {
    //Not implemented
  }

  public function ChargeCard(Card $card, $amount, $params)
  {
    //Not implemented
  }

  public function AuthCard(Card $card, Billing $billing, MerchantData $merchant, $amount)
  {
    $amount *= 100; //11850 rather than 118.50, 1034 rather than 10.34
    $reference = $this->generateReference();
    $auth_info = array(
      "orderId" => $reference,
      "amount" => $amount,
      "id" => $reference,
      "orderSource" => "ecommerce",
      "billToAddress" => array(
        "name" => $billing->getName(),
        "addressLine1" => $billing->getAddress(),
        "city" => $billing->getCity(),
        "state" => $billing->getState(),
        "zip" => $billing->getZip(),
        "country" => $billing->getCountry()
      ),
      "card" => array(
        "number" => $card->getCardNumber(),
        "expDate" => $card->getCardExpiryMonth() . $card->getCardExpiryYear(),
        "cardValidationNum" => $card->getCVV(),
        "type" => LitleHelper::cardTypeFromNumber($card->getCardNumber())
      ),
      "merchantData" => array(
        "affiliate" => $merchant->getAffiliateName(),
        "campaign" => $merchant->getCampaignName()
      )
    );
    $request = new LitleOnlineRequest();
    $request->setConfig($this->_username, $this->_password, $this->_mid, $this->_mode);
    $response = $request->authorizationRequest($auth_info);
    /**
     * @var \DomElement $rootNode
     */
    $rootNode = $response->getElementsByTagName("litleOnlineResponse")->item(0);
    $gatewayResponse = new AuthResponse(XmlParser::getNode($response, "message") == "Approved", $amount);
    $gatewayResponse->setAuthDetails(
      XmlParser::getNode($response, "authCode"),
      LitleHelper::convertLitleAVS(XmlParser::getNode($response, "avsResult")),
      XmlParser::getNode($response, "cardValidationResult")
    );
    if(!$gatewayResponse->wasAuthed())
    {
      $gatewayResponse->setErrorDetails(
        XmlParser::getNode($response, "response"),
        XmlParser::getNode($response, "message"),
        $rootNode->getAttribute("message")
      );
    }
    else
    {
      $gatewayResponse->setErrorDetails(XmlParser::getNode($response, "response"), "", "");
    }
    $gatewayResponse->setReturnDetails(
      $reference,
      XmlParser::getNode($response, "message"),
      $rootNode->getAttribute("message")
    );
    $gatewayResponse->setTransactionID(XmlParser::getNode($response, "litleTxnId"));

    if(!$gatewayResponse->wasAuthed())
    {
      $acceptable_errors = array(
        "Do Not Honor",
        "Decline CVV2/CID Fail",
        "Insufficient Funds",
        "Generic Decline",
        "Restricted Card",
        "Lost/Stolen Card",
        "Pick Up Card",
        "Invalid Account Number",
        "Cardholder transaction not permitted",
        "No such issuer",
        "Invalid Transaction",
        "Expired Card"
      );
      if(!in_array($gatewayResponse->getErrorString(), $acceptable_errors))
      {
        throw new AuthException("Litle Gateway Failed: " . $gatewayResponse->getErrorString());
      }
    }
    return $gatewayResponse;
  }

  public function generateReference()
  {
    return $this->_referencePrefix . "-" . time();
  }

} 
