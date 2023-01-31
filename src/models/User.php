<?php

namespace Yc\CineHallBackend\models;

use sixon\hwFramework\UserModel;

class User extends UserModel
{

    public $email;
    public $firstName;
    public $lastName;
    public $token;
    public $image;

    public static function tableName(): string
    {
        return 'user';
    }

    public function attributes(): array
    {
        return ['firstName', 'lastName', 'token', 'image'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return ['firstName', 'lastName', 'token', 'image'];
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