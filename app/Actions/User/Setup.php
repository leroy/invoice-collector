<?php

namespace App\Actions\User;

use App\Enums\MailboxStatus;
use App\Models\Mailbox;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class Setup
{
    use AsAction;

    public function handle(string $email, string $password, string $imap): string
    {
        $mailbox = Mailbox::updateOrCreate([
            'email' => $email,
        ], [
            'uuid' => Str::uuid(),
            'password' => $password,
            'imap' => $imap,
            'status' => MailboxStatus::Created,
            'message_count' => 0,
        ]);

        session()->put('user.mailboxes', [
            $mailbox->uuid,
        ]);

        return $mailbox->uuid;
    }
}
