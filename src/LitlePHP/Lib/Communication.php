<?php
namespace LitlePHP\Lib;

class Communication
{
  public static function httpRequest($req, $hash_config = NULL)
  {
    $config = Obj2xml::getConfig($hash_config);

    if((int)$config['print_xml'])
    {
      echo $req;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_PROXY, $config['proxy']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
    curl_setopt($ch, CURLOPT_URL, $config['url']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $config['timeout']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    $output = curl_exec($ch);
    //$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if(!$output)
    {
      throw new \Exception(curl_error($ch));
    }
    else
    {
      curl_close($ch);
      if((int)$config['print_xml'])
      {
        echo $output;
      }

      return $output;
    }

  }
}
