<?php
namespace Blackfoxtr\EkranAgent\Interfaces;

interface Agent {

  public function CPU();
  public function Memory();
  public function Disk();
  public function Services();

}