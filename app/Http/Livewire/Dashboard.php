<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use App\Models\Block;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = ['refresh' => '$refresh', 'start'];

    public function render()
    {
        return view('dashboard', [
            'spaces' => $this->spaces,
        ]);
    }

    public function getSpacesProperty()
    {
        return auth()->user()->spaces->load('activities');
    }

    public function start(Activity $activity)
    {
        Block::start($activity);
    }
}
