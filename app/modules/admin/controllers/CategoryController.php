<?php

class CategoryController extends AController
{
    public $activeMenu = 'category';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $this->layout = null;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' category.
	 */
	public function actionCreate()
	{
		$model = new Category('create');
		$url = new Url('create');

		if (isset($_POST['Category'])) {
			$model->attributes=$_POST['Category'];
            $model->url_id = 'temp';

			$url->attributes=$_POST['Url'];
            $url->type = Url::TYPE_CATEGORY;

			if ($model->validate() && $url->validate()) {
                $url->save(false);

                $model->url_id = $url->url_id;

                if ($model->save(false)) {
                    Yii::app()->user->setFlash(
                        'success',
                        Yii::t(
                            'admin',
                            'The category {title} has been created!',
                            array('{title}' => $model->title)
                        )
                    );

			    	$this->redirect(array('index'));
                }
            }
		}

		$this->render('create',array(
			'model' => $model,
            'url' => $url
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' category.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $url = $model->url;
        $url->setScenario('update');

		if (isset($_POST['Category'])) {
			$model->attributes = $_POST['Category'];
            $url->attributes = $_POST['Url'];

            if ($model->validate() && $url->validate()) {
                $model->save(false);
                $url->save(false);

                Yii::app()->user->setFlash(
                    'success',
                    Yii::t(
                        'admin',
                        'The category {title} has been updated!',
                        array('{title}' => $model->title)
                    )
                );

                $this->redirect(array('index'));
            }
		}

		$this->render('update', array(
            'model' => $model,
            'url' => $url
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' category.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        $model->delete();

        Yii::app()->user->setFlash(
            'success',
            Yii::t(
                'admin',
                'The category {title} has been deleted!',
                array('{title}' => $model->title)
            )
        );
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
        $model->scope_id = Scope::DEFAULT_SCOPE;
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AdminUser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
        $model->setScenario('update');
		if($model===null)
			throw new CHttpException(404,'The requested category does not exist.');
		return $model;
	}
}
