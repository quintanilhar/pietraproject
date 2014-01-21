<?php

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $url = Yii::app()->getRequest()->pathInfo;

        $category = Category::model()->with('url')->find(
            'url = :url',
            array(':url' => $url)
        );

        if ($category === null) {
            throw new CHttpException(404, 'Page not found.');
        }

        $this->pageTitle = $category->title;

        $template = '/site/category';

        switch ($category->category_id) {
            case 1: $template = '/site/consultoria'; break;
            case 2: $template = '/site/servicos'; break;
        }

        $this->render(
            $template,
            array(
                'category' => $category,
            )
        );
    }
}
