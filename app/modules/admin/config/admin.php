<?php
return array(

	'import' => array(
		'admin.models.*',
		'admin.components.*',
	),

    'components' => array(
        'themeManager' => array(
            'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '../themes', 
            'name' => 'bootstrap',
        )
    ),

    'menu' => array(
        'Consultoria' => array('category/')
    )
);
