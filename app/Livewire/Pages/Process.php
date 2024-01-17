<?php

namespace App\Livewire\Pages;

use App\Actions\Mail\GetFolders;
use App\Actions\Mail\ImportMessages;
use App\Actions\User\GetCredentials;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Process extends Component
{
    public $selectedFolders = [];

    public ?string $since = null;

    public function mount() {
        if (GetCredentials::run() === null) {
            return redirect()->route('setup');
        }
    }

    public function run()
    {
        $this->validate([
            'selectedFolders' => 'required',
            'since' => 'sometimes|date'
        ]);
        ImportMessages::run(
            GetCredentials::run(),
            $this->selectedFolders,
            Carbon::parse($this->since)
        );
    }

    public function render()
    {
        $mailbox = GetCredentials::run();

        return view('livewire.pages.process', [
            'mailbox' => $mailbox,
            'folders' => GetFolders::run($mailbox)
        ]);
    }
}
