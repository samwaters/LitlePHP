<?php
namespace LitlePHP\Lib;

class LitleXmlMapper
{
  public function __construct()
  {
  }

  public function request($request, $hash_config = NULL, $useSimpleXml)
  {
    $response = Communication::httpRequest($request, $hash_config);
    if($useSimpleXml)
    {
      $respObj = simplexml_load_string($response);
    } else
    {
      $respObj = XmlParser::domParser($response);
    }
    return $respObj;
  }

}
