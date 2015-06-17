<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 17/6/15
 * Time: 20:44
 */

namespace Fw\Components\Controller;

interface Controller {

   function __invoke(Request $request);

}