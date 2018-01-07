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

    namespace GoFeature;

    class Defer {

        use \GoFeature\Traits\GetInstance;

        /**
         * Task List
         *
         * @var
         * 
         */
        protected $stack = [];

        /**
         * Constructor
         * 
         * @return void
         * 
         */
        public function __construct(){

            $this->stack = new \SplStack();

        }

        /**
         * Push A Function
         *
         * @param Callable $callback
         * 
         * @return self
         * 
         */
        public function push(Callable $callback){

            $this->stack->push($callback);

            return $this;

        }

        /**
         * Pop A Function
         *
         * @return callable
         * 
         */
        public function pop(){

            if(!$this->stack->isEmpty())
                return $this->stack->pop();
            else
                return false;

        }

        /**
         * When Excute Over
         * 
         * @return void
         * 
         */
        public function __destruct(){

            while($func = $this->pop()){
                $func();
            }

        }

    }