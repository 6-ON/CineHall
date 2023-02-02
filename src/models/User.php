<?php

namespace Yc\CineHallBackend\models;

use sixon\hwFramework\UserModel;

class User extends UserModel
{

    public $email;
    public $firstName;
    public $lastName;
    public $image;

    public static function tableName(): string
    {
        return 'user';
    }

    public function attributes(): array
    {
        return ['email', 'firstName', 'lastName', 'image'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'image' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [];
    }

    public function getDisplayName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getDisplayEmail(): string
    {
        return $this->email;
    }
}