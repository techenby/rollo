<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Concerns\HasAffixes;
use Filament\Forms\Components\Concerns\HasExtraInputAttributes;
use Filament\Forms\Components\Concerns\HasPlaceholder;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;

class EmojiPicker extends Field
{
    use HasAffixes;
    use HasExtraInputAttributes;
    use HasPlaceholder;
    use HasExtraAlpineAttributes;

    protected string $view = 'forms.components.emoji-picker';

}
