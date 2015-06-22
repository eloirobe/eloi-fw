<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 22/6/15
 * Time: 18:05
 */

namespace Fw\Components\Response;



class WebResponse {
    private $headers;
    private $content;
    private $template;


    function __construct($content, $template)
    {
        $this->content = $content;
        $this->template = $template;
    }



    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
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




}