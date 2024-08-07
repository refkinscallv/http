<?php

    namespace RF\Http;

    use RF\Http\Component\Request\Factory;

    class Request extends Factory {

        public function __construct() {
            parent::__construct();
        }

        public function getMethod() {
            return $_SERVER["REQUEST_METHOD"];
        }

    }