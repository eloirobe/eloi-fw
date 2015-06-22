<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 22/6/15
 * Time: 20:12
 */

namespace Fw\Components\Response;


class JsonResponse {
    private $headers;
    private $content;

    function __construct($content)
    {
        $this->content = $content;
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
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }



}