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
        var_dump($this->yaml);
    }

    function get($servicename)
    {
        $currentservice=$this->yaml['services'][$servicename];

        $otherservices=$this->getServicesFromArguments($currentservice['arguments']);

        $servicesarguments=$this->updateParametersArguments($currentservice['arguments']);

        foreach ($otherservices as $o){
            $tmpserviceargument=$this->get($o);

            //replace $o by $tmpserviceargument
            $servicesarguments["@".$o]=$tmpserviceargument;

        }

        return new $currentservice['class']($servicesarguments);


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
            if (preg_match_all('/\%(.*?)\%/',$p,$match)) {
                $serviceparam=$this->parameters[$match];
                $tmp[]=$serviceparam;
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