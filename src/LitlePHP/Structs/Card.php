<?php
/**
 * Created by Sam.
 * At: 26/06/2015 18:43
 */
namespace LitlePHP\Structs;

class Card
{
  private $_cardNumber;
  private $_cardExpiryMonth;
  private $_cardExpiryYear;
  private $_cvv;

  public function __construct($number, $expiryMonth, $expiryYear, $cvv)
  {
    $this->_cardNumber = $number;
    $this->_cardExpiryMonth = str_pad($expiryMonth, 2, "0", STR_PAD_LEFT);
    $this->_cardExpiryYear = substr($expiryYear, -2);
  }

  public function getCardNumber()
  {
    return $this->_cardNumber;
  }

  public function getCardExpiryMonth()
  {
    return $this->_cardExpiryMonth;
  }

  public function getCardExpiryYear()
  {
    return $this->_cardExpiryYear;
  }

  public function getCVV()
  {
    return $this->_cvv;
  }
}
