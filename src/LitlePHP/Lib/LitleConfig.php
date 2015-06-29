<?php
/**
 * Created by Sam.
 * At: 29/06/2015 13:35
 */
namespace LitlePHP\Lib;

class LitleConfig
{
  public $batch_requests_path = "";
  public $batch_url = "";
  public $litle_requests_path = "";
  public $merchantId;
  public $password;
  public $print_xml = 0;
  public $proxy =  "";
  public $reportGroup = "Default Report Group";
  public $sftp_password = "";
	public $sftp_username = "";
	public $tcp_port = "";
  public $tcp_ssl = 1;
  public $tcp_timeout = "";
	public $timeout =  65;
  public $url;
  public $user;
	public $version = "";

  public function __construct()
  {
    $this->version = LitleConstants::$CURRENT_XML_VERSION;
  }

  public function getAsArray()
  {
    $config = array();
    foreach(explode(",", LitleConstants::$LITLE_CONFIG_LIST) as $requiredConfig)
    {
      $config[$requiredConfig] = $this->$requiredConfig;
    }
    return $config;
  }

  public function mergeIn(array $config)
  {
    foreach($config as $key => $value)
    {
      $this->$key = $value;
    }
  }

  public function validate()
  {
    foreach(explode(",", LitleConstants::$LITLE_CONFIG_LIST) as $requiredConfig)
    {
      if(!isset($this->$requiredConfig))
      {
        echo "$requiredConfig is missing\n";
        return false;
      }
    }
    return true;
  }
}
