<?php

namespace App\Actions\User;

use App\Models\Mailbox;
use Lorisleiva\Actions\Concerns\AsAction;

class GetCredentials
{
    use AsAction;

    public function handle(): ?Mailbox
    {
        return Mailbox::whereIn('uuid', session('user.mailboxes') ?? [])->first();
    }
}
