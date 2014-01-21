<?php

Yii::import('pietra.helpers.HomeUrlNormalized');

class BlogConfig extends CModel
{
    const CONFIG_NAME = 'blogName';
    const CONFIG_HOME_URL = 'homeBlog';
    const CONFIG_POSTS_PER_PAGE = 'postsPerPage';
    const PAGE_VAR = 'page';

    protected static $name;

    protected static $homeUrl;

    protected static $postsPerPage; 

    public static function getName()
    {
        if (self::$name === null) {
            self::$name = self::getConfig(self::CONFIG_NAME); 
        }

        return self::$name;
    }

    public static function getHomeUrl()
    {
        if (self::$homeUrl === null) {
            self::$homeUrl = self::getConfig(self::CONFIG_HOME_URL); 
        }

        return self::$homeUrl;
    }

    public static function getFullHomeUrl()
    {
        return HomeUrlNormalized::get() . self::getHomeUrl();
    }

    public static function getPostsPerPage()
    {
        if (self::$postsPerPage === null) {
            self::$postsPerPage = self::getConfig(self::CONFIG_POSTS_PER_PAGE); 
        }

        return self::$postsPerPage;
    }

    protected static function getConfig($name)
    {
        return Config::model()->getConfig($name);
    }

	public function attributeNames()
    {

    }
}
