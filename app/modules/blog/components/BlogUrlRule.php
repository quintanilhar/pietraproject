<?php

Yii::import('blog.models.BlogConfig');

class BlogUrlRule extends CBaseUrlRule
{
    public function createUrl($manager,$route,$params,$ampersand)
    {
        if (isset($params['isDynamic'])) {
            return $route;
        }
        return false;  // this rule does not apply
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {

        $home = BlogConfig::getHomeUrl();

        if ($home == $pathInfo) {
            return 'blogSite/index';
        }
        
        $url = $this->findUrl($pathInfo);

        if ($url !== null) {
            if ($url->type == Url::TYPE_PAGE) {
                if ($url->page->scope_id == Scope::BLOG_SCOPE) {
                    return 'blogSite/post'; 
                }

                return false;
            }

            if ($url->type == Url::TYPE_CATEGORY) {
                if ($url->category->scope_id == Scope::BLOG_SCOPE) {
                    return 'blogSite/category'; 
                }

                return false;
            }
        }
        return false;
    }

    protected function findUrl($url)
    {
        return Url::model()->find(
            'url = :url',
            array(':url' => $url)
        );
    } 
}
