<?php
namespace Blackfoxtr\EkranAgent;

use Blackfoxtr\EkranAgent\Databases\PusherClient;
use Exception;

class EkranAgent {
  
  public $agent;
  public $database;
  
  public function __construct(){
    // If it's a Linux based OS
    if(PHP_OS == 'Linux'){
      $this->agent = new LinuxAgent();
    }
    // If it's a WINNT based OS
    if(PHP_OS == 'WINNT'){
      // $this->gent = WindowsAgent();
    }
    // We are setting the database we would like to use
    if ($_ENV['DATABASE'] == 'Pusher') {
        $this->database = new PusherClient;
    }
  }
  
  /**
   * This function is used to fetch stats from the agent class.
   *
   * @return Array
   */

  public function stats(): Array
  {
    if(!$this->agent){
      throw new Exception('Agent is not specified');
    }
    return $this->agent->getStats();
  }

  /**
   * This function is used to send data to specified database connection. 
   * If data is not provided it'll use default data from current instance.
   *
   * @param any $data
   * @return bool
   */

  public function storeStats($data = null){
    if(!$this->database){
      throw new Exception('No database connection provided');
    }
    if($data == null){
      $data = $this->stats();
    }
    $this->database->store($data);
    return true;
  }
  
}