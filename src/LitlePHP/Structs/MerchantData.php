<?php
/**
 * Created by Sam.
 * At: 26/06/2015 19:32
 */
namespace LitlePHP\Structs;

class MerchantData
{
  private $_affiliateName;
  private $_campaignName;

  public function __construct($affiliate, $campaign)
  {
    $this->_affiliateName = substr($affiliate, 0, 25);
    $this->_campaignName = substr($campaign, 0, 25);
  }

  public function getAffiliateName()
  {
    return $this->_affiliateName;
  }

  public function getCampaignName()
  {
    return $this->_campaignName;
  }
}
