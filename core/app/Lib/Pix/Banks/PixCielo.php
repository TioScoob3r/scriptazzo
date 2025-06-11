<?php

namespace App\Lib\Pix\Banks;

use App\Lib\Pix\Interfaces\IPix;

class PixCielo implements IPix{
  private $private_key = '';
  private $public_key = '';
  private $sandbox = false;

  public function __construct($merchant_id, $merchant_key, $isSandbox = false) {
      $this->private_key = $merchant_id;
      $this->public_key = $merchant_key;
      $this->sandbox = $isSandbox;
  }
  
  private function getMerchantId() {
      return $this->merchant_id;
  }
  
  private function getMerchantKey() {
      return $this->merchant_key;
  }
  
  public function setSandbox($isSandbox) {
      $this->sandbox = $isSandbox;
  }

  public function criarCobranca($user, $value, $key = null, $description = null) {
  }
  
  public function criarCobrancaQrCode(array $user, $value, $key = null, $description = null, $inv = null)
  {
    // return 'ok';
      $body = [
        'customer' => [
          'Name' => $inv['client_name'],
          'Identity' => $inv['client_document'],
          'IdentityType' => 'CPF'
        ],
        'Payment' =>[
          'Type' => 'Pix',
          'Amount' => number_format($inv['amount'], 2,'', ''),
          'QrCodeExpiration' => '86400'
        ],
        'MerchantOrderId' => $inv['ref_id']
      ];



      $client = new \GuzzleHttp\Client();

      $response = $client->request('POST', 'https://api.cieloecommerce.cielo.com.br/1/sales/', [
        'body' => json_encode($body),
        'headers' => [
          'MerchantId' => $this->private_key,
          'MerchantKey' => $this->public_key,
          'RequestId' => $inv['ref_id'],
          'accept' => 'application/json',
          'content-type' => 'application/json',
        ],
      ]);

      //dd($response->getBody() ,$user, $value, $key, $description, $inv, $this->private_key, $this->public_key);
      //echo $response->getBody();
      $result = json_decode($response->getBody() ,true);

      //dd($result);

      return Array(
            //"qrcode" => $result['Payment']['QrCodeBase64Image'],
            "qrcode" => $result['Payment']['QrCodeString'],
            "txid" => $result['Payment']['Tid'],
            "copy" => $result['Payment']['QrCodeString']
        );

  }

  public function consultarCobranca($txid) {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.cieloecommerce.cielo.com.br/1/sales/'.$txid, [
      'headers' => [
        'MerchantId' => $this->private_key,
        'MerchantKey' => $this->public_key,
        'accept' => 'application/json',
        'content-type' => 'application/json',

      ],
    ]);
  }

  public function listarCobrancas($page, $itensPage, $statusFilter, $dateFrom, $dateTo) {
      throw new \Exception("Não implementado.");
  }

  public function sendPayment($userData, $pixkey, $pixkeyType, $amount, $description) {
      throw new \Exception("Este provedor de pagamentos não oferece o serviço de saque.");
  }
  
  public function consultarPagamento($txid) {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.cieloecommerce.cielo.com.br/1/sales/'.$txid, [
      'headers' => [
        'MerchantId' => $this->private_key,
        'MerchantKey' => $this->public_key,
        'accept' => 'application/json',
        'content-type' => 'application/json',

      ],
    ]);



    // dd($response->getBody() ,$user, $value, $key, $description, $inv, $this->private_key, $this->public_key);
    // echo $response->getBody();
    $result = json_decode($response->getBody() ,true);
  }

  /**
   * 
   * @var $page
   * @var $itensPage
   * @var $statusFilter TODOS = 0, PAGO = 1, PENDENTE = 2, EXPIRADO = 3
   */
  public function listarPagamentos($page, $statusFilter, $dateFrom, $dateTo) {
      throw new \Exception("Não implementado.");
  }
}