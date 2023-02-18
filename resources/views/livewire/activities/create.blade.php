<div>
    <button wire:click="$toggle('createActivity', true)" class="px-2 py-1 text-gray-500 dark:text-gray-400">
        Add Activity
    </button>

    <x-dialog-modal wire:model="createActivity">
        <x-slot name="title">
            {{ __('Add Activity') }}
        </x-slot>

        <x-slot name="content">
            {{ $this->form }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('createActivity', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="submit" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
