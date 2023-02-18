<div {{ $attributes->class([
        'filament-forms-card-component bg-white rounded-xl border border-gray-300',
        'dark:border-gray-700 dark:bg-gray-800' => config('forms.dark_mode'),
    ]) }}>
    {{ $slot }}
</div>
