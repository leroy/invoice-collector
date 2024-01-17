<?php

namespace App\Models;

use App\Actions\Mail\Connect;
use App\Enums\MailboxStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Webklex\PHPIMAP\Client;

class Mailbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'email',
        'password',
        'imap',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'encrypted',
        'status' => MailboxStatus::class
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Mail::class);
    }

    public function connect(): Client
    {
        return Connect::run($this);
    }
}
