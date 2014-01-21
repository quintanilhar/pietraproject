<?php

class BlogSiteController extends Controller
{
	public $layout='//layouts/blog';

    public function actionIndex()
    {
        $dataProvider = $this->getDataProvider();

        if(isset($_GET['tag']))
            $dataProvider->criteria->addSearchCondition('tags',$_GET['tag']);

        $this->render(
            'index',
            array(
                'posts' => $dataProvider
            )
        );
    }

    public function actionCategory()
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

        $dataProvider = $this->getDataProvider();
        $criteria = $dataProvider->criteria;
        $criteria->with=array(
            'categories' => array(
                'select' => false,
                'joinType' => 'INNER JOIN'
            )
        );
        $criteria->together = true;
        $criteria->addCondition('categories.category_id = :id');
        $criteria->params = array(':id' => $category->category_id);

        $this->render(
            'category',
            array(
                'category' => $category,
                'posts' => $dataProvider
            )
        );
    }

    public function actionPost()
    {

        $url = Yii::app()->getRequest()->pathInfo;

        $post = Page::model()->with('url')->find(
            'url = :url',
            array(':url' => $url)
        );

        if ($post === null) {
            throw new CHttpException(404, 'Page not found.');
        }

        $this->pageTitle = $post->title;

        $this->render(
            'post',
            array(
                'post' => $post
            )
        );
    }

    protected function getDataProvider()
    {
        $criteria=new CDbCriteria(array(
            'alias' => 'p',
            'condition'=>'p.scope_id='.Scope::BLOG_SCOPE,
            'order'=>'created_date DESC',
        ));

        return new CActiveDataProvider('Page', array(
            'pagination'=>array(
                'pageVar' => BlogConfig::PAGE_VAR,
                'pageSize' => BlogConfig::getPostsPerPage()
            ),
            'criteria'=>$criteria,
        ));

    }
}
