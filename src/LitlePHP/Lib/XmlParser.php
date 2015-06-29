<?php
namespace LitlePHP\Lib;

class XmlParser
{
  public static function domParser($xml)
  {
    $doc = new \DOMDocument();
    $doc->loadXML($xml);
    return $doc;
  }

  public static function getNode(\DomDocument $dom, $elementName)
  {
    $elements = $dom->getElementsByTagName($elementName);
    $retVal = "";
    foreach($elements as $element)
    {
      $retVal = $element->nodeValue;
    }

    return $retVal;
  }

  public static function getAttribute(\DomDocument $dom, $elementName, $attributeName)
  {
    $attributes = $dom->getElementsByTagName($elementName)->item(0);
    $retVal = $attributes->getAttribute($attributeName);

    return $retVal;
  }

  public static function getDomDocumentAsString(\DomDocument $dom)
  {
    return $dom->saveXML($dom);
  }
}
