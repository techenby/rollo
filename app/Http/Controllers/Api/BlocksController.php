<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlockResource;
use App\Models\Activity;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlocksController extends Controller
{
    public function index()
    {
        $blocks = auth()->user()->blocks()
            ->whereDate('start', '>=', request('start'))
            ->where(function ($query) {
                $query->whereDate('end',   '<=', request('end'))
                    ->orWhereNull('end');
            })
            ->get();

        return BlockResource::collection($blocks);
    }

    public function store(Request $request)
    {
        $activity = Activity::findOrFail($request->get('activity_id'));
        Block::start($activity);

        return response(status: 201);
    }

    public function show(Block $block)
    {
        //
    }

    public function update(Block $block, string $method = null)
    {
        if ($method === 'stop') {
            $block->stop();
        }
    }

    public function destroy(Block $block)
    {
        //
    }
}
