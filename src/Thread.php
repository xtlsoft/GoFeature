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

    class Thread extends \Thread{

        /**
         * The function to run.
         *
         * @var Callable
         * 
         */
        protected $func = null;

        /**
         * The param
         *
         * @var null
         * 
         */
        public $param = null;

        /**
         * The send data.
         * 
         * @var mixed
         * 
         */
        protected $data = null;

        /**
         * Constructor
         *
         * @param Callable $func
         * @param null $param
         * 
         */
        public function __construct(Callable $func, $param = null){

            $this->func = $func;
            $this->param = $param;

        }

        /**
         * Run the Thread.
         *
         * @return void
         * 
         */
        public function run(){

            ($this->func)($this, $this->param);

        }

        /**
         * Send data to channel
         *
         * @param mixed $data
         * 
         * @return self
         * 
         */
        public function send($data){

            $this->data = $data;
            $this->notify();

            return $this;

        }

        /**
         * Get the data
         *
         * @return mixed
         * 
         */
        public function recv(){

            if($this->data !== null){
                $d = $this->data;
                $this->data = null;
                return $d;
            }

            $this->synchronized(function($thread){
                $thread->wait();
            }, $this);

            $d = $this->data;
            $this->data = null;
            return $d;

        }

        /**
         * Create a thread
         *
         * @static
         * @param Callable $func
         * @param mixed $param
         * 
         * @return string
         * 
         */
        public static function create(Callable $func, $param = null){

            $uniqid = uniqid("GoFeatureThread") . rand(0, 100);

            $GLOBALS['__GoFeatureThread__'][$uniqid] = new self($func, $param);

            return $uniqid;

        }

    }