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

    class GoError {

        use \GoFeature\Traits\GetInstance;

        /**
         * Have GoError Registered to Error Handler?
         *
         * @var boolean
         * 
         */
        protected $registered = false;

        /**
         * The error
         *
         * @var \Exception
         * 
         */
        protected $error = null;

        public function __construct(){

            //Code here...

        }

        /**
         * Register this
         *
         * @return self
         * 
         */
        public function register(){

            $goerr = $this;

            \register_shutdown_function(function() use ($goerr){

                $e = $goerr->recover();

                if($e !== null){
                    throw $e;
                }

            });

            $this->registered = true;

            return $this;

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
        public function error(string $msg, string $type = "StandardError", int $id = null, $more = null){

            $class = $this->buildErrorClass($type);

            $exception = new $class ($msg, $id);
            $exception->more = $more;

            $this->throw($exception);

            if($this->error === null)
                $this->error = $exception;
            else{
                \trigger_error("GoFeature Runtime Error: No recover() Found!", E_USER_WARNING);
                die();
            }

            return $exception;

        }

        /**
         * Recover the runtime error
         *
         * @return \Exception
         * 
         */
        public function recover(){
            
            $e = $this->error;
            $this->error = null;

            return $e;

        }

        /**
         * Throw or not
         *
         * @param \Exception $e
         * 
         * @return void
         * 
         */
        public function throw(\Exception $e){

            if(!$this->registered){
                throw $e;
            }

        }

        /**
         * Build Error Class
         *
         * @param string $name
         * 
         * @return void
         * 
         */
        public function buildErrorClass(string $name){

            if(!class_exists("GoFeature\\Errors\\" . $name))
                aeval("<?php
                namespace GoFeature\\Errors;
                class $name extends \\Exception {
                    public \$more = null;
                    public \$type = \"$name\";
                    public function getMore(){
                        return \$this->more;
                    }
                    public function getType(){
                        return \$this->type;
                    }
                }
            ");

            return "GoFeature\\Errors\\" . $name;
            
        }

    }