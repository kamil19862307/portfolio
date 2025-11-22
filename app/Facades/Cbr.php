<?php

namespace App\Facades;

use App\Services\CbrService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getUsd (string|null $date = null)
 */
class Cbr extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CbrService::class;
    }
}