<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 21/6/15
 * Time: 15:45
 */
namespace Fw\Components\View;


class JsonView implements View {

    private $content;

    public function render()
    {
        echo json_encode($this->content);
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