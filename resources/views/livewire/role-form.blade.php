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

            <div class="mb-6">
                <x-label for="permissionIds">Select Permissions</x-label>

                @foreach ($permissions as $permission)
                    <div class="flex items-center gap-2">
                        <x-checkbox id="{{ $permission->id }}" wire:model="permissionIds" :value="$permission->name" />
                        <x-label for="{{ $permission->id }}">{{ $permission->name }}</x-label>
                    </div>
                @endforeach

                @error('permissionIds')
                    <x-input-error for="permissionIds">{{ $message }}</x-input-error>
                @enderror
            </div>

            <x-button wire:click.prevent="store()">Save</x-button>
        </form>
    </div>
</div>
