<?php
    /**
     * GoFeature - Enabling Golang Features in PHP
     * 
     * USE IT UNDER THE LICENSE!
     * 
     * @package GoFeature
     * @author  Tianle Xu <xtl@xtlsoft.top>
     * @license MIT
     *
     */

    // Function defines

    function go(){



    }

    function defer(callable $callback){

        return \GoFeature\Defer::getInstance()->push($callback);

    }

    function make($name, $arg1=null, $arg2=null, $arg3=null, $arg4=null, $arg5=null, $arg6=null){

        if($name === "channel"){

            return new Channel();

        }else{

            return new $name ($arg1, $arg2, $arg3, $arg4, $arg5, $arg6);

        }

    }

    
