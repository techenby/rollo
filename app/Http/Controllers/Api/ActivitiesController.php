<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ActivitiesController extends Controller
{
    public function show()
    {
        return auth()->user()->currentBlock()->with('activity.space')->first();
    }
}
