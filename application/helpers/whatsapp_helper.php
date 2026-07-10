<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';
use GuzzleHttp\Client;


  function send_message($message, $phone){
    $client = new Client();
    $phone = $phone;
    $response = $client->request('POST', 'https://api.sidobe.com/wa/v1/send-message', [
        'headers' => [
            'Content-Type' => 'application/json',
            'X-Secret-Key' => 'YzHmDGzloGHmOwhyEwJINdRrWBtRcsPawjWJZxlRKyraVfFVKj',
        ],
        'json' => [
            'phone' => '+'.$phone,
            'message' => $message
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

?>