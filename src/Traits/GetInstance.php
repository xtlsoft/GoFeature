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

    trait GetInstance {

        /**
         * The Instance
         *
         * @static
         * @var self
         * 
         */
        protected static $instance = null;
        
        /**
         * Get the Instance,
         *
         * @static
         * @return self
         * 
         */
        public static function getInstance(){

            if(self::$instance === null){
               self::$instance = new self();
            }
             
            return self::$instance;

        }

    }