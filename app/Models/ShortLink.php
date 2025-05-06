<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string slug
 * @property string destination_url
 * @property bool is_active
 * @property Carbon expires_at
 */
class ShortLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'destination_url',
        'is_active',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean'
    ];
}
