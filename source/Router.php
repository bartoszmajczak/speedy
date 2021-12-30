<?php

namespace bartoszmajczak;

require 'Request.php';
require 'Response.php';

use bartoszmajczak\Request;
use bartoszmajczak\Response;

class Router {
  private $request;
  private $response;

  public function __construct() {
    $this -> request = new Request;
    $this -> response = new Response;
  }

  public function route(string $method, array $arguments): void {
    // separate route and callback from middleware
    $route = array_shift($arguments);
    $callback = array_pop($arguments);

    // check if route method match request method
    if ($method == $this -> request -> method) {
      // check if route is empty
      if (empty($route)) {
        exit('route can not be empty');
      }

      // check if you are using template route
      if (!str_starts_with($route, '/^') && !str_ends_with($route, '$/')) {
        switch ($route) {
          // special cases in template
          case '*':
              // matching all for regex
              $route = '/^(.*)$/';
            break;
          // default case in template
          default:
              // escaping route for regex
              $route = str_replace('/', '\/', $route);

              // adding start and end for regex
              $route = '/^' . $route;

              if (!str_ends_with($route, '/')) {
                $route = $route . '\/?$/';
              } else {
                $route = $route . '?$/';
              }

              // matching template parameters
              preg_match_all('/{(?<parameter>.+?)}/', $route, $parameter_matches);

              // creating regex groups from template parameters
              if (isset($parameter_matches) && !empty($parameter_matches)) {
                foreach ($parameter_matches['parameter'] as $parameter) {
                  $route = str_replace('{' . $parameter . '}', '(?<' . $parameter . '>.+)', $route);
                }
              }
            break;
        }
      }

      // matching route with request route
      preg_match($route, $this -> request -> route, $route_match);

      // check if route match request route
      if (isset($route_match) && !empty($route_match)) {
        $parameters = [];

        // adding every parameter to array if key is string
        foreach ($route_match as $key => $value) {
          is_string($key) ? $parameters[$key] = urldecode($value) : null;
        }

        // adding parameters to request class
        !empty($parameters) ? $this -> request -> parameters = $parameters : null;

        // executing middlewares
        foreach ($arguments as $argument) {
          $argument($this -> request, $this -> response);
        }

        // executing last callback
        $callback($this -> request, $this -> response);
      }
    }
  }
}