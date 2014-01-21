<?php

class PageController extends AController
{
    public $activeMenu = 'page';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Page('create');
		$url = new Url('create');
		$media = new Media('create');

		if (isset($_POST['Page'])) {
			$model->attributes=$_POST['Page'];
            $model->url_id = 'temp';

			$url->attributes=$_POST['Url'];

            $url->type = Url::TYPE_PAGE;

			if ($model->validate() && $url->validate()) {
                if ($url->save(false)) {

                    $model->url_id = $url->url_id;

                    $media->attributes = $_POST['Media'];
                    $media->title = $model->title;
                    $media->file = CUploadedFile::getInstance($media,'file');
                    if ($media->save()) {
                        $model->media = array($media->media_id);
                    }

                    if ($model->save(false)) {

                        Yii::app()->user->setFlash(
                            'success',
                            Yii::t('admin', 'The page {title} has been created!', array('{title}' => $model->title))
                        );
                        $this->redirect(array('index'));
                    }
                }
            }
		}

		$this->render('create',array(
			'model'         => $model,
            'url'           => $url,
            'media'         => $media,
            'categories'    => $this->getCategories()
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        $url = $model->url;
        $url->setScenario('update');

        if (count($media = $model->media) > 0) {
            $media = $media[0];
            $media->setScenario('update');
        } else {
            $media = new Media('create');
        }

		if (isset($_POST['Page'])) {
			$model->attributes = $_POST['Page'];
            $url->attributes = $_POST['Url'];

            if ($model->validate() && $url->validate()) {

                /** Upload a file **/
                $media->attributes = $_POST['Media'];
                $media->title = $model->title;
                $media->file = CUploadedFile::getInstance($media,'file');
                if ($media->save()) {
                    $model->media = array($media->media_id);
                }

                $model->save(false);
                $url->save(false);

                Yii::app()->user->setFlash(
                    'success',
                    Yii::t('admin', 'The page {title} has been updated!', array('{title}' => $model->title))
                );

                $this->redirect(array('index'));
            }
		}

		$this->render('update', array(
            'model' => $model,
            'url' => $url,
            'media' => $media,
            'categories' => $this->getCategories()
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        $model->delete();

        Yii::app()->user->setFlash(
            'success',
            Yii::t('admin', 'The page {title} has been deleted!', array('{title}' => $model->title))
        );

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/page/index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Page('search');
		$model->unsetAttributes();  // clear any default values
        $model->scope_id = Scope::DEFAULT_SCOPE;
		if(isset($_GET['Page']))
			$model->attributes=$_GET['Page'];

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
		$model=Page::model()->findByPk($id);
        $model->setScenario('update');
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    protected function getCategories()
    {
        $categories = array();
        foreach (Category::model()->site()->findAll() as $category) {
            $categories[$category->category_id] = $category->title;
        }
        return $categories;
    }
}
