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

    class GoImplements {

        public function exportInterfaceDetails(string $name){

            $ref = new \ReflectionClass($name);

            if(!$ref->isInterface()) return false;

            

        }

    }