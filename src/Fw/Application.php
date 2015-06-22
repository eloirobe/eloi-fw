<?php

namespace Fw;


use Fw\Components\Dispatcher\Dispatcher;
use Fw\Components\Routing\RouteParser;
use Fw\Components\Response\JsonResponse;
use Fw\Components\Response\WebResponse;
use Fw\Components\View\JsonView;
use Fw\Components\View\WebView;


final class Application
{
    private $routing_component;
    private $dispatcher_component;
    private $path_info;
    private $webcomponent;
    private $jsoncomponent;



    public function run()
    {
        $key=$this->routing_component->parse($this->path_info);
        $response=$this->dispatcher_component->dispatch($key);

       if ( $response instanceof WebResponse){
            $this->webcomponent->setTemplate($response->getTemplate());
            $this->webcomponent->setContent($response->getContent());
            $this->webcomponent->render();

       }elseif ( $response instanceof JsonResponse) {
            $this->jsoncomponent->setContent($response->getContent());
            $this->jsoncomponent->render();
       }
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

    function setWebComponent ( WebView $webcomponent )
    {
        $this->webcomponent=$webcomponent;
    }

    function setJsonComponent ( JsonView $jsoncomponent )
    {
        $this->$jsoncomponent=$jsoncomponent;
    }

}


