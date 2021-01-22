## Simple web routing library for php, similar to express framework

### Instalation

#
Installation is done using the `composer`:
```bash
composer require bartoszmajczak/speedy:dev-master
```

### Basic examples

#

#### HTML response

```php
<?php

require './vendor/autoload.php';

use bartoszmajczak\Speedy;

$speedy = new Speedy;

$speedy -> get('/^(.*)$/', function($request, $response) {
  $response -> html('
    <p>Habemus papam</p>
  ');
});
```

#

#### JSON response

```php
<?php

require './vendor/autoload.php';

use bartoszmajczak\Speedy;

$speedy = new Speedy;

$speedy -> get('/^(.*)$/', function($request, $response) {
  $response -> json([
    'id' => 2137,
    'username' => 'jp2gmd'
  ]);
});
```

### Extended examples

#

#### API server with JWT authentication

```php
<?php

require './vendor/autoload.php';

use bartoszmajczak\Speedy;

$speedy = new Speedy;

// creating middleware function to protect api routes
$middleware = function($request, $response) : void {
  // ...
};

// creating route for login
$speedy -> post('/^\/auth\/login$/', function($request, $response) : void {
  // accesing request body
  $body = $request -> body;

  // validate request body fields
  $username = isset($body['username']) ? $body['username'] : null;
  $password = isset($body['password']) ? $body['password'] : null;

  if ($username && $password) {
    // check if $user exist in database
    $user = [
      'id' => 36,
      'username' => 'dyatlov'
    ];

    if ($user) {
      // generate $access_token (jwt) and $refresh_token
      $access_token = 'cher.no.byl';
      $refresh_token = 'somerandomroentgenpower';

      // send json response
      $response -> json([
        'access_token' => $access_token,
        'refresh_token' => $refresh_token
      ]); // status code '200' is default, not need to provide
    }

    // send json response
    $response -> json([
      'message' => 'not great, not terrible'
    ], 401); // custom status code
  }

  // send json response
  $response -> json([
    'message' => 'not great, not terrible'
  ], 401); // custom status code
});

// creating refresh route to reassign access and refresh token
$speedy -> post('/^\/auth\/refresh$/', function($request, $response) : void {
  // accesing request body
  $body = $request -> body;

  // validate request body field
  $refresh_token = isset($body['refresh_token']) ? $body['refresh_token'] : null;

  if ($refresh_token) {
    // check if $refresh_token is valid in database
    $valid = true;

    if ($valid) {
      // blacklist this $refresh_token to prevent another refresh

      // generate $access_token (jwt) and $refresh_token
      $access_token = '';
      $refresh_token = '';

      // send json response
      $response -> json([
        'access_token' => $access_token,
        'refresh_token' => $refresh_token
      ]); // status code '200' is default, not need to provide
    }

    // send json response
    $response -> json([
      'message' => ''
    ], 401); // custom status code
  }

  // send json response
  $response -> json([
    'message' => ''
  ], 401); // custom status code
});

// creating protected api route
$speedy -> get('/^\/api\/users\/(?<user_id>\d+)\/articles\/(?<article_id>\d+)$/', $middleware, function($request, $response) : void {
  // accesing route parameters
  $parameters = $request -> parameters;

  // saving in cool named variables $parameters value
  $user_id = isset($parameters['user_id']) ? $parameters['user_id'] : null;
  $article_id = isset($parameters['article_id']) ? $parameters['article_id'] : null;

  // select user article from database based on $user_id and $article_id
  $article = [
    'title' => ''
  ];

  if ($article) {
    // send json response
    $response -> json($article); // status code '200' is default, not need to provide
  }

  // send json response
  $response -> json(null); // status code '200' is default, not need to provide
});
```