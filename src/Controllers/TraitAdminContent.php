<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Layout\Content;

trait TraitAdminContent
{
    protected $content;

    /**
     * @return Content
     */
    protected function content()
    {
        $content = new Content();
        $content->header($this->getHeader())->description($this->getDescription());
        return $content;
    }
    /**
     * @param $header
     * @return $this
     */
    protected function header($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param $description
     * @return $this
     */
    protected function description($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param $content
     * @return Content
     */
    protected function body($content)
    {
        return $this->content()->body($content);
    }

    /**
     * @return mixed
     */
    protected function getDescription()
    {
        return isset($this->description) ? $this->description : ' ';
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return isset($this->header) ? $this->header : '';
    }
}
