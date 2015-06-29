<?php
namespace LitlePHP\Lib;

class UrlMapper
{
  const POSTLIVE = "postlive";
  const BETACERT = "betacert";
  const SANDBOX = "sandbox";
  const PRODUCTION = "production";
  const TRANSACT_PRODUCTION = "transact_production";
  const TRANSACT_PRELIVE = "transact_prelive";
  const TRANSACT_POSTLIVE = "transact_postlive";
  const TRANSACT_BETACERT = "transact_betacert";
  const PRELIVE = "prelive";

  public static function getUrl($litleEnv)
  {
    $litleOnlineCtx = 'vap/communicator/online';
    if($litleEnv == UrlMapper::SANDBOX)
    {
      return 'https://www.testlitle.com/sandbox/communicator/online';
    }
    elseif($litleEnv == UrlMapper::POSTLIVE)
    {
      return 'https://postlive.litle.com/' . $litleOnlineCtx;
    }
    elseif($litleEnv == UrlMapper::BETACERT)
    {
      return 'https://betacert.litle.com/' . $litleOnlineCtx;
    }
    elseif($litleEnv == UrlMapper::PRODUCTION)
    {
      return 'https://payments.litle.com/' . $litleOnlineCtx;
    }
    elseif($litleEnv == UrlMapper::TRANSACT_PRODUCTION)
    {
      return 'https://transact.litle.com/' . $litleOnlineCtx;
    }
    elseif($litleEnv == UrlMapper::TRANSACT_PRELIVE)
    {
      return 'https://transact-prelive.litle.com/' . $litleOnlineCtx;
    }
    elseif($litleEnv == UrlMapper::TRANSACT_POSTLIVE)
    {
      return 'https://transact-postlive.litle.com/' . $litleOnlineCtx;
    }
    elseif($litleEnv == UrlMapper::TRANSACT_BETACERT)
    {
      return 'https://transact-betacert.litle.com/' . $litleOnlineCtx;
    }
    elseif($litleEnv == UrlMapper::PRELIVE)
    {
      return 'https://prelive.litle.com/' . $litleOnlineCtx;
    }
    else
    {
      return 'https://www.testlitle.com/sandbox/communicator/online';
    }
  }
}
