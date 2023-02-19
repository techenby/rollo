<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\Request;

class SpacesController extends Controller
{
    public function index()
    {
        return Space::where('user_id', auth()->id())->with('activities')->get();
    }
}
