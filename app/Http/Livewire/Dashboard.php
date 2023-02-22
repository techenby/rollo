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
                    $dt = new DateTime('00:00');
                    $final = clone $dt;

                    foreach($collection as $block) {
                        $dt->add($block->interval);
                    }

                    return [
                        'activity' => $collection->first()->activity,
                        'duration' => $final->diff($dt)->format("%H:%I:%S"),
                    ];
                })
                ->sortByDesc('duration');
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
