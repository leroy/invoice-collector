<?php

namespace App\Actions\Mail;

use App\Enums\MailboxStatus;
use App\Models\Mailbox;
use Illuminate\Bus\PendingBatch;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Bus;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsJob;

class ImportMessages
{
    use AsAction, AsJob;

    public function handle(Mailbox $mailbox, array $folders, Carbon $since = null): void
    {
        $connection = $mailbox->connect();

        $totalCount = 0;

        foreach($folders as $folder) {
            $folder = $connection->getFolder($folder);

            ['exists' => $count] = $folder->examine();

            dump("Folder count: $count");

            $count = $folder->messages()->when($since, fn($query) => $query->since($since))->leaveUnread()->count();

            dump("Count since: $count");

            $batch = $this->setupJobBatch($mailbox, $folder->name, $count, since: $since);
            $batch->dispatch();

            $totalCount += $count;
        }

        $mailbox->update([
            'message_count' => $totalCount,
            'status' => MailboxStatus::Processing
        ]);
    }

    private function setupJobBatch(Mailbox $mailbox, string $folder, int $count, ?Carbon $since, int $batchSize = 50): PendingBatch
    {
        $jobs = [];

        for ($i = 0; $i < $count; $i += $batchSize) {
            $end = min($i + $batchSize, $count);

            $jobs[] = new \App\Jobs\ProcessMessages($mailbox, $folder, $i, $end, $since);
        }

        return Bus::batch($jobs);
    }
}
