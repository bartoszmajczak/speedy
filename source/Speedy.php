<?php

namespace bartoszmajczak;

require 'Router.php';

use bartoszmajczak\Router;

class Speedy {
  private $router;

  private $methods = [
    'connect',
    'delete',
    'get',
    'head',
    'options',
    'patch',
    'post',
    'put',
    'trace'
  ];

  public function __construct() {
    $this -> router = new Router;
  }

  public function __call(string $method, array $arguments): void {
    $method = strtolower($method);

    if (in_array($method, $this -> methods)) {
      $this -> router -> route($method, $arguments);
    } else {
      exit('method does not exist');
    }
  }
}