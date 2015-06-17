<?php
namespace Fw\Components\Dispatcher;
use Symfony\Component\Yaml\Parser;


class httpYmlDispatcher implements Dispatcher {

    private $gendispatcher;
    private $filecontrollers;

    function __construct($filecontrollers,GenericDispatcher $gendispatcher)
    {
        $this->gendispatcher=$gendispatcher;
        $this->filecontrollers=$filecontrollers;
    }

    public function dispatch($key)
    {
        $yaml = new Parser();
        $array = $yaml->parse(file_get_contents($this->filecontrollers));
        $this->gendispatcher->setArray($array);
        $cont=$this->gendispatcher->dispatch($key);
        $controller=new $cont;
        $controller(new Request($_GET,$_POST,$_SERVER));
    }


}