<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 13/6/15
 * Time: 15:01
 */

namespace Fw\Components\Routing\RouteParser;
use Fw\Components\Routing\RouteParser;
use Symfony\Component\Yaml\Parser;


class YmlParser implements  RouteParser{

    private $genparse;
    private $toparse;


    function __construct($toparse,GenericParser $genparse)
    {
        $this->genparse=$genparse;
        $this->toparse=$toparse;
    }

    public function parse($path_info)
    {

        try {
            $yaml = new Parser();
            $array = $yaml->parse(file_get_contents($this->toparse));
            $this->genparse->setArray($array);

            return $this->genparse->parse($path_info);
        }catch (\Exception $e){
            echo $e->getMessage();
        }

    }


}
