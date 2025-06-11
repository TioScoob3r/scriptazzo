<?php
namespace App\Lib\CreditCard\Banks;

/**
 * 
 */
class CreditCardPagSeguro extends AnotherClass
{
	private $publicKey = "";
    private $privateKey = "";
    private $gateway = null;
    
    public function __construct($gateway) {
        if ($gateway == null) {
            throw new \Exception("É necessário informar o gateway válido.");
        }
        $this->gateway = $gateway;
    }
}