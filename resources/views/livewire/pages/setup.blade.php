<div class="bg-zinc-50 py-16 h-screen">
    <x-container class="space-y-4">
        <h1 class="mb-12">Enter your mail credentials</h1>

        <x-button wire:click="test">Test</x-button>

        <x-card>
            <x-form class="space-y-4" wire:submit="setup">
                <x-form.field>
                    <x-form.label>E-mail</x-form.label>
                    <x-form.input wire:model="email" placeholder="test" autofocus autocomplete="off" data-1p-ignore></x-form.input>
                    <x-form.error name="email"></x-form.error>
                </x-form.field>

                <x-form.field>
                    <x-form.label>Password</x-form.label>
                    <x-form.input type="password" wire:model="password" placeholder="test" autocomplete="off"></x-form.input>
                    <x-form.error name="password"></x-form.error>
                </x-form.field>

                <x-form.field>
                    <x-form.label>IMAP host</x-form.label>
                    <x-form.input wire:model="imap" placeholder="test" autocomplete="off"></x-form.input>
                    <x-form.error name="imap"></x-form.error>
                </x-form.field>

                <x-button type="submit">Setup</x-button>
            </x-form>
        </x-card>
    </x-container>
</div>
