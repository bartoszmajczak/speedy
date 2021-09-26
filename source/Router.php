<?php

namespace bartoszmajczak;

require 'Request.php';
require 'Response.php';

use bartoszmajczak\Request;
use bartoszmajczak\Response;

class Router {
  private $request;
  private $response;

  private $data = [];

  public function __construct() {
    $this -> request = new Request;
    $this -> response = new Response;
  }

  public function route(string $method, array $arguments): void {
    $route = array_shift($arguments);
    $callback = array_pop($arguments);

    if ($method == $this -> request -> method) {
      preg_match($route, $this -> request -> route, $matches);

      if (isset($matches) && !empty($matches)) {
        $parameters = [];

        foreach ($matches as $key => $value) {
          is_string($key) ? $parameters[$key] = urldecode($value) : null;
        }

        $parameters ? $this -> request -> parameters = $parameters : null;

        foreach ($arguments as $key => $value) {
          $return = $value($this -> request, $this -> response, $this -> data);

          $return ? $this -> data = array_merge($this -> data, [$return]) : null;
        }

        $callback($this -> request, $this -> response, $this -> data);
      }
    }
  }
}