<?php
/**
 * Created by Sam.
 * At: 26/06/2015 18:54
 */
namespace LitlePHP\Responses;

class AuthResponse
{
  private $_amount;
  private $_authCode;
  private $_avsResponse;
  private $_cvvResponse;
  private $_errorCode;
  private $_errorString;
  private $_returnCode;
  private $_returnText;
  private $_transactionId;
  private $_transactionType = "AuthCard";
  private $_wasAuthed;

  public function __construct($wasAuthed, $amount)
  {
    $this->_wasAuthed = $wasAuthed;
    $this->_amount = $amount;
  }

  public function getAmount()
  {
    return $this->_amount;
  }

  public function getAuthCode()
  {
    return $this->_authCode;
  }

  public function getAVSResponse()
  {
    return $this->_avsResponse;
  }

  public function getCVVResponse()
  {
    return $this->_cvvResponse;
  }

  public function setAuthDetails($authCode, $avs, $cvv)
  {
    $this->_authCode = $authCode;
    $this->_avsResponse = $avs;
    $this->_cvvResponse = ($cvv != null && $cvv != "") ? $cvv : 3;
  }

  public function getErrorCode()
  {
    return $this->_errorCode;
  }

  public function getErrorString()
  {
    return $this->_errorString;
  }

  public function setErrorDetails($code, $string1, $string2)
  {
    $this->_errorCode = $code;
    $this->_errorString = $string1 != "" ? $string1 : "";
    if($string2 != "")
    {
      $this->_errorString .= ($this->_errorString != "") ? ", $string2" : $string2;
    }
  }

  public function getReturnCode()
  {
    return $this->_returnCode;
  }

  public function getReturnText()
  {
    return $this->_returnText;
  }

  public function setReturnDetails($code, $text1, $text2)
  {
    $this->_returnCode = $code;
    $this->_returnText = $text1 != "" ? $text1 : "";
    if($text2 != "")
    {
      $this->_returnText .= ($this->_returnText != "") ? ", $text2" : $text2;
    }
  }

  public function getTransactionID()
  {
    return $this->_transactionId;
  }

  public function setTransactionID($id)
  {
    $this->_transactionId = $id;
  }

  public function getTransactionType()
  {
    return $this->_transactionType;
  }

  public function wasAuthed()
  {
    return $this->_wasAuthed;
  }
}
