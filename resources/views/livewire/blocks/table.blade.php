<div x-data="{ timezone: @entangle('timezone') }" x-init="timezone = Intl.DateTimeFormat().resolvedOptions().timeZone">
    {{ $this->table }}
</div>
