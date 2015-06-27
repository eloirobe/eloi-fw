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
            }elseif (preg_match('(\{(.*?)\})',$value['route']) === 1){
                $routetocompare=preg_replace('(\{(.*?)\})','(\w+)',$value['route']);
                $routetocompare=str_replace("/","\\/",$routetocompare);
                if (preg_match_all("/^".$routetocompare."$/",$path_info,$matches)>0){



                    //var_dump($matches);
                    $values=array_splice($matches,1);
                    foreach ($values as $v){
                        $tmpval[]=$v[0];
                    }
                    $patterns=array_fill(0,count($tmpval),'(\{.*?\})');
                    $key=preg_replace($patterns,$tmpval,$key,1);

                    return $key;

                }


            }



        }
        throw new \Exception("Unable to find route");

    }


}