<?php

    namespace RF\Http;

    use Exception;

    class Response {

        public $viewData;

        public function __construct() {
            $this->viewData = [];
            $this->response = $this;
        }

        public function withHttpResponseCode($code) {
            http_response_code((int) $code);
            return $this;
        }

        public function withHeaders($key, $val = null) {
            if (is_array($key)) {
                foreach ($key as $xKey => $xVal) {
                    header($xKey . ": " . $xVal);
                }
            } else {
                header($key . ": " . $val);
            }
            return $this;
        }

        public function view($file, $data = []) {
            $viewFile = $_SERVER["DOCUMENT_ROOT"] . "/public/views/" . $file . ".php";

            if (!file_exists($viewFile)) {
                throw new Exception("View file not found: " . $file . ".php");
            }

            $this->viewData = array_merge($this->viewData, $data);
            
            extract($this->viewData);
            
            include $viewFile;
        }

        public function json($data, $flag = JSON_UNESCAPED_SLASHES) {
            $this->withHeaders("content-type", "application/json");
            echo json_encode($data, $flag);
        }
        
        public function custom($content, $type = "text/plain", $isFile = false) {
            $this->withHeaders("content-type", $type);
            if (!$isFile) {
                echo $content;
            } else {
                if (!file_exists($_SERVER["DOCUMENT_ROOT"] . "/" . $content)) {
                    throw new Exception("File not found: " . $content);
                }
                include $_SERVER["DOCUMENT_ROOT"] . "/" . $content;
            }
        }

        public function redirect($uri) {
            $this->withHeaders("Location", $uri);
            exit();
        }

    }