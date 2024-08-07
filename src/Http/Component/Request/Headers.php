<?php

    namespace RF\Http\Component\Request;

    class Headers {
        
        public function all() {
            return getallheaders();
        }

        public function has($name) {
            $headers = $this->all();
            return array_key_exists($name, $headers);
        }
        
        public function get($name) {
            $headers = $this->all();
            return $headers[$name] ?? null;
        }
        
        public function set($name, $value) {
            header("$name: $value");
        }
        
        public function remove(string $name) {
            header_remove($name);
        }
        
        private function getAllHeaders() {
            $headers = [];
            foreach ($_SERVER as $key => $value) {
                if (strpos($key, 'HTTP_') === 0) {
                    $header = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))));
                    $headers[$header] = $value;
                }
            }
            return $headers;
        }

    }
