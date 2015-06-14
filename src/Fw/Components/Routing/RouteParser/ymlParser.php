<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 13/6/15
 * Time: 15:01
 */

namespace Fw\Components\Routing\RouteParser;
use Symfony\Component\Yaml\Parser;


class ymlParser extends GenericParser{

    public function parse()
    {
        try {

            $yaml = new Parser();
            $value = $yaml->parse(file_get_contents($this->toparse));

            return $value;

        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
    }


}