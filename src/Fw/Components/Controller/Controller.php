<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 17/6/15
 * Time: 20:44
 */

namespace Fw\Components\Controller;

use Fw\Components\Container\Container;
use Fw\Components\Request\Request;

interface Controller {

   function __invoke(Request $request,Container $container);

}