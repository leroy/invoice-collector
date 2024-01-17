<?php

namespace App\Jobs;

use App\Models\Mailbox;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class ProcessMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Mailbox $mailbox,
        private string $folder,
        private int $start,
        private int $end,
        private Carbon $since
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $limit = $this->end - $this->start;
        $page = floor($this->end / $limit);

        \App\Actions\Mail\ProcessMessages::run(
            $this->mailbox,
            $this->folder,
            $limit,
            $page,
            $this->since
        );
    }
}
