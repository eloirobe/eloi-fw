<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 21/6/15
 * Time: 15:46
 */
namespace Fw\Components\View;


class WebViewTwig implements WebView {

    private $twig;
    private $plantilla;
    private $content;

    function __construct($twig)
    {
        $this->twig = $twig;
    }
    public function render()
    {

        echo $this->twig->render($this->plantilla, $this->content);

    }
    /**
     * @return mixed
     */
    public function getPlantilla()
    {
        return $this->plantilla;
    }

    /**
     * @param mixed $plantilla
     */
    public function setPlantilla($plantilla)
    {
        $this->plantilla = $plantilla;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


}