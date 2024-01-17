<?php

namespace App\Livewire\Pages;

use App\Actions\User\GetCredentials;
use App\Models\Mailbox;
use Illuminate\Support\Collection;
use Livewire\Component;

class Setup extends Component
{
    public string $email;

    public string $password;

    public string $imap;

    public function setup()
    {
        $this->validate([
            'email' => 'required|email|unique:mailboxes,email',
            'password' => 'required',
            'imap' => 'required',
        ]);

        \App\Actions\User\Setup::run($this->email, $this->password, $this->imap);

        return $this->redirectRoute('process');
    }

    public function test()
    {
        if (!app()->environment('local')) return;

        session()->put('user.mailboxes', [
            Mailbox::first()->uuid,
        ]);
    }

    public function render()
    {
        return view('livewire.pages.setup');
    }
}
