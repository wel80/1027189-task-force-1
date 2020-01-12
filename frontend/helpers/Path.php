<?php

namespace frontend\helpers;
use yii\helpers\Url;

class Path
{
    const DEFAULT_AVATAR = "/img/empty-avatar.png";

    /**
     * @return string
     */
    public static function toAvatar(?string $path)
    {
        if ($path) {
            return Url::to($path);
        }

        return Url::to(self::DEFAULT_AVATAR);
    }
}