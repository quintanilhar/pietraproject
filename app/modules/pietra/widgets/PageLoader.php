<?php

Yii::import('pietra.models.Page');

class PageLoader extends CWidget
{
    private $page;

    public function init()
    {
        if ($this->page === null) {
            $this->page = Page::model();
        }
    }

    public function run()
    {
    }

    public function getById($id)
    {
        return $this->page->findByPk((int)$id); 
    }
}
