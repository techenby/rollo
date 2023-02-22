<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<x-container class="grid grid-cols-4 gap-8">
    <div class="space-y-4">
        <x-card x-data>
            <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($spaces as $space)
                <li wire:key="space-{{ $space->id }}" x-disclosure>
                    <button type="button" class="group px-3 py-2 w-full flex items-center justify-between" x-disclosure:button>
                        <span class="space-x-2 text-gray-900 dark:text-gray-200">
                            <span>{{ $space->icon }}</span>
                            <span>{{ $space->title }}</span>
                        </span>
                        <div class="collapse group-hover:visible space-x-2 flex shrink-0 text-gray-500 dark:text-gray-400">
                            <div>
                                <x-heroicon-o-chevron-up x-show="$disclosure.isOpen" class="w-4 h-4" />
                                <x-heroicon-o-chevron-down x-show="! $disclosure.isOpen" class="w-4 h-4" />
                            </div>
                            <div>
                                <x-heroicon-o-pencil class="w-4 h-4" />
                            </div>
                        </div>
                    </button>

                    <ul wire:key="space-{{ $space->id }}-activities" x-disclosure:panel x-collapse>
                        @foreach($space->activities as $activity)
                        <li wire:key="activity-{{ $activity->id }}" class="group flex items-center space-x-2 justify-between px-3 py-2">
                            <button type="button" wire:click="$emit('start', {{ $activity->id }})" class="flex space-x-2 items-center">
                                <div class="w-5 h-5 rounded-full flex items-center justify-center" style="background-color: {{ $activity->color }}">
                                    <x-heroicon-o-play class="w-5 h-5 collapse group-hover:visible" />
                                </div>
                                <div class="text-gray-900 dark:text-gray-200">{{ $activity->title }}</div>
                            </button>
                            <button type="button" wire:click="$emit('editActivity', {{ $activity->id }})" class="collapse group-hover:visible text-gray-500 dark:text-gray-400">
                                <x-heroicon-o-pencil class="w-4 h-4" />
                            </button>
                        </li>
                        @endforeach
                        <li wire:key="space-{{ $space->id }}-activities-create">
                            <livewire:activities.create :space=$space wire:key="space-{{ $space->id }}-activities-create-lw" />
                        </li>
                    </ul>
                </li>

                @endforeach
                <li wire:key="spaces-create">
                    <livewire:spaces.create />
                </li>
            </ul>
        </x-card>

        @if ($currentBlock)
        <x-card class="p-6 flex items-center justify-between" style="background: {{ $currentBlock->activity->color }}">
            <span>{{ $currentBlock->activity->space->icon }} {{ $currentBlock->activity->title }}</span>
            <div class="flex items-center justify-between space-x-2">
                <span>{{ $currentBlock->duration }}</span>
                <button wire:click="stop">
                    <x-heroicon-o-stop class="w-4 h-4" />
                </button>
            </div>
        </x-card>
        @endif

        <div x-data="{ timezone: @entangle('timezone') }" x-init="timezone = Intl.DateTimeFormat().resolvedOptions().timeZone">
            @if ($timezone)
            <x-card>
                <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($today as $item)
                    <li wire:key="duration-{{ $item['activity']->id }}" class="px-3 py-2 flex items-center justify-between space-x-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-5 h-5 rounded-full" style="background-color: {{ $item['activity']->color }}"></span>
                            <span>{{ $item['activity']->title }}</span>
                        </div>
                        <span>{{ $item['duration'] }}</span>
                    </li>
                    @endforeach
                </ul>
            </x-card>
            @endif
        </div>
    </div>

    <div class="col-span-3 space-y-4">
        <x-card class="p-2">
            <div id="calendar" wire:ignore>

            </div>
        </x-card>

        <livewire:blocks.table />
    </div>
</x-container>
