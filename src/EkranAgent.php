<?php
namespace Blackfoxtr\EkranAgent;

class EkranAgent {
  
  public $agent;

  public function __construct(){
    if(PHP_OS == 'Linux'){
      $this->agent = new LinuxAgent();
    }
    if(PHP_OS == 'WINNT'){
      // $this->gent = WindowsAgent();
    }
  }

  public function stats(){
    $cpu = $this->agent->CPU();
    $memory = $this->agent->Memory();
    $disk = $this->agent->Disk();
    return [
      'cpu' => $this->agent->CPU(),
      'memory' => $this->agent->Memory(),
      'disk' => $this->agent->Disk(),
      'services' => $this->agent->Services()
    ];
  }

}