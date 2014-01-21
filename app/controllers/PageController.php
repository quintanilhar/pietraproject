<?php

Yii::import('pietra.models.Page');

class PageController extends Controller
{
    public function actionIndex()
    {
        $url = Yii::app()->getRequest()->pathInfo;
        
        $page = Page::model()->with('url')->find(
            'url = :url',
            array(':url' => $url)
        );

        if ($page === null) {
            throw new CHttpException(404, 'Page not found.');
        }

        $this->render(
            'index',
            array(
                'page' => $page
            )
        );
    }
}
