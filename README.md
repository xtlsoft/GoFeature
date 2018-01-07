# GoFeature
Enabling Golang Features in PHP.

## Installation
```bash
composer install xtlsoft/gofeature
```

## Demos
Code:
```php
<?php

require_once "vendor/autoload.php";

defer(function(){
    echo '1';
});

defer(function(){
    echo '2';
});

$defer = make('GoFeature\Defer')->push(function(){
    echo 'FromAnother1';
})->push(function(){
    echo 'FromAnother2'
});

echo '3'

```
Result:
```text
3FromAnother2FromAnother121
```