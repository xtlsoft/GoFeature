<?php

require('vendor/autoload.php');

GoFeature_register();

function aecho ($ctx, $para){
    sleep($para[0]);
    echo $para[1];
}

$g = go(function ($ctx){

    while(1){
        echo file_get_contents($ctx->recv()) . "\r\n";
    }

});

while(1){
    $d = fscanf(STDIN, "%s")[0];

    $g->send($d);
}