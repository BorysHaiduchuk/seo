<?php
namespace boryshaiduchuk\seo\service;

use boryshaiduchuk\models\SeoRedirect;

/**
 * Class to redirect to the specified page
 */
class Redirect
{
    public static function init()
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $model = SeoRedirect::findOne(['from_url' => $requestUrl]);
        if ($model) {
            $url = $model->to_url;
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: $url");
            exit();
        }
    }
}