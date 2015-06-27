<?php
namespace Fw\Components\Dispatcher;
use Fw\Components\Request\Request;
use Symfony\Component\Yaml\Parser;


class HttpYmlDispatcher implements Dispatcher {


    private $gendispatcher;
    private $filecontrollers;
    private $mypdo;
    private $container;

    function __construct($filecontrollers,GenericDispatcher $gendispatcher)
    {
        $this->gendispatcher=$gendispatcher;
        $this->filecontrollers=$filecontrollers;
    }

    /**
     * @param mixed $mypdo
     */
    public function setMypdo($mypdo)
    {
        $this->mypdo = $mypdo;
    }

    public function dispatch($key)
    {
        $yaml = new Parser();
        $array = $yaml->parse(file_get_contents($this->filecontrollers));
        $this->gendispatcher->setArray($array);
        $cont = $this->gendispatcher->dispatch($key);
        $controller = new $cont;
        $response = $controller(new Request(
            array(
                "get" => $_GET,
                "post" => $_POST,
                "server" => $_SERVER,
                "files" => $_FILES,
                "variables" => $this->gendispatcher->getValues()
            )
        ), $this->container);

        return $response;
    }

    /**
     * @param mixed $dispatcher
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

}
