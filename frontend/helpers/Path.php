<?php

namespace frontend\helpers;

use yii\helpers\Url;
use frontend\models\User;

class Path
{
    const DEFAULT_AVATAR = "/img/empty-avatar.png";

    /**
     * @return string
     */
    public static function toAvatar(User $author)
    {
        if ($author->profile && $author->profile->avatar) {
            return Url::to($author->profile->avatar);
        }

        return Url::to(self::DEFAULT_AVATAR);
    }
}