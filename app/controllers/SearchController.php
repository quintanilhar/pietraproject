<?php

class SearchController extends Controller
{
    public function actionIndex()
    {
        $keyword = filter_var($_GET['keyword'], FILTER_SANITIZE_STRING);
        $keyword = filter_var($keyword, FILTER_SANITIZE_MAGIC_QUOTES);

        if (empty($keyword)) {
            $this->redirect(Yii::app()->user->returnUrl);
        }

        $criteria=new CDbCriteria(array(
            'alias' => 'p',
            'order'=>'p.scope_id ASC',
        ));

        $criteria->addSearchCondition('title', $keyword, true, 'OR');
        $criteria->addSearchCondition('small_description', $keyword, true, 'OR');
        $criteria->addSearchCondition('description', $keyword, true, 'OR');

        $dataProvider = new CActiveDataProvider('Page', array(
            'pagination'=>array(
                'pageVar' => 'page',
                'pageSize' => 10,
            ),
            'criteria'=>$criteria,
        ));

        $this->render(
            '/site/search',
            array(
                'pages' => $dataProvider,
                'keyword' => $keyword
            )
        );
    }
}
