<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Layout\Content;

trait ContentHeader
{
    protected $content;

    protected function content()
    {
        $content = new Content();
        $content->header($this->getHeader())->description($this->getDescription());
        return $content;
    }
    protected function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return isset($this->description) ? $this->description : ' ';
    }

    /**
     * @param $header
     * @return $this
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return isset($this->header) ? $this->header : '';
    }
}
