<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 13/6/15
 * Time: 15:00
 */

namespace Fw\Components\Routing;


interface  RouteParser {

    public function parse($path_info);

}