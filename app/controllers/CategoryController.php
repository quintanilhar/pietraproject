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

        $this->render(
            '/category',
            array(
                'category' => $category,
            )
        );
    }
}
