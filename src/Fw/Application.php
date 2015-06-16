<?php

namespace Fw;


use Fw\Components\Dispatcher\Dispatcher;
use Fw\Components\Routing\RouteParser;

final class Application
{
    private $routing_component;
    private $dispatcher_component;
    private $path_info;



    public function run()
    {

        $key=$this->routing_component->parse($this->path_info);
        return $this->dispatcher_component->dispatch($key);

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


