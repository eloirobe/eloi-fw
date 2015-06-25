<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 25/6/15
 * Time: 19:24
 */

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

    function get($service)
    {

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