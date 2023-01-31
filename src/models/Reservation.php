<?php

namespace Yc\CineHallBackend\models;

use sixon\hwFramework\db\DbModel;

class Reservation extends DbModel
{
    public $idUser;

    public $idFilm;
    public $numSeat;


    public static function tableName(): string
    {
        return 'reservation';
    }

    public function attributes(): array
    {
        return ['idUser', 'idFilm', 'numSeat'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'idUser'=>[self::RULE_REQUIRED],
            'idFilm'=>[self::RULE_REQUIRED],
            'numSeat'=>[self::RULE_REQUIRED]
        ];

    }
    public function validate(): bool
    {
        if(intval($this->numSeat) > 50 || intval($this->numSeat) < 1 ){
            $this->addError('numSeat','seat out of Range');
        }
        return parent::validate();
    }

    public function labels(): array
    {
        return [];
    }
}