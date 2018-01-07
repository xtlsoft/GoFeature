<?php

require('vendor/autoload.php');

var_dump(

    make('GoFeature\GoImplements')
        ->exportInterface('Psr\Log\LoggerInterface')

);