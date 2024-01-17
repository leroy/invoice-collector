<div class="bg-zinc-50 h-screen py-16">
    <x-container>
        @if ($mailbox->status === \App\Enums\MailboxStatus::Created)
        <x-card class="space-y-4">
            <p>Select folders to process</p>
            <div>
                @foreach($folders as $folder => $count)
                    <x-form.field>
                        <x-form.checkbox wire:model.live="selectedFolders" id="{{ $folder }}" value="{{ $folder }}" />
                        <x-form.label for="{{ $folder }}">{{ $folder }} ({{ $count }})</x-form.label>
                    </x-form.field>
                @endforeach

                <x-form.error name="selectedFolders"></x-form.error>
            </div>

            <x-form.field>
                <x-form.label>Since</x-form.label>
                <x-form.input type="date" wire:model="since"></x-form.input>
                <x-form.error name="since"></x-form.error>
            </x-form.field>

            <x-button wire:click="run">Start</x-button>
        </x-card>
        @else
            loading...
        @endif
    </x-container>
</div>
