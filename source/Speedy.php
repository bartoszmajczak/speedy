<?php

namespace bartoszmajczak;

require 'Router.php';

use bartoszmajczak\Router;

class Speedy {
  private $router;

  public function __construct() {
    $this -> router = new Router;
  }

  public function connect($arguments) : void {
    $arguments = func_get_args();

    $this -> router -> route('connect', $arguments);
  }

  public function delete($arguments) : void {
    $arguments = func_get_args();

    $this -> router -> route('delete', $arguments);
  }

  public function get($arguments) : void {
    $arguments = func_get_args();

    $this -> router -> route('get', $arguments);
  }

  public function head($arguments) : void {
    $arguments = func_get_args();

    $this -> router -> route('head', $arguments);
  }

  public function options($arguments) : void {
    $arguments = func_get_args();

    $this -> router -> route('options', $arguments);
  }

  public function patch($arguments) : void {
    $arguments = func_get_args();

    $this -> router -> route('patch', $arguments);
  }

  public function post($arguments) : void {
    $arguments = func_get_args();

    $this -> router -> route('post', $arguments);
  }

  public function put($arguments) : void {
    $arguments = func_get_args();

    $this -> router -> route('put', $arguments);
  }

  public function trace($arguments) : void {
    $arguments = func_get_args();

    $this -> router -> route('trace', $arguments);
  }
}