<?php
namespace LitlePHP\Lib;

class Checker
{
  public static function requiredField($value)
  {
    if($value != null)
    {
      return $value;
    }
    else
    {
      return "REQUIRED";
    }
  }

  public static function choice($choiceArray)
  {
    $i = 0;
    for($y = 0; $y < count($choiceArray); $y++)
    {
      if(isset($choiceArray[$y]))
      {
        $i++;
      }
    }
    if($i > 1)
    {
      throw new \InvalidArgumentException("Entered an Invalid Amount of Choices for a Field, please only fill out one Choice!!!!");
    }
  }
}
