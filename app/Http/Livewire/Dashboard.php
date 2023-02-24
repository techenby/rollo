<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use App\Models\Block;
use DateTime;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = [
        'refresh' => '$refresh',
        'start',
    ];

    public $timezone;

    public function render()
    {
        return view('dashboard', [
            'currentBlock' => $this->currentBlock,
            'spaces' => $this->spaces,
            'today' => $this->today,
            'work' => $this->work,
        ]);
    }

    public function getCurrentBlockProperty()
    {
        return auth()->user()->currentBlock;
    }

    public function getSpacesProperty()
    {
        return auth()->user()->spaces->load('activities');
    }

    public function getTodayProperty()
    {
        if ($this->timezone) {
            $startOfDay = now()->timezone($this->timezone)->startOfDay()->timezone('UTC');
            $endOfDay = now()->timezone($this->timezone)->endOfDay()->timezone('UTC');

            return Block::where('user_id', auth()->id())
                ->where('start', '>=', $startOfDay) // won't count ones that started yesterday
                ->where(function ($query) use ($endOfDay) {
                    $query->where('end', '<=', $endOfDay)
                        ->orWhereNull('end');
                })
                ->with('activity')
                ->get()
                ->append('interval')
                ->groupBy('activity_id')
                ->map(function ($collection) {
                    return [
                        'activity' => $collection->first()->activity,
                        'duration' => Block::sum($collection),
                    ];
                })
                ->sortByDesc('duration');
        }
    }

    public function getWorkProperty()
    {
        if ($this->timezone) {
            $startOfWeek = now()->timezone($this->timezone)->startOfWeek()->timezone('UTC');
            $endOfWeek = now()->timezone($this->timezone)->endOfWeek()->timezone('UTC');

            $blocks = Block::where('user_id', auth()->id())
                ->where('start', '>=', $startOfWeek)
                ->where(function ($query) use ($endOfWeek) {
                    $query->where('end', '<=', $endOfWeek)
                        ->orWhereNull('end');
                })
                ->where('activity_id', 1)
                ->get();

            return Block::sum($blocks);
        }
    }

    public function start(Activity $activity)
    {
        Block::start($activity);
    }

    public function stop()
    {
        $this->currentBlock->stop();

        $this->emit('refresh');
    }
}
