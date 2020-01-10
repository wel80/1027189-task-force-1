<?php

namespace frontend\helpers;
use yii\helpers\Url;

class Path
{
    /**
     * @return string
     */
    public static function toAvatar(string $path) : string
    {
        if ($path) {
            return Url::to($path, true);
        }

        return Url::to("/img/empty-avatar.png", true);
    }
}