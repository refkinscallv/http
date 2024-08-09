<?php

    namespace RF\Http\Component\Request;

    use RF\Http\HttpHelper;

    class Input {

        private $input;
        private $filteredInput = false;

        public function __construct() {
            $this->input = $this->manageData($_POST);

            if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                parse_str(file_get_contents('php://input'), $putData);
                $this->input = $this->manageData($putData);
            }
        }

        private function manageData($data) {
            $newData = [];

            foreach($data as $key => $value) {
                $newData[HttpHelper::sanitize($key)] = HttpHelper::sanitize($value);
            }

            return $newData;
        }

        public function all() {
            return $this->input;
        }

        public function get($key) {
            return $this->input[$key] ?? null;
        }

        public function has($key) {
            return isset($this->input[$key]);
        }

        public function some($keys) {
            $this->filteredInput = HttpHelper::filterArrayKeys($this->input, $keys);
            return $this->filteredInput;
        }

        public function someRecursive($keys) {
            $this->filteredInput = HttpHelper::filterArrayKeysRecursive($this->input, $keys);
            return $this->filteredInput;
        }

        public function count() {
            return [
                "total" => count($this->input),
                "filtered" => count($this->filteredInput)
            ];
        }

    }