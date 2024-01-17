<?php

namespace App\Actions\Mail;

use App\Models\Mail;
use App\Models\Mailbox;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use Webklex\PHPIMAP\Message;

class ProcessMessages
{
    use AsAction;

    public function handle(Mailbox $mailbox, string $folder, int $limit, int $page, Carbon $since = null)
    {
        $connection = $mailbox->connect();

        $folder = $connection->getFolder($folder);

        $messages = $folder
            ->query()
            ->all()
            ->when($since, fn($query) => $query->since($since))
            ->leaveUnread()
            ->limit($limit, $page)
            ->get();

        $messages = $messages->filter(fn(Message $message) => $message->hasAttachments());

        foreach ($messages as $message) {
            $from = $message->getHeader()->get('from')?->first() ?? null;
            $to = $message->getHeader()->get('to')?->first() ?? null;

            Storage::disk('attachments')->makeDirectory("$mailbox->uuid/$message->uid");

            $message->attachments->each(fn($attachment) => $attachment->save(storage_path("app/attachments/$mailbox->uuid/$message->uid")));

            $mail = Mail::updateOrCreate([
                'uid' => $message->uid,
                'mailbox_id' => $mailbox->id,
            ], [
                'subject' => $message->getSubject() ?? '',
                'body' => $message->getTextBody() ?? '',
                'from' => $from?->mail ?? '',
                'from_hash' => sha1($from?->full ?? ''),
                'from_name' => $from?->personal ?? '',
                'to' => $to?->mail ?? '',
            ]);
        }
    }
}
