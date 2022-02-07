<?php
namespace Blackfoxtr\EkranAgent;

use Blackfoxtr\EkranAgent\Interfaces\Agent;

class LinuxAgent implements Agent {

  public $memkeys = [
    'total' => 1,
    'used' => 2,
    'free' => 3
  ];

  public function CPU(){
    // TODO: TO check if possible data can be fetched by one command only
    // We need CPU loads
    exec("uptime", $load);
    // Human readable uptime format.
    exec("uptime -p", $uptime);
    // Last reboot date. 
    exec("uptime -s", $upsince);

    return [
      'load' => explode(',', explode('load average:', $load[0])[1]),
      'uptime' => $uptime[0],
      'upsince' => $upsince[0],
    ];
  }

  public function Memory(){
    exec("free", $command);
    $mem = explode("-", preg_replace("~\s{1,}~", "-",$command[1]));
    $stats = [];
    foreach($this->memkeys as $title => $key){
      $stats[$title] = $mem[$key];
    }
    return $stats;
  }

  public function Disk(){
    if(!isset($_ENV['PARTITIONS'])){
      return [];
    }
    $parts = explode(':', $_ENV['PARTITIONS']);
    $usage = [];
    foreach($parts as $p){
      $usage[$p] = [
        'total' => disk_total_space($p),
        'free' => disk_free_space($p)
      ];
    }
    return $usage;
  }

  public function Services(){
    if(!isset($_ENV['SERVICES'])){
      return [];
    }
    $services = explode(':', $_ENV['SERVICES']);
    $stats = [];
    foreach($services as $srv){
      exec("ps -C ".$srv." --no-header", $c);
      $stats[$srv] = count($c);
    }
    return $stats;
  }

  public function getStats(){
    return [
      'cpu' => $this->CPU(),
      'memory' => $this->Memory(),
      'disk' => $this->Disk(),
      'services' => $this->Services()
    ];
  }

}