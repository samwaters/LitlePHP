<?php
/**
 * Created by Sam.
 * At: 26/06/2015 17:56
 */
namespace LitlePHP\Helpers;

class LitleHelper
{
  public static function cardTypeFromNumber($card_number)
  {
    /*
     * According to the API, "" should work for undefined, but it doesn't seem to
     * Type           Prefix          Length
     * AMEX           34, 37          15
     * CarteBlanche   38              14 (UNSUPPORTED!)
     * Diners Club    300-305, 36     14
     * Discover       6011            16
     * EnRoute        2014,2149       15 (UNSUPPORTED!)
     * JCB            3, 2131, 1800   15,16
     * MC             51-55           16
     * Visa           4               13,16
     */
    $card_number = preg_replace("/[^\d]/", "", $card_number);
    if(strlen($card_number) < 13 || strlen($card_number) > 16)
    {
      return "";
    }
    $prefix1 = substr($card_number, 0, 1);
    $prefix2 = substr($card_number, 0, 2);
    $prefix3 = substr($card_number, 0, 3);
    $prefix4 = substr($card_number, 0, 4);
    if($prefix2 == "34" || $prefix2 == "37")
    {
      return "AX";
    }
    if(($prefix3 >= "300" && $prefix3 <= "305") || $prefix2 == "36")
    {
      return "DC";
    }
    if($prefix4 == "6011")
    {
      return "DI";
    }
    if($prefix1 == "3" || $prefix4 == "2131" || $prefix4 == "1800")
    {
      return "JC";
    }
    if($prefix2 >= "51" && $prefix2 <= "55")
    {
      return "MC";
    }
    if($prefix1 == "4")
    {
      return "VI";
    }
    return "";
  }

  public static function convertLitleAVS($avs)
  {
    //Convert Litle's AVS responses to standard ones
    switch($avs)
    {
      case "00":
      case "01":
      case "02":
        return "D";
      case "10":
        return "Z";
      case "11":
        return "W";
      case "12":
      case "13":
        return "A";
      case "14":
        return "P";
      case "20":
        return "C";
      case "30":
        return "1";
      case "31":
        return "R";
      case "32":
        return "1";
      case "33":
        return "R";
      case "34":
        return "I";
      case "40":
        return "4";
      default:
        return "2";
    }
  }
}
