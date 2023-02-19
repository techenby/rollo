<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\CurrentBlock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CurrentBlockTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(CurrentBlock::class);

        $component->assertStatus(200);
    }
}
