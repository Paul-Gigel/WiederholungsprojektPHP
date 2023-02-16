<?php

namespace core;

class Response  {
    public function setStatuscode(int $code)    {
        http_response_code($code);
    }
    public function redirect(string $url)   {
        header('Location:'.$url);
    }
}