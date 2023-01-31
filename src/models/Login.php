<?php

namespace Yc\CineHallBackend\models;

use sixon\hwFramework\db\DbModel;

class Login extends DbModel
{

    public $token;

    public static function tableName(): string
    {
        return 'user';
    }

    public function attributes(): array
    {
        return ['token'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return ['token' => [self::RULE_REQUIRED]];
    }

    public function labels(): array
    {
        return [];
    }
}