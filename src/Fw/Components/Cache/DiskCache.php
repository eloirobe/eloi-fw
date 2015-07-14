<?php

namespace Fw\Components\Cache;


class DiskCache implements  Cache{

    private $cache;
    private $cache_file;

    function __construct($cache_file)
    {
        $this->cache_file=$cache_file;
        $this->cache=json_decode(file_get_contents($cache_file));
    }

    public function set($key, $content, $expiration)
    {
        $this->cache[$key]=array('content'=>$content,'expiration'=>time()+$expiration);
        file_put_contents($this->cache_file,json_encode($this->cache));
    }

    public function get($key)
    {
        $data=$this->cache[$key];
        if ($this->isTheCacheExpired($data['expiration'])){
            $this->delete($key);
            return false;
        }else{
            return $data['content'];
        }
    }

    public function delete($key)
    {
        unset ($this->cache_file[$key]);
        file_put_contents($this->cache_file,json_encode($this->cache));
    }

    private function isTheCacheExpired($expiration)
    {
        return time()>$expiration;
    }



}