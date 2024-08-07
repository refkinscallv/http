<?php

    namespace RF\Http;

    use CG\FVSS\Fvss;

    class Validation {

        private Fvss $validator;

        public function __construct() {
            $this->validator = new Fvss();
        }

        public function validate($data) {
            return $this->validator->validate($data);
        }

    }