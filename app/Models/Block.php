<?php

namespace App\Models;

use Carbon\CarbonInterface;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['duration'];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public static function start(Activity $activity)
    {
        Block::currentlyRunningFor(auth()->user())->get()->each->stop();

        Block::create(['activity_id' => $activity->id, 'user_id' => auth()->id(), 'start' => now()]);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDurationAttribute()
    {
        return $this->interval->format("%H:%I:%S");
    }

    public function getIntervalAttribute()
    {
        return $this->start->diff($this->end ?? now());
    }

    public function scopeCurrentlyRunningFor($query, User $user)
    {
        return $query->where('user_id', $user->id)->whereNull('end');
    }

    public function stop()
    {
        $this->update([
            'end' => now(),
        ]);
    }

    public static function sum($blocks)
    {
        $end = new DateTime('00:00');
        $start = clone $end;

        foreach($blocks as $block) {
            $end->add($block->interval);
        }

        return $start->diff($end)->format("%H:%I:%S");
    }
}
