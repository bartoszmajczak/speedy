<?php

namespace bartoszmajczak;

class Request {
  public $route = [];
  public $method = [];
  public $headers = [];
  public $contents = [];
  public $parameters = [];

  public function __construct() {
    $this -> route();
    $this -> method();
    $this -> headers();
    $this -> contents();
  }

  private function route() : void {
    $route = strtolower($_SERVER['REQUEST_URI']) == '/' ? strtolower($_SERVER['REQUEST_URI']) : rtrim(strtolower($_SERVER['REQUEST_URI']), '/');

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

  private function contents() : void {
    $contents = json_decode(file_get_contents('php://input'), true);

    $this -> contents = $contents;
  }
}