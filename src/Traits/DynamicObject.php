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

    namespace GoFeature\Traits;

    trait DynamicObject {
        
        /**
         * $v
         * The Storage Array.
         * 
         */
        protected $v;
        
        /**
         * function __get()
         * The method to get something.
         * 
         * @param $key The key of the Value.
         * 
         * @return Mixed The Value.
         * 
         */
        public function __get($key){
            
            return $this->v[$key];
            
        }
        
        /**
         * function __set()
         * The method to set something.
         * 
         * @param $key The key of the Value.
         * @param $val The Value.
         * 
         * @return void
         * 
         */
        public function __set($key, $value){
            
            $this->v[$key] = $value;
            
        }
        
        /**
         * function __isset()
         * Isset a value.
         * 
         * @param $key The key of the Value.
         * 
         * @return bool
         * 
         */
        public function __isset($key){
            
            return isset($this->v[$key]);
            
        }
        
        /**
         * function __unset()
         * The method to unset something.
         * 
         * @param $key The key of the Value.
         * 
         * @return void
         * 
         */
        public function __unset($key){
            
            unset($this->v[$key]);
            
        }
        
        /**
         * function __call()
         * The method to call something.
         * 
         * @param $name The method name.
         * @param $args The argruments.
         * 
         * @return Mixed
         * 
         */
        public function __call($name, $args){
            
            $args = implode("\", \"", $args);
            $args = "\"".$args."\"";
            $func = $this->v[$name];
            
            return eval("return \$func($args);");
            
        }
        
    }