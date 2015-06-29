<?php
/**
 * Created by Sam.
 * At: 26/06/2015 18:48
 */
namespace LitlePHP\Structs;

class Billing
{
  private $_name;
  private $_address;
  private $_city;
  private $_state;
  private $_zip;
  private $_country;

  public function __construct($name, $address, $city, $state, $zip, $country)
  {
    $this->_name = $name;
    $this->_address = $address;
    $this->_city = $city;
    $this->_state = $state;
    $this->_zip = $zip;
    $this->_country = $country;
  }

  public function getName()
  {
    return $this->_name;
  }

  public function getAddress()
  {
    return $this->_address;
  }

  public function getCity()
  {
    return $this->_city;
  }

  public function getState()
  {
    return $this->_state;
  }

  public function getZip()
  {
    return $this->_zip;
  }

  public function getCountry()
  {
    return $this->_country;
  }
}
