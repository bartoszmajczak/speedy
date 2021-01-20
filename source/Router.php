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

  function __construct() {
    $this -> request = new Request;
    $this -> response = new Response;
  }

  public function route($method, $arguments) {
    $route = array_shift($arguments);
    $callback = array_pop($arguments);

    if ($method == $this -> request -> method) {
      preg_match($route, $this -> request -> route, $matches);

      if (!empty($matches)) {
        $parameters = [];

        foreach ($matches as $key => $value) {
          is_string($key) ? $parameters[$key] = $value : null;
        }

        $this -> request -> parameters = !empty($parameters) ? $parameters : null;

        foreach ($arguments as $key => $value) {
          $return = $value($this -> request, $this -> response, $this -> data);

          $return != null ? $this -> data = array_merge($this -> data, [$return]) : null;
        }

        $callback($this -> request, $this -> response, $this -> data);
      }
    }
  }
}