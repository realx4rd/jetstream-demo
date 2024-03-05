<div>
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        @if (session()->has('success'))
            <div class="px-4 py-3 rounded relative bg-gray-100" role="alert">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="px-4 py-3 rounded relative bg-red-100" role="alert">
                <p>{{ session()->get('error') }}</p>
            </div>
        @endif

        <form class="max-w-sm mx-auto">

            <div class="mb-6">
                <x-label for="name">Name</x-label>
                <x-input id="name" type="text" wire:model="name" />
                @error('name')
                    <x-input-error for="name">{{ $message }}</x-input-error>
                @enderror
            </div>

            <x-button wire:click.prevent="store()">Save</x-button>
        </form>
    </div>
</div>
