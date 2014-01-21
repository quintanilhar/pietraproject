<?php

class NetworkButton extends CWidget
{
    public $url;

    public $title;

    public function init()
    {
    }

    public function twitterUrl()
    {
        echo sprintf(
            'https://twitter.com/share?url=%s&text=%s&lang=pt',
            urlencode(Yii::app()->createAbsoluteUrl($this->url)),
            $this->title
        );
    }

    public function facebookUrl()
    {
        echo sprintf(
            'http://www.facebook.com/sharer.php?&u=%s&t=%s',
            urlencode(Yii::app()->createAbsoluteUrl($this->url)),
            $this->title
        );
    }
}
