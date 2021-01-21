## Simple web routing library for php, similar to express framework

### Instalation

#
Installation is done using the `composer`:
```bash
composer require bartoszmajczak/speedy:dev-master
```

### Examples

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