<?php

    namespace RF\Http;

    class Response {

        public $viewData;

        public function __construct() {
            $this->viewData = [];
        }

        public function setStatus($code) {
            http_response_code($code);
            return $this;
        }

        public function view($file, $data = []) {
            $this->viewData = $data;

            $viewData = array_merge([
                "viewData" => $this->viewData
            ], $data);

            extract($viewData);

            include $file;
        }

        public function json($data, $flag = JSON_UNESCAPED_SLASHES) {
            header("Content-Type: Application/JSON");
            echo json_encode($data, $flag);
        }

        public function redirect($uri) {
            header("Location: ". $uri);
        }

    }