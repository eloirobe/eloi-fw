<?php

namespace Fw;

use Routing\RouteParse;

final class Application
{
    private $routing_component;

    public function run()
    {
        echo "Bye earth! Welcome to universe";
        $keys=$this->routing_component->parse();
        var_dump($keys);
    }

    function setRouting (RouteParse $routing_component)
    {
        $this->routing_component=$routing_component;
    }

}


