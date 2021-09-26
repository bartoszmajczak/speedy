<?php

namespace bartoszmajczak;

class Request {
  public $body = [];
  public $route = [];
  public $method = [];
  public $headers = [];
  public $filters = [];
  public $parameters = [];

  public function __construct() {
    $this -> body();
    $this -> route();
    $this -> method();
    $this -> headers();
    $this -> filters();
  }

  private function body(): void {
    $body = json_decode(file_get_contents('php://input'), true);

    $this -> body = $body;
  }

  private function route(): void {
    $route = $_SERVER['REQUEST_URI'];

    $this -> route = $route;
  }

  private function method(): void {
    $method = strtolower($_SERVER['REQUEST_METHOD']);

    $this -> method = $method;
  }

  private function headers(): void {
    $headers = getallheaders();

    var_dump(getallheaders());

    $this -> headers = $headers;
  }

  private function filters(): void {
    $parse = parse_url($this -> route);

    $this -> route = $parse['path'];

    if (isset($parse['query']) && !empty($parse['query'])) {
      parse_str($parse['query'], $result);

      $this -> filters = $result;
    }
  }
}