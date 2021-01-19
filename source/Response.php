<?php

namespace bartoszmajczak;

class Response {
  public function html(?string $data = null, int $code = null) : void {
    header('content-type: text/html');

    $code ? http_response_code($code) : null;

    print $data ? $data : '';

    exit;
  }

  public function json(?array $data = null, int $code = null) : void {
    $data = json_encode($data ? $data : []);

    header('content-type: application/json');

    $code ? http_response_code($code) : null;

    print $data;

    exit;
  }
}