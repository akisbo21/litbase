<?php

namespace Config\Environment;

use Config\Environment;

class Memcached extends Environment
{
    public function getHosts()
    {
        return $this->getVar('MEMCACHED_DSN');
    }
}