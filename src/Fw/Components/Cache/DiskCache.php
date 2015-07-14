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
        $hash=$this->hashing($key);
        $this->cache[$hash]=array('content'=>$content,'expiration'=>time()+$expiration);
        file_put_contents($this->cache_file,json_encode($this->cache));
    }

    public function get($key)
    {
        $hash=$this->hashing($key);
        $data=$this->cache[$hash];
        if ($this->isTheCacheExpired($data['expiration'])){
            $this->delete($hash);
            return false;
        }else{
            return $data['content'];
        }
    }

    public function delete($key)
    {
        $hash=$this->hashing($key);
        unset ($this->cache_file[$hash]);
        file_put_contents($this->cache_file,json_encode($this->cache));
    }

    private function isTheCacheExpired($expiration)
    {
        return time()>$expiration;
    }
    private function hashing($key)
    {
        return sha1($key);
    }



}