<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 14/6/15
 * Time: 20:47
 */

namespace Fw\Components\Routing\RouteParser;

use Fw\Components\Routing\RouteParser;

abstract class GenericParser implements RouteParser{

    protected $toparse;

    function __construct($toparse)
    {
        $this->toparse=$toparse;
    }

    abstract public function parse();


}