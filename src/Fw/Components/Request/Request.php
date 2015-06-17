<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 17/6/15
 * Time: 20:09
 */

namespace Fw\Components\Request;

class Request implements ArrayAccess {
    private $container = array();

    public function __construct($array) {
        $this->container = $array;
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return array_key_exists($offset,$this->container);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return $this->offsetExists($offset) ? $this->container[$offset] : null;
    }
}
