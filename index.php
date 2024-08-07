<?php

    use RF\Http\Request;

    require "vendor/autoload.php";
    
    $request = new Request();

    print_r(getallheaders());