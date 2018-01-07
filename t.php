<?php

require('vendor/autoload.php');

try{
    panic('test');
}catch(\Exception $e){
    echo $e->getMessage();
}