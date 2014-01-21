<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<style type="text/css">

body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
      max-width: 330px;
        padding: 15px;
        margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

<div class="container">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions' => array(
            'class' => 'form-signin',
            'role' => 'form'
        )
    )); ?>

        <h2 class="form-signin-heading">Please sign in</h2>

        <?php echo $form->errorSummary($model, null, null, array('class'=> 'alert alert-danger')); ?>
            
        <?php
            echo $form->textField(
                $model,
                'email',
                array(
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                )
            );
        ?>
        
        <?php 
            echo $form->passwordField(
                $model,
                'password',
                array(
                    'class' => 'form-control',
                    'placeholder' => 'Senha'
                )
            );
        ?>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

    <?php $this->endWidget(); ?>
</div>
