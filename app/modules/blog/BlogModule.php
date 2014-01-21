<?php

class BlogModule extends CWebModule
{
	public function init()
    {
        parent::init();

        $this->setImport(array(
            'blog.components.*',
            'blog.models.*',
        ));
    }
}
