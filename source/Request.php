<?php

namespace bartoszmajczak;

class Request {
  public $body = [];
  public $route = [];
  public $method = [];
  public $headers = [];
  public $parameters = [];

  public function __construct() {
    $this -> body();
    $this -> route();
    $this -> method();
    $this -> headers();
  }

  private function body() : void {
    $body = json_decode(file_get_contents('php://input'), true);

    $this -> body = $body;
  }

  private function route() : void {
    $route = strtolower($_SERVER['REQUEST_URI']);

    $this -> route = $route;
  }

  private function method() : void {
    $method = strtolower($_SERVER['REQUEST_METHOD']);

    $this -> method = $method;
  }

  private function headers() : void {
    $headers = getallheaders();

    $this -> headers = $headers;
  }
}