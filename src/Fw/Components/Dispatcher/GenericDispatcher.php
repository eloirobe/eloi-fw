<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 15/6/15
 * Time: 20:57
 */

namespace Fw\Components\Dispatcher;


class GenericDispatcher implements Dispatcher{


    private $array;

    /**
     * @param mixed $array
     */
    public function setArray($array)
    {
        $this->array = $array;
    }


    public function dispatch($key_tofind){

        foreach ($this->array as $key=>$value)
        {
            if ($key==$key_tofind){
                return $value["controller"];
            }
        }

    }



}