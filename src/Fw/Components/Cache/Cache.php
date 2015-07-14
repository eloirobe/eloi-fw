<?php

namespace Fw\Components\Cache;


interface Cache {

    public function set($key,$content,$expiration);
    public function get($key);
    public function delete($key);

}