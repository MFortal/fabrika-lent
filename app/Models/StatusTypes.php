<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTypes extends Model
{
    use HasFactory;

    const AVAILABLE = 'available';
    const UNAVAILABLE = 'unavailable';

    public static function Available()
    {
        return self::AVAILABLE;
    }

    public static function Unavailable()
    {
        return self::UNAVAILABLE;
    }
}
