<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlocksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        dd($request->all());
        // stop previous block (if any)
        // start new block
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Block $block): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block): Response
    {
        //
    }
}
