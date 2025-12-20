<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';

    case MANAGER = 'manager';

    case USER = 'user';

    public function label(): string
    {
        return match ($this) {

            self::ADMIN => 'Администратор',

            self::MANAGER => 'Менеджер',

            self::USER => 'Пользователь'

        };
    }
}
