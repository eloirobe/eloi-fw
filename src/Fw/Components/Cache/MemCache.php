<?php

namespace Fw\Components\Cache;


class MemCache implements  Cache{

    private $mem_cache;

    function __construct(\Memcached $mem_cache)
    {
        $this->mem_cache=$mem_cache;
    }

    public function set($key, $content, $expiration)
    {
        $this->mem_cache->set($this->hashing($key),$content,time()+$expiration);
    }

    public function get($key)
    {
        $content=$this->mem_cache->get($this->hashing($key));
        if (is_null($content)){
            return false;
        }else{
            return $content;
        }

    }

    public function delete($key)
    {
        $this->mem_cache->delete($this->hashing($key));
    }


    private function hashing($key)
    {
        return sha1($key);
    }
}