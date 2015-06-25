<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 25/6/15
 * Time: 19:24
 */
namespace Fw\Components\Container;

use Symfony\Component\Yaml\Parser;

class ServiceYmlContainer {

    private $yaml;
    private $parameters;


    function __construct($route)
    {
        $yaml = new Parser();
        $this->yaml = $yaml->parse(file_get_contents($route));
    }

    function get($servicename)
    {
        $currentservice=$this->yaml['services'][$servicename];

        $otherservices=$this->getServicesFromArguments($currentservice['arguments']);

        $servicesarguments=$this->updateParametersArguments($currentservice['arguments']);

        foreach ($otherservices as $o){
            $tmpserviceargument=$this->get($o);

            //replace $o by $tmpserviceargument
            $i = array_search("@".$o, $servicesarguments);
            $servicesarguments[$i]=$tmpserviceargument;

        }

        $class= new \ReflectionClass($currentservice['class']);
        $instance = $class->newInstanceArgs($servicesarguments);
        return $instance;
        //return new $currentservice['class']($servicesarguments);


    }

    function getServicesFromArguments($arguments)
    {
        $tmp=array();
        foreach ($arguments as $c){
            if ($c[0]=='@'){
                $tmp[]=str_replace("@","",$c);
            }
        }
        return $tmp;
    }

    function updateParametersArguments($params)
    {
        $tmp=array();
        foreach ($params as $p){
            if (preg_match('/\%(.*?)\%/',$p,$match)) {
                $serviceparam=$this->parameters[$match[1]];
                $tmp[]=str_replace($match[0],$serviceparam,$p);
            }else{
                $tmp[]=$p;
            }
        }
        return $tmp;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    public function  setParameter($name,$parameter)
    {
        $this->parameters[$name]=$parameter;
    }



}