<?php

namespace Yc\CineHallBackend\models;

use sixon\hwFramework\db\DbModel;

class Login extends DbModel
{

    public static function tableName(): string
    {
        return 'user';
    }

    public function attributes(): array
    {
        return [];
    }

    public static function primaryKey(): string
    {
        return  'id';
    }

    public function rules(): array
    {
        return [];
    }

    public function labels(): array
    {
        return [];
    }
}