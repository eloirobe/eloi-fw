<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 26/6/15
 * Time: 20:50
 */

namespace Fw\Components\Container;


interface Container {

    public function get($servicename);

}