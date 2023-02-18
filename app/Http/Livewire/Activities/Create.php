<?php

namespace App\Http\Livewire\Activities;

use App\Models\Space;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public Space $space;

    public $createActivity = false;

    public $title;
    public $color;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.activities.create');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')->required(),
            ColorPicker::make('color')->required(),
        ];
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $data['space_id'] = $this->space->id;
        auth()->user()->activities()->create($data);

        $this->reset('createActivity');
        $this->emit('refresh');
    }
}
