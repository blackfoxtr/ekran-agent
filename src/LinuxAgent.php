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
    exec("uptime", $command);
    $stats = explode(',', explode('load average:', $command[0])[1]);
    return $stats;
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
      $free = disk_free_space($p);
      $usage[$p] = $free;
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


}