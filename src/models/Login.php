<?php

namespace Yc\CineHallBackend\models;

use sixon\hwFramework\Application;
use sixon\hwFramework\db\DbModel;

class Login extends DbModel
{

    public $id;

    public static function tableName(): string
    {
        return 'user';
    }

    public function attributes(): array
    {
        return ['id'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return ['id' => [self::RULE_REQUIRED]];
    }

    public function labels(): array
    {
        return [];
    }

    public function login(): bool
    {
        $user = User::findOne(['id'=>$this->id]);
        if (!$user){
            $this->addError('id','user not found');
            return false;
        }
        return Application::$app->login($user);
    }
}