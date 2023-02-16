<?php

namespace core;
class Request   {
    public function getPath() :String   {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false)    {
            return $path;
        }
        return substr($path, 0, $position);
    }
    public function method()    {
        return $_SERVER["REQUEST_METHOD"];
    }
}