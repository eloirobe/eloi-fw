<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 14/6/15
 * Time: 20:54
 */

namespace Fw\Components\Routing\RouteParser;




class JsonParser extends GenericParser {

    private $genparse;
    private $toparse;


    function __construct(GenericParser $genparse,$toparse)
    {
        $this->genparse=$genparse;
        $this->toparse=$toparse;
    }

    public function parse($path_info)
    {

        $json = json_decode(file_get_contents($this->toparse), true);

        $this->genparse->setArray($json);

        return $this->genparse->parse($path_info);


    }

}