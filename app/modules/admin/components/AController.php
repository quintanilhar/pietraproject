<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AController extends CController
{
    public $layoutPath;
	/**
	 * @var string the default layout for the controller view.
	 */
	public $layout='//layouts/full';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
    public $menu = array(
        'Categories' => array('admin/category/index'),
        'Pages' => array('admin/page/index'),
        'Media' => array('admin/media/index'),
        'Users' => array('admin/adminUser/index'),
        'Banner' => array('admin/banner/index'),
        'Blog' => array(
            'submenu' => array(
                'Posts' => array('admin/blogPost/index'),
                'Categories' => array('admin/blogCategory/index'),
                'Configuration' => array('admin/blogConfig/index'),
            ),
        ),
    );
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}
