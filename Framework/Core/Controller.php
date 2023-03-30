<?php

namespace Core;


class Controller
{
    public function __construct()
    {
        $this->initSession();
    }

    private function initSession()
    {
        new \Lib\Session();
    }
}
