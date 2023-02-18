<?php

namespace App\Http\Livewire\Spaces;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public $createSpace = false;

    public $title;
    public $icon;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.space.create');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')->required(),
            TextInput::make('icon')->required(),
        ];
    }

    public function submit(): void
    {
        auth()->user()->spaces()->create($this->form->getState());

        $this->reset('createSpace');
        $this->emit('refresh');
    }
}
