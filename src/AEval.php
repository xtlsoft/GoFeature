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

    class AEval {

        use \GoFeature\Traits\GetInstance;

        /**
         * Virtual File System
         *
         * @var \Vfs\FileSystem
         * 
         */
        protected $vfs = null;
        
        /**
         * VFS Protocol Name
         *
         * @var string
         * 
         */
        protected $protocol = "gofeatureaevel";

        /**
         * Constructor
         * 
         * @return void
         * 
         */
        public function __construct(){

            $this->protocol .= uniqid("");

            $this->vfs = \Vfs\FileSystem::factory($this->protocol . '://');
            $this->vfs->mount();

        }

        /**
         * Eval it!
         *
         * @param string $code
         * 
         * @return mixed
         * 
         */
        public function eval($code){

            $file = $this->protocol . '://' . uniqid("");

            file_put_contents($file, $code);

            $defer = make('GoFeature\Defer')->push(function() use ($file) {

                unlink ($file);

            });

            return include($file);

        }

    }