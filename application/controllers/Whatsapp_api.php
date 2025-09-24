<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require 'vendor/autoload.php';
use GuzzleHttp\Client;

class Whatsapp_api extends BaseController
{

  public function index(){
    $client = new Client();
    $phone = "628993932789";
    $response = $client->request('POST', 'https://api.sidobe.com/wa/v1/send-message', [
        'headers' => [
            'Content-Type' => 'application/json',
            'X-Secret-Key' => 'YzHmDGzloGHmOwhyEwJINdRrWBtRcsPawjWJZxlRKyraVfFVKj',
        ],
        'json' => [
            'phone' => '+'.$phone,
            'message' => 'pesan dari OSD'
        ]
    ]);
    $code = $response->getStatusCode();
    $body = $response->getBody();
    if ($code == 200) {
        echo "Kirim pesan WhatsApp berhasil";
    }else{
        echo "Kirim pesan WhatsApp gagal: " + $body;
    }
  }
}
?>