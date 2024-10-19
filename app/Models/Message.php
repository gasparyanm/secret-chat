<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 *
 * @property int $id
 * @property string $text
 * @property string $recipient
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property string $decryption_key
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'recipient',
        'expires_at',
        'decryption_key',
        'is_read',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_read' => 'boolean',
    ];
}
