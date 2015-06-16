<?php

namespace Fw;


use Fw\Components\Dispatcher\GenericDispatcher;
use Fw\Components\Routing\RouteParser;

final class Application
{
    private $routing_component;
    private $dispatcher_component;
    private $path_info;



    public function run()
    {
        echo "Bye earth! Welcome to universe";
        $key=$this->routing_component->parse($this->path_info);
        $key=$this->dispatcher_component->dispatch($key);
        var_dump($key);
    }

    function setPathInfo($path_info)
    {
        $this->path_info=$path_info;
    }

    function setRouting (RouteParser $routing_component)
    {
        $this->routing_component=$routing_component;
    }


    function setDispatcher (Dispatcher $dispatcher_component)
    {
        $this->dispatcher_component=$dispatcher_component;
    }

}


