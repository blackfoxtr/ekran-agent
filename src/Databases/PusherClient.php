<?php
namespace Blackfoxtr\EkranAgent\Databases;
use Blackfoxtr\EkranAgent\Interfaces\Database;

class PusherClient implements Database {
  public $client;

  public function __construct(){
    $this->client = new \Pusher\Pusher(
      $_ENV['PUSHER_APP_KEY'],
      $_ENV['PUSHER_APP_SECRET'],
      $_ENV['PUSHER_APP_ID'],
      [
        'useTLS' => true,
        'cluster' => $_ENV['PUSHER_CLUSTER']
      ]
    );
  }
  
  public function store($data){
    $this->client->trigger('server-status','update', $data);
  }
}