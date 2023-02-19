<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        return $this->start->diffForHumans($this->end ?? now(), CarbonInterface::DIFF_ABSOLUTE);
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
}