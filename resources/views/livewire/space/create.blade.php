<div>
    <button wire:click="$toggle('createSpace', true)" class="px-2 py-1 text-gray-500 dark:text-gray-400">Add Space</button>

    <x-dialog-modal wire:model="createSpace">
        <x-slot name="title">
            {{ __('Add Space') }}
        </x-slot>

        <x-slot name="content">
            {{ $this->form }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('createSpace', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="submit" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
