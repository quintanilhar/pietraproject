<?php

class DynamicUrlRule extends CBaseUrlRule
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
        $url = $this->findUrl($pathInfo);

        if ($url !== null) {

            switch ($url->type) {
                case Url::TYPE_PAGE:       return 'page/index'; 
                case Url::TYPE_CATEGORY:   return 'category/index'; 

                default:
                    throw new UnexpectedValueException(
                        'Fail to determine the correct controller.'
                    );
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
