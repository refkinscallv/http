<?php

    namespace RF\Http\Component\Request;

    use RF\Http\HttpHelper;

    class Query {

        private $query;

        private $filteredQuery = false;

        public function __construct() {
            $this->query = $this->manageData($_GET);
        }

        private function manageData($data) {
            $newData = [];

            foreach($data as $key => $value) {
                $newData[HttpHelper::sanitize($key)] = HttpHelper::sanitize($value);
            }

            return $newData;
        }

        public function all() {
            return $this->query;
        }

        public function get($key) {
            return $this->query[$key];
        }

        public function has($key) {
            return isset($this->query[$key]);
        }

        public function some($keys) {
            $filteredQuery = HttpHelper::filterArrayKeys($this->query, $keys);
            return $filteredQuery;
        }

        public function someRecursive($keys) {
            $filteredQuery = HttpHelper::filterArrayKeysRecursive($this->query, $keys);
            return $filteredQuery;
        }

        public function count() {
            return [
                "total" => count($this->query),
                "filtered" => count($filteredQuery)
            ];
        }

    }