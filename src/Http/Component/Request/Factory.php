<?php

    namespace RF\Http\Component\Request;

    use RF\Http\Component\Request\Query;
    use RF\Http\Component\Request\Input;
    use RF\Http\Component\Request\Uri;
    use RF\Http\Component\Request\File;
    use RF\Http\Component\Request\Header;

    class Factory {

        public $query;
        public $input;
        public $uri;
        public $file;
        public $header;

        public function __construct() {
            $this->query = new Query();
            $this->input = new Input();
            $this->uri = new Uri();
            $this->file = new File();
            $this->header = new Header();
        }

    }