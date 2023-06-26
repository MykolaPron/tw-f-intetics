<?php

namespace app\models;

use app\core\DbModel;

class Message extends DbModel
{
    public string $message = '';

    protected function tableName(): string
    {
        return 'message';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'message' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 3],
//                [self::RULE_MAX, 'max' => 24],
//                [self::RULE_UNIQUE, 'class' => self::class]
            ]
        ];
    }

    public function labels(): array
    {
        return ['message' => 'Message'];
    }

    public function attributes(): array
    {
        return ['message'];
    }
}