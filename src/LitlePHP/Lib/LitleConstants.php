<?php
namespace LitlePHP\Lib;

class LitleConstants
{
  public static $CURRENT_XML_VERSION = "8.24";
  public static $CURRENT_SDK_VERSION = "PHP;8.24.0";
  public static $MAX_TXNS_PER_BATCH = 100000;
  public static $MAX_TXNS_PER_REQUEST = 500000;
  public static $LITLE_CONFIG_LIST = "user,password,merchantId,timeout,proxy,reportGroup,version,url,litle_requests_path,batch_requests_path,sftp_username,sftp_password,batch_url,tcp_port,tcp_ssl,tcp_timeout,print_xml";
}
