<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'mailbox_id',
        'subject',
        'from',
        'from_hash',
        'from_name',
        'to',
        'body',
        'attachment',
    ];

    public function senderId(): Attribute
    {
        return new Attribute(function () {
            return sha1($this->from);
        });
    }
}
