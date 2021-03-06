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

    /**
     * Create a thread
     *
     * @param Callable $func
     * @param mixed $param
     * @param bool $run
     * 
     * @return \GoFeature\Thread
     * 
     */
    function go(Callable $func, $param = null, bool $start = true){

        $id = \GoFeature\Thread::create($func, $param);

        if($start)
            $GLOBALS['__GoFeatureThread__'][$id]->start();

        return $GLOBALS['__GoFeatureThread__'][$id];

    }

    /**
     * Defer a function
     *
     * @param callable $callback
     * 
     * @return \GoFeature\Defer
     * 
     */
    function defer(callable $callback){

        return \GoFeature\Defer::getInstance()->push($callback);

    }

    /**
     * Register the GoFeature Classes
     *
     * @return void
     * 
     */
    function GoFeature_register(){

        \GoFeature\GoError::getInstance()->register();

        register_shutdown_function(function(){
            if(is_array($GLOBALS['__GoFeatureThread__']))
            foreach($GLOBALS['__GoFeatureThread__'] as $k=>$v){
                try{
                    $v->join();
                }catch(\Exception $e){
                    
                }
            }
        });

    }

    /**
     * Make a class
     *
     * @param string $name
     * @param mixed $arg1
     * @param mixed $arg2
     * @param mixed $arg3
     * @param mixed $arg4
     * @param mixed $arg5
     * @param mixed $arg6
     * 
     * @return void
     */
    function make(string $name, $arg1=null, $arg2=null, $arg3=null, $arg4=null, $arg5=null, $arg6=null){

        if($name === "channel"){

            return new \GoFeature\Channel();

        }else{

            return new $name ($arg1, $arg2, $arg3, $arg4, $arg5, $arg6);

        }

    }

    /**
     * Advanced Eval Something
     *
     * @param string $code
     * 
     * @return mixed
     * 
     */
    function aeval(string $code){

        return \GoFeature\AEval::getInstance()->eval($code);

    }

    /**
     * Generate an Error
     *
     * @param string $msg
     * @param string $type
     * @param int $id
     * @param mixed $more
     * 
     * @return void
     * 
     */
    function panic(string $msg, string $type = "StandardError", int $id = null, $more = null){

        return \GoFeature\GoError::getInstance()->error($msg, $type, $id, $more);

    }

    /**
     * Recover the runtime error
     *
     * @return \Exception
     * 
     */
    function recover(){

        return \GoFeature\GoError::getInstance()->recover();

    }