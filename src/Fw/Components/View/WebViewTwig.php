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
    private $template;
    private $content;

    function __construct($twig)
    {
        $this->twig = $twig;
    }
    public function render()
    {

        return $this->twig->render($this->template, $this->content);

    }
    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
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