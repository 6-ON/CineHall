<?php

namespace Yc\CineHallBackend\models;

use sixon\hwFramework\Application;
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
        //execute Model validation
        parent::validate();

        // add some custom validations
        if(intval($this->numSeat) > 50 || intval($this->numSeat) < 1 ){
            $this->addError('numSeat','seat out of Range');
        }

        $tableName = self::tableName();
        $stmt = Application::$app->db->prepare("SELECT * FROM $tableName WHERE idFilm  = :idFilm AND numSeat  = :numSeat");
        $stmt->bindValue(':idFilm', $this->idFilm);
        $stmt->bindValue(':numSeat', $this->numSeat);
        $stmt->execute();
        $record = $stmt->fetchObject();
        if ($record) {
            $this->addError('numSeat', 'this Seat is Already Reserved !');
        }
        return empty($this->errors);

    }

    public function labels(): array
    {
        return [];
    }
}