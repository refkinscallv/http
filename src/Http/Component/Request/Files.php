<?php

    namespace RF\Http\Component\Request;

    class Files {

        private $files;

        public function __construct() {
            $this->files = $_FILES;
        }

        public function all() {
            return $this->files;
        }

        public function has($name) {
            return isset($this->files[$name]);
        }

        public function get($name) {
            return $this->has($name) ? $this->files[$name] : null;
        }
        
        public function move($name, $destination) {
            if ($this->has($name) && is_uploaded_file($this->files[$name]['tmp_name'])) {
                return move_uploaded_file($this->files[$name]['tmp_name'], $destination);
            }
            return false;
        }

        public function getOriginalName($name) {
            return $this->has($name) ? $this->files[$name]['name'] : null;
        }

        public function getSize($name) {
            return $this->has($name) ? $this->files[$name]['size'] : null;
        }

        public function getMimeType($name) {
            return $this->has($name) ? $this->files[$name]['type'] : null;
        }

        public function getError($name) {
            return $this->has($name) ? $this->files[$name]['error'] : null;
        }
    }
