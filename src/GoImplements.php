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

        use \GoFeature\Traits\GetInstance;

        /**
         * Export Interface
         *
         * @param string $name
         * 
         * @return array
         * 
         */
        public function exportInterface(string $name){

            $ref = new \ReflectionClass($name);

            if(!$ref->isInterface()) panic("$name is not a interface.");

            $me = $ref->getMethods();
            $methods = [];

            foreach($me as $v){

                $m = [];
                $para = $v->getParameters();

                foreach ($para as $val){

                    $m[$val->name] = $val->getType();

                }

                $methods[$v->name] = $m;

            }

            $props = [];
            foreach($ref->getProperties() as $v){

                $props[$v->name] = $v->name;

            }

            return ["methods" => $methods, "properties" => $props];

        }

        public function check(){



        }

    }