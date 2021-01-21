<?php

namespace bartoszmajczak;

class Response {
  public $headers = [];

  public function headers(string $header = null) : void {
    $header ? array_push($this -> headers, $header) : null;
  }

  public function html(?string $data = null, int $code = null) : void {
    header('content-type: text/html');

    foreach ($this -> headers as $key => $value) {
      header($value);
    }

    $code ? http_response_code($code) : null;

    print $data ? $data : '';

    exit;
  }

  public function json(?array $data = null, int $code = null) : void {
    $data = json_encode($data ? $data : []);

    header('content-type: application/json');

    foreach ($this -> headers as $key => $value) {
      header($value);
    }

    $code ? http_response_code($code) : null;

    print $data;

    exit;
  }
}