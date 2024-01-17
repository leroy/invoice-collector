<?php

namespace App\Livewire\Pages;

use App\Actions\User\GetCredentials;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Result extends Component
{
    public function render()
    {
        $mailbox = GetCredentials::run();
//        $result = $mailbox->messages()->groupBy('mails.from')->get();

        $result = $mailbox->messages()->groupBy('from')->select(['from', DB::raw('COUNT(1) as count')])->orderByDesc('count')->paginate();


        return view('livewire.pages.result', [
            'result' => $result
        ]);
    }
}
