<?php

class HomeUrlNormalized
{
    public static function get()
    {
        $homeUrl = Yii::app()->homeUrl;

        if (substr($homeUrl, -1) != '/') {
            $homeUrl .= '/';
        }

        return $homeUrl;
    }
}
