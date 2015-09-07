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


            if ($value['route']==$path_info){/* Si coincide directamente con la ruta devuelvo la key*/
                return $key;
            }elseif (preg_match('(\{(.*?)\})',$value['route']) === 1){
                /* He mirado si hay algo con llaves {} en el nombre de la ruta (implica que hay variables)*/

                /* Reemplazamos lo encontrado con llaves {} por \w+ (\w significa cualquier caracter alfanumerico)
                   Con esto estamos montando la expresion regular */
                $routetocompare=preg_replace('(\{(.*?)\})','(\w+)',$value['route']);

                /* Reemplazamos la / por \\/ para que funcione bien la expresion regular en el preg_match*/
                $routetocompare=str_replace("/","\\/",$routetocompare);

                if (preg_match_all("/^".$routetocompare."$/",$path_info,$matches)>0){
                    /* La ruta coincide y contiene variables, en $matches se guardan las variables encontradas en la ruta*/

                    //var_dump($matches);
                    /* Con esto me quedo con toda la array excepto el primer resultado asi consigo la array de variables*/
                    $values=array_splice($matches,1);
                    foreach ($values as $v){
                        $tmpval[]=$v[0];
                    }
                    /*Creo una array con expresiones reguilares que tiene tantas ({.*?}) como values*/
                    $patterns=array_fill(0,count($tmpval),'(\{.*?\})');
                    /* El pattern queda algo asi array ('({.*?})','({.*?})'); el tmpval array ('value1','value2')
                    de esta manera la key pasa de ser some-{variable}-page-{page} a some-value1-page-value2 que utilizara el dispatcher */
                    $key=preg_replace($patterns,$tmpval,$key,1);

                    return $key;

                }


            }



        }
        throw new \Exception("Unable to find route");

    }


}