<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 28/6/15
 * Time: 0:03
 */

namespace Fw\Components\Routing\RouteParser;


class PhpParser extends GenericParser
{

    private $genparse;
    private $toparse;


    function __construct($toparse,GenericParser $genparse)
    {
        $this->genparse = $genparse;
        $this->toparse = $toparse;
    }

    public function parse($path_info)
    {

        require $path_info;
        $this->genparse->setArray($routing);

        return $this->genparse->parse($path_info);


    }
}