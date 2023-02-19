<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div
        x-data="emojiPickerFormComponent({
            isAutofocused: @js($isAutofocused()),
            isDisabled: @js($isDisabled()),
            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }}
        })"
        x-on:keydown.esc="isOpen() && $event.stopPropagation()"
        {{ $getExtraAlpineAttributeBag()->class(['relative flex-1']) }}
    >
        <input
            x-ref="input"
            type="text"
            dusk="filament.forms.{{ $getStatePath() }}"
            id="{{ $getId() }}"
            x-model="state"
            x-on:click="togglePanelVisibility()"
            x-on:keydown.enter.stop.prevent="togglePanelVisibility()"
            autocomplete="off"
            {!! $isDisabled() ? 'disabled' : null !!}
            {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!}
            @if (! $isConcealed())
                {!! $isRequired() ? 'required' : null !!}
            @endif
            {{ $getExtraInputAttributeBag()->class([
                'text-gray-900 block w-full transition duration-75 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70',
                'dark:bg-gray-700 dark:text-white dark:focus:border-primary-500' => config('forms.dark_mode'),
                'border-gray-300' => ! $errors->has($getStatePath()),
                'dark:border-gray-600' => (! $errors->has($getStatePath())) && config('forms.dark_mode'),
                'border-danger-600 ring-danger-600' => $errors->has($getStatePath()),
                'dark:border-danger-400 dark:ring-danger-400' => $errors->has($getStatePath()) && config('forms.dark_mode'),
            ]) }}
        />
        <div
            x-cloak
            x-ref="panel"
            x-float.placement.bottom-start.offset.flip.shift="{ offset: 8 }"
            wire:ignore.self
            wire:key="{{ $this->id }}.{{ $getStatePath() }}.{{ $field::class }}.panel"
            @class([
                'hidden absolute z-10 shadow-lg',
                'opacity-70 pointer-events-none' => $isDisabled(),
            ])
        >
            <emoji-picker></emoji-picker>
        </div>
    </div>
</x-dynamic-component>
