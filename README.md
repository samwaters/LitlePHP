# LitlePHP
PHP Client for Litle API

##Supported API calls
* Preauth

##Requirements
* PHP 5.3+
* Composer

##Libraries included
* phpseclib (dev-master)

##Pulling in the library
###With Composer
`require samwaters/litlephp dev-master`
###Without Composer
`include "vendor/autoload.php";`

##Usage
**See Examples/Preauth.php for a detailed example**  
<code>
$client = new \LitlePHP\LitleClient("", "", 0, "test", "sandbox");  
$card = new \LitlePHP\Structs\Card("5454545454545454", "12", "18", "123");  
$billing = new \LitlePHP\Structs\Billing("A Developer", "1 Cherry Tree Lane", "London", "London", "LO123MP", "GB");  
$merchant = new \LitlePHP\Structs\MerchantData("", "TEST");  
$response = $client->AuthCard($card, $billing, $merchant, "1.00");
</code>

