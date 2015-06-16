<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 14/6/15
 * Time: 20:47
 */

namespace Fw\Components\Routing\RouteParser;

use Fw\Components\Routing\RouteParser;

class GenericParser implements RouteParser{

    public $array;

    public function setArray($array)
    {
        $this->array = $array;
    }


    public function parse($path_info){

        foreach ($this->array as $key=>$value)
        {
            if ($value['route']==$path_info){
                return $key;
            }
        }

    }


}