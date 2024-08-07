<?php

    namespace RF\Http\Component\Request;

    class Uri {

        private $scheme;
        private $host;
        private $path;
        private $query;

        public function __construct() {
            $this->scheme = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") ? "https" : "http";
            $this->host = $_SERVER["HTTP_HOST"];
            $this->path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
            $this->query = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
        }

        public function fullUri() {
            return $this->scheme . "://" . $this->host . $this->path . ($this->query ? '?' . $this->query : '');
        }

        public function getScheme() {
            return $this->scheme;
        }

        public function getHost() {
            return $this->host;
        }

        public function getPath() {
            return $this->path;
        }

        public function getQuery() {
            return $this->query;
        }
    
        public function hasPath() {
            return !empty($this->path);
        }
    
        public function hasQuery() {
            return !empty($this->query);
        }

    }