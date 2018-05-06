# GoFeature
Enabling Golang Features in PHP.

## Installation
```bash
composer require xtlsoft/gofeature
```

## Demos
Defer:
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

Go:
```php
$th = go(function($ctx){
    while(1){
        echo $this->recv();
    }
});
$th->send("First test.\r\n");
sleep(2);
$th->send("Twice test.");
