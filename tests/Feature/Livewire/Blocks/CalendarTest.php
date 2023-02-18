<?php

namespace Tests\Feature\Livewire\Blocks;

use App\Http\Livewire\Blocks\Calendar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CalendarTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Calendar::class);

        $component->assertStatus(200);
    }
}
