<?php

namespace bartoszmajczak;

class Response {
  public $headers = [];

  public function headers(string $header = null): void {
    $header ? array_push($this -> headers, $header) : null;
  }

  public function html(?string $data = '', int $code = null): void {
    header('content-type: text/html');

    foreach ($this -> headers as $key => $value) {
      header($value);
    }

    $code ? http_response_code($code) : null;

    print $data;

    exit;
  }

  public function json(?array $data = [], int $code = null): void {
    $data = json_encode($data);

    header('content-type: application/json');

    foreach ($this -> headers as $key => $value) {
      header($value);
    }

    $code ? http_response_code($code) : null;

    print $data;

    exit;
  }
}