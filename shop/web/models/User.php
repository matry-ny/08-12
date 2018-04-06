<?php

namespace app\web\models;

use app\common\components\db\ActiveRecord;

/**
 * Class User
 * @package app\web\models
 * @property int $id
 * @property string $name
 */
class User extends ActiveRecord
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'users';
    }
}