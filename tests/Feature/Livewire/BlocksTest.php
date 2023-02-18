<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Blocks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BlocksTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Blocks::class);

        $component->assertStatus(200);
    }
}
