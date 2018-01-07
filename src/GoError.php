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

            throw $exception;

            return $exception;

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

            if(!class_exists($name))
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