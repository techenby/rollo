<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => 'OCALI',
            'color' => '#fff000',
            'icon' => '👾',
        ];
    }
}
