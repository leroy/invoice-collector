<?php

namespace App\Actions\Mail;

use App\Models\Mailbox;
use Lorisleiva\Actions\Concerns\AsAction;
use Webklex\PHPIMAP\Client;

class Connect
{
    use AsAction;

    public function handle(Mailbox $mailbox): Client
    {
        return \Webklex\IMAP\Facades\Client::make([
            'host' => $mailbox->imap,
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => true,
            'username' => $mailbox->email,
            'password' => $mailbox->password,
            'protocol' => 'imap'
        ]);
    }
}
