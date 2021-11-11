<?php

namespace bartoszmajczak;

class Response {
  public $headers = [];

  public function headers(string $header = null): void {
    // adding custom headers to array
    $header ? array_push($this -> headers, $header) : null;
  }

  public function redirect(string $location): void {
    header('location:' . ' ' . $location);

    exit;
  }

  public function html(?string $data = '', int $code = null): void {
    // default header for response
    header('content-type: text/html');

    $this -> response($data, $code);
  }

  public function json(?array $data = [], int $code = null): void {
    $data = json_encode($data);

    // default header for response
    header('content-type: application/json');

    $this -> response($data, $code);
  }

  private function response($data, int $code = null): void {
    // adding custom headers from array to response
    foreach ($this -> headers as $header) {
      header($header);
    }

    // changing response code if provided
    $code ? http_response_code($code) : null;

    exit($data);
  }
}