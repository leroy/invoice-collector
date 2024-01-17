<?php

namespace App\Actions\Mail;

use App\Models\Mail;
use App\Models\Mailbox;
use Lorisleiva\Actions\Concerns\AsAction;
use Webklex\PHPIMAP\Folder;

class GetFolders
{
    use AsAction;

    public function handle(Mailbox $mailbox)
    {
        return $mailbox->connect()->getFolders()->mapWithKeys(function(Folder $folder) {
            ['exists' => $count] = $folder->examine();

            return  [$folder->name => $count];
        });
    }
}
