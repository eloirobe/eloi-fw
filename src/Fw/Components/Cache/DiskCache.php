<?php

namespace Fw\Components\Cache;


class DiskCache implements  Cache{

    private $cache;
    private $cache_file;

    function __construct($cache_file)
    {
        $this->cache_file=$cache_file;
        if (!file_exists($this->cache_file)){
            touch($this->cache_file);
        }
        $this->cache=json_decode(file_get_contents($this->cache_file),true);
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

        if (is_null($this->cache)) return null;

        if (array_key_exists($hash,$this->cache)) {
            $data = $this->cache[$hash];
            if ($this->isTheCacheExpired($data['expiration'])) {
                $this->delete($hash);

                return false;
            } else {
                return $data['content'];
            }
        }
        return false;
    }

    public function delete($key)
    {
        $hash=$this->hashing($key);
        unset ($this->cache[$hash]);
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