<?php

namespace Fw;


use Fw\Components\Container\Container;
use Fw\Components\Dispatcher\Dispatcher;
use Fw\Components\Routing\RouteParser;
use Fw\Components\Response\JsonResponse;
use Fw\Components\Response\WebResponse;
use Fw\Components\View\JsonView;
use Fw\Components\View\WebView;
use Fw\Components\Database\Database;


final class Application
{
    private $routing_component;
    private $dispatcher_component;
    private $path_info;
    private $webcomponent;
    private $jsoncomponent;
    private $mypdo;
    private $container;


    public function run()
    {
        $this->routing_component=$this->container->get('Routing');
        $this->dispatcher_component=$this->container->get('Dispatcher');


        $key = $this->routing_component->parse($this->path_info);
        $this->dispatcher_component->setContainer($this->container);
        $response = $this->dispatcher_component->dispatch($key);

        if ($response instanceof WebResponse) {
            $this->webcomponent=$this->container->get('WebViewTwig');
            $this->webcomponent->setTemplate($response->getTemplate());
            $this->webcomponent->setContent($response->getContent());
            $this->webcomponent->render();

        } elseif ($response instanceof JsonResponse) {
            $this->jsoncomponent=$this->container->get('JsonView');
            $this->jsoncomponent->setContent($response->getContent());
            $this->jsoncomponent->render();
        }
    }

    function setPathInfo($path_info)
    {
        $this->path_info = $path_info;
    }

    function setRouting(RouteParser $routing_component)
    {
        $this->routing_component = $routing_component;
    }

    function setDispatcher(Dispatcher $dispatcher_component)
    {
        $this->dispatcher_component = $dispatcher_component;
    }

    function setWebComponent(WebView $webcomponent)
    {
        $this->webcomponent = $webcomponent;
    }

    function setJsonComponent(JsonView $jsoncomponent)
    {
        $this->jsoncomponent = $jsoncomponent;
    }

    public function setMypdo(Database $mypdo)
    {
        $this->mypdo = $mypdo;
    }

    public function setContainer(Container $container)
    {
        $this->container=$container;
    }



}


