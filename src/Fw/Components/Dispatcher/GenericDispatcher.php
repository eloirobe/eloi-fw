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
    private $values;

    /**
     * @param mixed $array
     */
    public function setArray($array)
    {
        $this->array=$array;
    }

    public function getValues()
    {
        return $this->values;
    }


    public function dispatch($key_tofind){

        foreach ($this->array as $key=>$value)
        {
            if ($key==$key_tofind){
                return $value["controller"];
            }else{
                preg_match_all('(\{(.*?)\})',$key,$_keyvars);
                $routetocompare=preg_replace('(\{(.*?)\})','(\w+)',$key);
                $routetocompare=str_replace("/","\\/",$routetocompare);
                if (preg_match_all("/^".$routetocompare."$/",$key_tofind,$matches)>0){
                    $values=array_splice($matches,1);
                    foreach ($values as $v)$tmpval[]=$v[0];
                    $keyvars=$_keyvars[1];
                    $this->values=array_combine($keyvars,$tmpval);
                    var_dump($this->values);
                    var_dump($value["controller"]);
                    return $value["controller"];

                }


            }

        }


    }



}