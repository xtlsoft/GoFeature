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

        public function error($msg, $type = "StandardError", $id = null){

            $class = $this->buildErrorClass($type);

        }

        public function buildErrorClass(){

            aeval();
            
        }

    }