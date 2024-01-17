<?php

namespace App\Enums;

enum MailboxStatus: string
{
    case Created = 'created';
    case Processing = 'processing';
}
