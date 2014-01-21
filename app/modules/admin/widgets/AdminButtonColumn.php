<?php

Yii::import('zii.widgets.grid.CButtonColumn');

class AdminButtonColumn extends CButtonColumn
{
    public $htmlOptions = array(
        'width' => 100
    );

    public $buttons = array(
        'view' => array(
            'label' => '<span class="glyphicon glyphicon-search"></span>',
            'imageUrl' => false,
            'options' => array(
                'class'=>'view btn btn-default btn-xs',
                'data-toggle' => 'modal',
                'data-target' => '#modal',
            )
        ),

        'update' => array(
            'label' => '<span class="glyphicon glyphicon-pencil"></span>',
            'imageUrl' => false,
            'options' => array(
                'class'=>'btn btn-default btn-xs',
            )
        ),

        'delete' => array(
            'label' => '<span class="glyphicon glyphicon-remove"></span>',
            'imageUrl' => false,
            'options' => array(
                'class'=>'delete btn btn-default btn-xs',
            ),
        ),
    );
}
