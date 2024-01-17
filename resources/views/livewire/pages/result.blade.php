<div class="bg-zinc-50 min-h-screen py-16">
    <x-container>
        <h1 class="mb-4">Found {{ $result->total() }} messages</h1>
        <x-card>
            <table class="border w-full">
                <thead>
                    <tr class="*:px-4 *:py-3">
                        <th></th>
                        <th>Sender</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($result as $item)
                        <tr class="border-t *:px-4 *:py-3">
                            <td>
                                <x-form.checkbox :value="$item->senderId"></x-form.checkbox>
                            </td>
                            <td>
                                {{ $item->from }}
                            </td>

                            <td>
                                {{ $item->count }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>

        <footer class="mt-4">
            {{ $result->links() }}
        </footer>
    </x-container>
</div>
