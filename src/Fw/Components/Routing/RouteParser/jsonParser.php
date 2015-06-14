<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 14/6/15
 * Time: 20:54
 */

namespace Fw\Components\Routing\RouteParser;


class jsonParser extends GenericParser {
    public function parse()
    {

        $json = json_decode(file_get_contents($this->toparse), true);

        return $json;

    }


}