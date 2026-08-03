<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

final class Database
{
    public static function connection(): PDO
    {
        return \getPDO();
    }
}