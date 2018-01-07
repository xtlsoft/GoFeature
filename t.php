<?php

require('vendor/autoload.php');


defer(function(){
    echo '1';
});

defer(function(){
    echo '2';
});

echo '3';
